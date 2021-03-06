<?php return array(

	'version'      => '1.0.0',

	/**
	 * Proxy Granting Ticket Service
	 *
	 * Enable this to use the php wrapper on localhost.
	 */
	'pgtservice'   => array(
		/** @var bool Enable PGT Service */
		'enabled'  => false,
		/** @var string PGT Service proxy callback URL */
		'callback' => 'https://agapeconnect.me/casLogin.aspx',
		/** @var string PGT Service endpoint URL */
		'endpoint' => 'https://agapeconnect.me/DesktopModules/AgapeConnect/casauth/pgtcallback.asmx/RetrievePGTCallback',
		/** @var string PGT Service Username */
		'username' => '',
		/** @var string PGT Service Password */
		'password' => '',
	),

	/**
	 * CAS Settings
	 */
	'cas'          => array(
		/** @var string CAS hostname */
		'hostname' => 'thekey.me',
		/** @var int CAS port */
		'port'     => 443,
		/** @var string CAS context */
		'context'  => 'cas',
	),

	/**
	 * Measurements API
	 */
	'measurements' => array(
		/** @var string API endpoint, no training slash */
		'endpoint'  => 'https://measurements.global-registry.org/v1',
		/** @var string Namespace of application specific measurements */
		'namespace' => 'gma-app',
	),

	/**
	 * Mobile Applications
	 * label => link
	 */
	'mobileapps'   => array(
		// -- Production --
		'iOS'     => 'itms-services://?action=download-manifest&url=https://downloads.global-registry.org/prod/ios/gma.plist',
		'Android' => 'https://play.google.com/store/apps/details?id=com.expidevapps.android.measurements',
		// -- Stage --
		//'iOS'     => 'itms-services://?action=download-manifest&url=https://downloads.global-registry.org/stage/ios/gma.plist',
		//'Android' => 'https://play.google.com/store/apps/details?id=com.expidevapps.android.measurements.demo',
	),

	'googlemaps'   => array(
		'endpoint' => 'https://maps.googleapis.com/maps/api/js?sensor=false',
		'apiKey'   => false,
	),
	
	/**
	 * Which tabls to show
	 */
	'enabled_tabs' => array('map', 'measurements', 'reports', 'admin')
);
