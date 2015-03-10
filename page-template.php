<?php namespace GlobalTechnology\GlobalMeasurements {
	require_once( __DIR__ . '/vendor/autoload.php' );
	require_once( __DIR__ . '/constants.php' );

	$wrapper = ApplicationWrapper::singleton();
	$wrapper->authenticate();
	
	// Creating iFrame content
	// Links to CSS and JS files
	$module_path = base_path() . drupal_get_path('module', 'gma_app_drupal');
	$bootstrap_css = "$module_path/app/vendor/bootstrap/dist/css/bootstrap.css";
	$bootstrap_theme_css = "$module_path/app/vendor/bootstrap/dist/css/bootstrap-theme.css";
	$spinner_css =  "$module_path/app/css/spinner.css";
	$gcm_css = "$module_path/app/css/gcm.css";

	$jquery_js = "$module_path/app/vendor/jquery/dist/jquery.js";
	$app_config = $wrapper->appConfig();

	$app_html = "'$module_path/app/template/app.html'";
	$app_js = "$module_path/app/js/main.js";
	$app_js_require = "$module_path/app/vendor/requirejs/require.js";
	
	// iFrame HTML structure
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
	
	// Adding iFrame to page
	$block['content']='<iframe id="gma_iframe" style="width:100%;min-height:600px;border:1px solid #ddd;"></iframe>';
	
	// Loading content into iFrame
	drupal_add_js("var doc = document.getElementById('gma_iframe').contentWindow.document;
	doc.open();
	doc.write(`".$html."`);
	doc.close();" , array('type' => 'inline', 'scope' => 'footer'));
}