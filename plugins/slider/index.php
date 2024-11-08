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

        require_once(SLIDER_PATH . 'class.slider-settings.php');
        $slider_settings = new Slider_Settings();

        require_once(SLIDER_PATH . 'class.slider-shortcode.php');
        $slider_shortcode = new Slider_Shortcode();

        add_action('wp_enqueue_scripts', [$this, 'register_scripts'], 999);
        add_action('admin_enqueue_scripts', [$this, 'register_admin_scripts'], 999);
    }

    function define_constants() {
        define('SLIDER_PATH', plugin_dir_path(__FILE__));
        define('SLIDER_URL', plugin_dir_url(__FILE__));
        define('SLIDER_VERSION', '0.0.1');
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
        if(!current_user_can('manage_options')) {
            return;
        }

        if(isset($_GET['settings-updated'])) {
            add_settings_error('slider_options', 'slider_message', 'Settings Saved', 'success');
        }

        settings_errors('slider_options');
        require(SLIDER_PATH . 'page.settings.php');
    }

    function register_scripts() {
        wp_register_script('main', SLIDER_URL . 'vendor/jquery.flexslider-min.js', ['jquery'], SLIDER_VERSION, true);
        wp_register_script('settings', SLIDER_URL . 'vendor/flexslider.js', ['jquery'], SLIDER_VERSION, true);
        wp_register_style('main-style', SLIDER_URL . 'vendor/flexslider.css', [], SLIDER_VERSION, 'all');
        wp_register_style('base-style', SLIDER_URL . 'assets/base.css', [], SLIDER_VERSION, 'all');
    }

    function register_admin_scripts() {
        global $typenow;
        if($typenow == 'slider') {
            wp_enqueue_style('admin-base-style', SLIDER_URL . 'assets/admin-base.css', [], SLIDER_VERSION, 'all');
        }
    }
}

register_activation_hook( __FILE__, ['Slider', 'activate'] );
register_deactivation_hook( __FILE__, ['Slider', 'deactivate'] );
register_uninstall_hook( __FILE__, ['Slider', 'uninstall'] );
$slider = new Slider();