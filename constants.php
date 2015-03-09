<?php namespace GlobalTechnology\GlobalMeasurements {

	/**
	 * Localization Text Domain
	 * @var string
	 */
	const TEXT_DOMAIN = 'gmaapp';

	/**
	 * Script / Style Prefix
	 * @var string
	 */
	const PREFIX = 'gmaapp-';

	/**
	 * Page Slug
	 * @var string
	 */
	const PAGE_SLUG = 'gma';

	/**
	 * Plugin Directory
	 * @var string
	 */
	define( 'GlobalTechnology\GlobalMeasurements\PLUGIN_DIR', '/'.drupal_get_path('module', 'gma_app_drupal').'/' );

	/**
	 * Plugin Directory URL
	 * @var string
	 */
	define( 'GlobalTechnology\GlobalMeasurements\PLUGIN_URL', '/'.drupal_get_path('module', 'gma_app_drupal').'/' );
}
