<?

/*
    Plugin Name: Featured Professor Plugin
    Description: Wordpress plugin to select and show a featured professor
    Version: 0.0.1
    Author: Andrew Saeed
    Author URI: https://andrewsaeed.dev
*/

if( !defined('ABSPATH') ) exit;

class FeaturedProfessor {
    function __construct() {
        add_action('init', [$this, 'adminAssets']);
    }

    function adminAssets() {
        wp_register_style('featuredProfessorBlockStyle', plugin_dir_url(__FILE__) . 'build/index.css');
        wp_register_script('featuredProfessorBlockScript', plugin_dir_url(__FILE__) . 'build/index.js', array('wp-blocks', 'wp-element', 'wp-editor'));
        register_block_type('plugins/featured-professor', array(
            'editor_style' => 'featuredProfessorBlockStyle',
            'editor_script' => 'featuredProfessorBlockScript',
            'render_callback' => [$this, 'theHTML']
        ));
    }

    function theHTML($attr) {
        wp_enqueue_script('featuredProfessorFrontScript', plugin_dir_url(__FILE__) . 'build/frontend.js', array('wp-element'));
        wp_enqueue_style('featuredProfessorFrontStyle', plugin_dir_url(__FILE__) . 'build/frontend.css');
        ob_start(); ?>
            <div class="featured-professor-box"><pre><?= wp_json_encode($attr); ?></pre></div>
        <? return ob_get_clean();
    }
}

$featuredProfessor = new FeaturedProfessor();