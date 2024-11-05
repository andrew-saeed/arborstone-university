<?

/*
    Plugin Name: Slider
    Description: Awesome sliders for your website
    Version: 0.0.1
    Author: Andrew Saeed
    Author URI: https://andrewsaeed.dev
*/

if( !defined('ABSPATH') ) exit;

class Slider {
    function __construct() {
        $this->define_constants();
        
        require_once(SLIDER_PATH . 'class.slider-post-type.php');
        $slider_post_type = new Slider_Post_Type();
    }

    function define_constants() {
        define('SLIDER_PATH', plugin_dir_path(__FILE__));
        define('SLIDER_URL', plugin_dir_url(__FILE__));
    }

    static function activate() {
        update_option('rewrite_rules', '');
    }

    static function deactivate() {
        flush_rewrite_rules();
        unregister_post_type('slider');
    }

    static function uninstall() {}
}

register_activation_hook( __FILE__, ['Slider', 'activate'] );
register_deactivation_hook( __FILE__, ['Slider', 'deactivate'] );
register_uninstall_hook( __FILE__, ['Slider', 'uninstall'] );
$slider = new Slider();