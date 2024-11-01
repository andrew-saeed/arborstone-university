<?

/*
    Plugin Name: Quize Plugin
    Description: Quize multiple choice
    Version: 0.0.1
    Author: Andrew Saeed
    Author URI: https://andrewsaeed.dev
*/

if( !defined('ABSPATH') ) exit;

class Quize {
    function __construct() {
        add_action('init', array($this, 'adminAssets'));
    }

    function adminAssets() {
        wp_register_style('quizeBlockStyle', plugin_dir_url(__FILE__) . 'build/index.css');
        wp_register_script('quizeBlockScript', plugin_dir_url(__FILE__) . 'build/index.js', array('wp-blocks', 'wp-element', 'wp-editor'));
        register_block_type('quize/quize', array(
            'editor_style' => 'quizeBlockStyle',
            'editor_script' => 'quizeBlockScript',
            'render_callback' => array($this, 'theHTML')
        ));
    }

    function theHTML($attr) {
        wp_enqueue_script('quizeFrontScript', plugin_dir_url(__FILE__) . 'build/frontend.js', array('wp-element'));
        wp_enqueue_style('quizeFrontStyle', plugin_dir_url(__FILE__) . 'build/frontend.css');
        ob_start(); ?>
            <div class="quize-box"><pre><?= wp_json_encode($attr); ?></pre></div>
        <? return ob_get_clean();
    }
}

$quize = new Quize();