<?php namespace GlobalTechnology\GlobalMeasurements {

	// Require phpCAS, composer does not autoload it.
	require_once( dirname( dirname( __FILE__ ) ) . '/../cas/CAS/CAS.php' );

	class ApplicationWrapper {
		/**
		 * Singleton instance
		 * @var ApplicationWrapper
		 */
		private static $instance;

		/**
		 * Returns the Plugin singleton
		 * @return ApplicationWrapper
		 */
		public static function singleton() {
			if ( ! isset( self::$instance ) ) {
				$class          = __CLASS__;
				self::$instance = new $class();
			}
			return self::$instance;
		}

		/**
		 * Prevent cloning of the class
		 * @internal
		 */
		private function __clone() {
		}

		private $casClient;

		/**
		 * Constructor
		 */
		private function __construct() {
			//Load config
			$configDir = dirname( dirname( __FILE__ ) ) . '/config';
			Config::load( require $configDir . '/config.php', require $configDir . '/defaults.php' );


			// Initialize phpCAS proxy client
			$this->casClient = $this->initializeCAS();
		}

		private function initializeCAS() {
			$casClient = new \CAS_Client(
				CAS_VERSION_2_0,
				true,
				Config::get( 'cas.hostname' ),
				Config::get( 'cas.port' ),
				Config::get( 'cas.context' )
			);
			$casClient->setNoCasServerValidation();

			if ( true === Config::get( 'pgtservice.enabled', false ) ) {
				$casClient->setCallbackURL( Config::get( 'pgtservice.callback' ) );
				$casClient->setPGTStorage( new ProxyTicketServiceStorage( $casClient ) );
			}
			else {
				$casClient->setCallbackURL( PLUGIN_DIR. 'callback.php' );
				$casClient->setPGTStorageFile( session_save_path() );
				// Handle logout requests but do not validate the server
				$casClient->handleLogoutRequests( false );
			}

			// Accept all proxy chains
			$casClient->getAllowedProxyChains()->allowProxyChain( new \CAS_ProxyChain_Any() );

			return $casClient;
		}

		public function getAPIServiceTicket() {
			return $this->casClient->retrievePT( Config::get( 'measurements.endpoint' ) . '/token', $code, $msg );
		}

		public function authenticate() {
			$this->casClient->forceAuthentication();
		}

		public function logout() {
			$this->casClient->logout( array() );
		}

		public function appConfig() {
			return json_encode( array(
				'ticket'     => $this->getAPIServiceTicket(),
				'appUrl'     => PLUGIN_DIR.'app',
				'mobileapps' => $this->mobileApps(),
				'api'        => array(
					'measurements' => Config::get( 'measurements.endpoint' ),
					'refresh'      => PLUGIN_DIR.'refresh.php',
					'logout'       => Config::get( 'pgtservice.enabled' )
						? PLUGIN_DIR.'logout.php'
						: $this->casClient->getServerLogoutURL(),
				),
				'namespace'  => Config::get( 'measurements.namespace' ),
				'googlemaps' => $this->googleMapsUrl(),
				'version'      => Config::get( 'version', '' ),
				'enabled_tabs' => Config::get( 'enabled_tabs', array() )
			) );
		}

		private function mobileApps() {
			$configuredApps = Config::get( 'mobileapps', array() );
			$apps           = array();
			foreach ( $configuredApps as $label => $link ) {
				$apps[ ] = array(
					'label' => $label,
					'link'  => $link,
				);
			}
			return $apps;
		}

		private function googleMapsUrl() {
			$url = new \Net_URL2( Config::get( 'googlemaps.endpoint' ) );
			if ( $key = Config::get( 'googlemaps.apiKey', false ) )
				$url->setQueryVariable( 'key', $key );
			return $url->getURL();
		}

		private function endswith( $string, $test ) {
			$strlen  = strlen( $string );
			$testlen = strlen( $test );
			if ( $testlen > $strlen ) return false;
			return substr_compare( $string, $test, $strlen - $testlen, $testlen ) === 0;
		}
	}

}
