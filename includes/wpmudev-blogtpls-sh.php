<?php

if( !class_exists('blog_templates') ) return;

define( 'WPMUDEV_GF_NBT_ADDON_TPL_DIR_PATH', plugin_dir_path( __FILE__ ) . '/template' );

if( ! class_exists('WPMUDEV_BlogTemplate_List') ){
	class WPMUDEV_BlogTemplate_List {
		
	    static $add_script;
	    

	    static function init() {
	        add_shortcode('wpmudev_templates_list', array(__CLASS__, 'handle_shortcode'));
	        add_action('init', array(__CLASS__, 'register_script'));
	        add_action('wp_footer', array(__CLASS__, 'print_script'));
	    }
	    

	    static function handle_shortcode( $atts ) {

			$atts = shortcode_atts( array(
				'layout' 	=> 'previewer',
				'blog_id'	=> ''
			), $atts );

			self::$add_script = true;

			$layout = $atts['layout'];
			$blog_id = $atts['blog_id'] != '' ? (int)$atts['blog_id'] : get_current_blog_id();

			$settings = nbt_get_settings();
			$templates = $settings['templates'];

			switch( $layout ){

				case 'showcase' : $layout = '-registration-page-showcase'; break;

				case 'description': $layout = '-registration-description'; break;

				case 'previewer' : $layout = '-registration-previewer'; break;

				case 'screenshot' : $layout = '-registration-screenshot'; break;

				case 'screenshot_plus' : $layout = '-registration-screenshot_plus'; break;

				case '': default: $layout = '-registration'; break;
			}

			ob_start();

			require_once WPMUDEV_GF_NBT_ADDON_TPL_DIR_PATH . "/blog_templates{$layout}.php";

			echo '<input type="hidden" id="wpmudev-blogid" value="'. $blog_id .'">';

			$blog_templates = new blog_templates();

			$content = '<div addon="wpmudev_nbtfieldaddon">' . ob_get_clean() . '</div>';

			return $content;

		}

	    static function register_script() {
	        wp_register_script('wpmudev-blogtpls-js', plugins_url('wpmudev-blogtpls.js', __FILE__), array('jquery'), '1.0', true);
	        wp_register_style( 'wpmudev-blogtpls-css', plugins_url( 'wpmudev-blogtpls.css', __FILE__ ) );
	    }

	    static function print_script() {
	        if ( ! self::$add_script )
	            return;
	        
	        wp_print_scripts('nbt-template-selector');

	        wp_print_scripts('wpmudev-blogtpls-js');
	        wp_enqueue_style( 'wpmudev-blogtpls-css' );
	    }

	}

	WPMUDEV_BlogTemplate_List::init();
}
?>
