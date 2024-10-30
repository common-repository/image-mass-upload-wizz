<?php
/*
Plugin Name: Image Mass Upload Wizz
Plugin URI: http://www.wpwizz.com
Description: A mass upload plugin
Version: 1.1
Author: wpwizz
Author URI: wpwizz.com
Programed: Marius Moiceanu(marius81@gmail.com)
*/




		add_filter("mce_external_plugins", "upload_mass_addplugin");
		add_filter('mce_buttons', 'upload_mass_registerbutton');


function upload_mass_registerbutton($buttons) {
	array_push($buttons, 'separator', 'massupload');
	return $buttons;
}
function upload_mass_addplugin($plugin_array) {
	$plugin_array['massupload'] = plugins_url('image-mass-upload-wizz/tinymce/plugins/massupload/editor_plugin.dev.js');
	return $plugin_array;
}


?>