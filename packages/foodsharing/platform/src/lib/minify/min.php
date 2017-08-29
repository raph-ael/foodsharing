#!/usr/bin/env php
<?php
define('ROOT_DIR',__DIR__.'/../..');
require_once (__DIR__.'/JSMin.php');
require_once (__DIR__.'/cssmin.php');
$js_out = ROOT_DIR.'/js/gen/script.js';
$css_out = ROOT_DIR.'/css/gen/style.css';
$js_files = [
	'/js/jquery.1.11.0.js',
	'/js/jquery-ui-1.10.4.js',
	'/js/jquery-ui-addons.js',
	'/js/tablesorter/jquery.tablesorter.min.js',
	'/js/fancybox/jquery.fancybox.pack.js',
	'/js/jquery.Jcrop.min.js',
	'/js/tagedit/js/jquery.autoGrowInput.js',
	'/js/tagedit/js/jquery.tagedit.js',
	'/js/timeago.js',
	'/js/autolink.js',
	'/js/js-time-format.js',
	'/js/jquery.slimscroll.min.js',
	'/js/underscore.js',
	'/js/underscore.string.js',
	'/js/script.js',
	'/js/instant-search.js',
	'/js/conv.js',
	'/js/info.js',
	'/js/storage.js',
	'/js/jquery.popup.min.js',
	'/js/socket.io-1.5.0.min.js',
	'/js/socket.js',
	'/js/typeahead.bundle.js',
	'/js/typeahead-addresspicker.js',
	'/js/leaflet/leaflet.js'
];
$css_files = [
	'/fonts/alfaslabone/stylesheet.css',
	'/css/font-awesome.min.css',
	'/css/jquery-ui.css',
	'/css/jMenu.jquery.css',
	'/js/fancybox/jquery.fancybox.css',
	'/css/style.css',
	'/css/content.css',
	'/css/jquery.Jcrop.min.css',
	'/js/tagedit/css/jquery.tagedit.css',
	'/css/chat.css',
	'/css/jquery.switchButton.css',
	'/css/info.css',
	'/css/icons.css',
	'/css/popup.css',
	'/css/typeahead.css',
	'/js/leaflet/leaflet.css',
	'/js/leaflet/leaflet.awesome-markers.css'
];
@file_put_contents($js_out, '');
foreach ($js_files as $f) {
	file_put_contents($js_out, JSMin::minify(file_get_contents(ROOT_DIR.$f))."\n",FILE_APPEND);
}
@file_put_contents($css_out, '');
foreach ($css_files as $f) {
	if(strpos($f,'awesome') !== false)
	{
		file_put_contents($css_out, (file_get_contents(ROOT_DIR.$f))."\n",FILE_APPEND);
	}
	else
	{
		file_put_contents($css_out, CssMin::minify(file_get_contents(ROOT_DIR.$f))."\n",FILE_APPEND);
	}
}
