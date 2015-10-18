<?php
/**
 * Plugin Name: Vision2 for Wordpress
 * Plugin URI: https://github.com/TylerShadick
 * Description: Extends Wordpress with V2 Functionality
 * Version: 0.1
 * Author: Tyler Shadick
 * Author URI: http://www.tylershadick.com
 * License: GPL2
 */
//Include V2 Options File
//include( plugin_dir_path( __FILE__ ) . 'V2_Options.php');
//Assistance from http://scribu.net/wordpress/optimal-script-loading.html
class Vision2_Shortcode {
	static $add_v2_script;

	static function init() {
		add_v2_shortcode('V2shortcode', array(__CLASS__, 'handle_v2_shortcode'));

		add_action('init', array(__CLASS__, 'register_script'));
		add_action('wp_footer', array(__CLASS__, 'print_script'));
	}

	static function handle_v2_shortcode($atts) {
		self::$add_v2_script = true;
        //Start Shorcode Handling
            add_v2_shortcode( 'Vision2', 'Vision2_func' );
            //[Vision2 module="MODULE HERE" opts="OPTIONS HERE"]
            function Vision2_func( $atts ) 
            {
                $a = shortcode_atts( array(
                'module' => 'profile',
                'opts' => '',
                ), $atts );
                return "<div class='v2 v2Module' data-module='{$a["module"]}'' data-opts='{$a["opts"]}'></div>";
            }
        //End Shortcode Handling
	}

	static function register_script() {
    //Insert Script, If Function Present
		wp_register_script('V2-script', '//cflcn.v2sapi.co/script/APIScript?includeDemoCss=true');
	}

	static function print_script() {
		if ( ! self::$add_v2_script )
			return;

		wp_print_scripts('V2-script');
	}
}