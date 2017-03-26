<?php
/*
Plugin Name: Gravity Forms Add-On For New Blog Templates
Plugin URI: https://premium.wpmudev.org
Description: A simple add-on to demonstrate how to use the Add-On Framework to include a new field type.
Version: 1.0.0
Author: Panos Lyrakis (WPMUDEV)
Author URI: https://premium.wpmudev.org/profile/panoskatws
Text Domain: nbtfieldaddon
Domain Path: /languages
*/

define( 'GF_NBT_FIELD_ADDON_VERSION', '1.0.0' );

add_action( 'gform_loaded', array( 'WPMUDEV_GF_NBT_Addon_Bootstrap', 'load' ), 5 );

class WPMUDEV_GF_NBT_Addon_Bootstrap {

    public static function load() {

        if ( ! method_exists( 'GFForms', 'include_addon_framework' ) ) {
            return;
        }

        require_once( 'class-gfnbtfieldaddon.php' );

        GFAddOn::register( 'GFNBTFieldAddOn' );
    }

}

add_action( 'plugins_loaded', function(){
	require_once 'includes/wpmudev-blogtpls-sh.php';
}, 10);