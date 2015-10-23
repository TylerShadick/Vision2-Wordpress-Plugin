<?php
/**
 * Plugin Name: Vision2 for Wordpress
 * Plugin URI: https://github.com/TylerShadick/Vision2-Wordpress-Plugin
 * Description: Extends Wordpress with Vision2 Functionality
 * Version: 1.0
 * Author: Tyler Shadick
 * Author URI: http://www.tylershadick.com
 * License: GPL2
 */
//Thanks to Scribu for the help - http://scribu.net/wordpress/optimal-script-loading.html
//Include V2 Options File
include( plugin_dir_path( __FILE__ ) . 'V2_Options.php');
class Vision2{
	static $add_script;
    static $add_siteid;

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
                'siteid' => '',
                ), $atts );
        if(isset($a['siteid']) && ctype_alnum($a['siteid']))
        {
            self::$add_siteid = '&v2wsid=' . $a['siteid'];
        }
        else
        {
            self::$add_siteid = '';
        }
        if(isset($a['opts']))
        {
            //If they added parenthesis, let's just remove them to be safe.
                $a['opts'] = str_replace(array( '{', '}' ), '', $a['opts']);
            //Include Opts
                return '<div class="v2 v2Module" data-module="'. $a["module"] .'" data-opts="{'. $a["opts"] . '}"></div>';
        }
        else
        {
            //No Opts
        return '<div class="v2 v2Module" data-module="'. $a["module"] .'"></div>';
        }
            }
	static function register_script() {
    //Insert Script, If Function Present
         $V2Plugin_plugin_options = get_option('V2Plugin_plugin_options');
    if(isset($V2Plugin_plugin_options['V2Plugin_API_URL']))
       {
    wp_register_script('vision2_api', 'https://'. $V2Plugin_plugin_options['V2Plugin_API_URL'] .'.v2sapi.co/script/APIScript?includeDemoCss=true' . self::$add_siteid);	}
       }

	static function print_script() {
        $V2Plugin_plugin_options = get_option('V2Plugin_plugin_options');
		if ( ! self::$add_script && isset($V2Plugin_plugin_options['V2Plugin_API_URL']) )
			return;
        //Fires only is shortcode is present
		wp_print_scripts('vision2_api');
	}
}
Vision2::init();