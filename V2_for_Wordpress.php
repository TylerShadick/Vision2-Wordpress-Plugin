<?php
/**
 * Plugin Name: Vision2 for Wordpress
 * Plugin URI: https://github.com/TylerShadick
 * Description: Extends Wordpress with Vision2 Functionality
 * Version: 0.1
 * Author: Tyler Shadick
 * Author URI: http://www.tylershadick.com
 * License: GPL2
 */
//Thanks to Scribu for the help - http://scribu.net/wordpress/optimal-script-loading.html
//Include V2 Options File
include( plugin_dir_path( __FILE__ ) . 'V2_Options.php');
class Vision2{
	static $add_script;

	static function init() {
		add_shortcode('Vision2', array(__CLASS__, 'handle_shortcode'));
		add_action('init', array(__CLASS__, 'register_script'));
		add_action('wp_footer', array(__CLASS__, 'print_script'));
	}

	static function handle_shortcode($atts) {
		self::$add_script = true;
                $a = shortcode_atts( array(
                'module' => 'profile',
                'opts' => '',
                ), $atts );
                return "<div class='v2 v2Module' data-module='{$a["module"]}'' data-opts='{$a["opts"]}'></div>";
            }
	static function register_script() {
    //Insert Script, If Function Present
        //Using JQUERY as test
    wp_register_script('vision2_api', $V2Plugin_options['V2Plugin_API_URL']);	}

	static function print_script() {
		if ( ! self::$add_script )
			return;

		wp_print_scripts('vision2_api');
	}
}
Vision2::init();