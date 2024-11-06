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

        add_action('admin_menu', [$this, 'add_menu']);
        
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

    function add_menu() {
        add_menu_page(
            'Slider Options',
            'Slider',
            'manage_options',
            'slider-admin',
            [$this, 'slider_settings_page'],
            'dashicons-images-alt2'
        );

        add_submenu_page(
            'slider-admin',
            'Settings',
            'Settings',
            'manage_options',
            'slider-admin',
            [$this, 'slider_settings_page'],
        );

        add_submenu_page(
            'slider-admin',
            'Manage Slides',
            'Manage Slides',
            'manage_options',
            'edit.php?post_type=slider',
            null,
            null
        );

        add_submenu_page(
            'slider-admin',
            'Add New Slide',
            'Add New Slide',
            'manage_options',
            'post-new.php?post_type=slider',
            null,
            null
        );
    }

    function slider_settings_page() {
        echo 'this is settings page';
    }
}

register_activation_hook( __FILE__, ['Slider', 'activate'] );
register_deactivation_hook( __FILE__, ['Slider', 'deactivate'] );
register_uninstall_hook( __FILE__, ['Slider', 'uninstall'] );
$slider = new Slider();