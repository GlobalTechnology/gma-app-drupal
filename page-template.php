<?php namespace GlobalTechnology\GlobalMeasurements {
	require_once( __DIR__ . '/vendor/autoload.php' );
	require_once( __DIR__ . '/constants.php' );

	$wrapper = ApplicationWrapper::singleton();
	$wrapper->authenticate();
	/*
	drupal_add_css(drupal_get_path('module', 'gma_app_drupal') . '/app/vendor/bootstrap/dist/css/bootstrap.css');
	drupal_add_css(drupal_get_path('module', 'gma_app_drupal') . '/app/vendor/bootstrap/dist/css/bootstrap-theme.css');
	drupal_add_css(drupal_get_path('module', 'gma_app_drupal') . '/app/css/spinner.css');
	drupal_add_css(drupal_get_path('module', 'gma_app_drupal') . '/app/css/gcm.css');
	

	drupal_add_js(, array('type' => 'file', 'scope' => 'footer'));
	drupal_add_js('var gma = window.gma = window.gma || {};gma.config = '. $wrapper->appConfig() .' ;', array('type' => 'inline', 'scope' => 'footer'));

	$block['content']='<div ng-include="\'' .base_path(). drupal_get_path('module', 'gma_app_drupal') .'/app/template/app.html\'"></div>
	<script type="application/javascript" data-main="' .base_path() . drupal_get_path('module', 'gma_app_drupal') .'/app/js/main.js" src="' .base_path() . drupal_get_path('module', 'gma_app_drupal') .'/app/vendor/requirejs/require.js"></script>';
	*/
	$bootstrap_css=drupal_get_path('module', 'gma_app_drupal') . '/app/vendor/bootstrap/dist/css/bootstrap.css';
	$bootstrap_theme_css=drupal_get_path('module', 'gma_app_drupal') . '/app/vendor/bootstrap/dist/css/bootstrap-theme.css';
	$spinner_css=drupal_get_path('module', 'gma_app_drupal') . '/app/css/spinner.css';
	$gcm_css=drupal_get_path('module', 'gma_app_drupal') . '/app/css/gcm.css';

	$jquery_js=drupal_get_path('module', 'gma_app_drupal') . '/app/vendor/jquery/dist/jquery.js';
	$app_config=$wrapper->appConfig();

	$app_html="'".base_path(). drupal_get_path('module', 'gma_app_drupal') ."/app/template/app.html'";
	$app_js=base_path(). drupal_get_path('module', 'gma_app_drupal') ."/app/js/main.js";
	$app_js_require=base_path() . drupal_get_path('module', 'gma_app_drupal') ."/app/vendor/requirejs/require.js";
	
	$html='<!doctype html>
	<html>
	<head>
		<title>Next-Gen Measurements</title>
		<link rel="icon" type="image/png" href="app/img/gma-logo.png">
		<link href="'.$bootstrap_css.'" rel="stylesheet" />
		<link href="'.$bootstrap_theme_css.'" rel="stylesheet" />
		<link href="'.$spinner_css.'" rel="stylesheet" />
		<link href="'.$gcm_css.'" rel="stylesheet" />
		<script type="application/javascript" src="'.$jquery_js.'"></script>
		<script type="application/javascript">
			var gma = window.gma = window.gma || {};
			gma.config = '.$app_config.';
		</script>
	</head>
	<body>
	<div ng-include="'.$app_html.'"></div>
	<script type="application/javascript" data-main="'.$app_js.'" src="'.$app_js_require.'"></script>
	</body>
	</html>';
	$block['content']='<iframe id="gma_iframe" style="width:100%;height:600px;"></iframe>';
	//drupal_add_js("$('#gma_iframe').val(`$html`);", array('type' => 'inline', 'scope' => 'footer'));
	//drupal_add_js("document.getElementById('gma_iframe').innerHTML = `$html`;", array('type' => 'inline', 'scope' => 'footer'));
	drupal_add_js("var doc = document.getElementById('gma_iframe').contentWindow.document;
	doc.open();
	doc.write(`".$html."`);
	doc.close();"
	, array('type' => 'inline', 'scope' => 'footer'));
}