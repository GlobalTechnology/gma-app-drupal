<?php namespace GlobalTechnology\GlobalMeasurements {
	require_once( __DIR__ . '/vendor/autoload.php' );
	require_once( __DIR__ . '/constants.php' );

	$wrapper = ApplicationWrapper::singleton();
	$wrapper->authenticate();
	drupal_add_css(drupal_get_path('module', 'gma_app_drupal') . '/app/vendor/bootstrap/dist/css/bootstrap.css');
	drupal_add_css(drupal_get_path('module', 'gma_app_drupal') . '/app/vendor/bootstrap/dist/css/bootstrap-theme.css');
	drupal_add_css(drupal_get_path('module', 'gma_app_drupal') . '/app/css/spinner.css');
	drupal_add_css(drupal_get_path('module', 'gma_app_drupal') . '/app/css/gcm.css');
	drupal_add_css('.block-gma-app-drupal {font-family: sans-serif;background-color:#fff;}', array('type' => 'inline', 'scope' => 'header'));
	

	drupal_add_js(drupal_get_path('module', 'gma_app_drupal') . '/app/vendor/jquery/dist/jquery.js', array('type' => 'file', 'scope' => 'footer'));
	drupal_add_js('var gma = window.gma = window.gma || {};gma.config = '. $wrapper->appConfig() .' ;', array('type' => 'inline', 'scope' => 'footer'));

	$block['content']='<div ng-include="\'' .base_path(). drupal_get_path('module', 'gma_app_drupal') .'/app/template/app.html\'"></div>
	<script type="application/javascript" data-main="' .base_path() . drupal_get_path('module', 'gma_app_drupal') .'/app/js/main.js" src="' .base_path() . drupal_get_path('module', 'gma_app_drupal') .'/app/vendor/requirejs/require.js"></script>';

}
