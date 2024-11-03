<?

/*
    Plugin Name: Featured Professor Plugin
    Description: Wordpress plugin to select and show a featured professor
    Version: 0.0.1
    Author: Andrew Saeed
    Author URI: https://andrewsaeed.dev
*/

if( !defined('ABSPATH') ) exit;

require_once plugin_dir_path(__FILE__) . 'inc/professor-info.php';
require_once plugin_dir_path(__FILE__) . 'inc/professor-related-posts.php';

class FeaturedProfessor {
    function __construct() {
        add_action('init', [$this, 'adminAssets']);
        add_action('rest_api_init', [$this, 'createProfessorItemRoute']);
        add_filter('the_content', [$this, 'addRelatedPostsToProfessor']);
    }

    function addRelatedPostsToProfessor($content) {
        if(is_singular('professor') && in_the_loop() && is_main_query()) {
            return $content . relatedPostsHTML(get_the_id());
        }

        return $content;
    }

    function createProfessorItemRoute() {
        register_rest_route('featuredProfessor/v1', 'getProfessorItemHTML', [
            'methods' => WP_REST_SERVER::READABLE,
            'callback' => [$this, 'getProfessorItemHTML']
        ]);
    }

    function getProfessorItemHTML($data) {
        return professorInfo($data['id']);
    }

    function adminAssets() {
        register_meta('post', 'featuredProfessor', [
            'show_in_rest' => true,
            'type' => 'number',
            'single' => false
        ]);

        wp_register_style('featuredProfessorBlockStyle', plugin_dir_url(__FILE__) . 'build/index.css');
        wp_register_script('featuredProfessorBlockScript', plugin_dir_url(__FILE__) . 'build/index.js', array('wp-blocks', 'wp-element', 'wp-editor'));
        register_block_type('plugins/featured-professor', array(
            'editor_style' => 'featuredProfessorBlockStyle',
            'editor_script' => 'featuredProfessorBlockScript',
            'render_callback' => [$this, 'theHTML']
        ));
    }

    function theHTML($attr) {
        wp_enqueue_style('featuredProfessorBlockStyle', plugin_dir_url(__FILE__) . 'build/frontend.css');
        return professorInfo($attr['professorId']);
    }
}

$featuredProfessor = new FeaturedProfessor();