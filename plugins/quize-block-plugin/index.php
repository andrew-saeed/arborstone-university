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
        wp_register_script('quizeBlock', plugin_dir_url(__FILE__) . 'build/index.js', array('wp-blocks', 'wp-element'));
        register_block_type('quize/quize', array(
            'editor_script' => 'quizeBlock',
            'render_callback' => array($this, 'theHTML')
        ));
    }

    function theHTML($attr) { 
        ob_start(); ?>
            <div>
                <h4><?= $attr['question']; ?></h4>
                <ul>
                    <li><?= $attr['answer1']; ?></li>
                    <li><?= $attr['answer2']; ?></li>
                    <li><?= $attr['answer3']; ?></li>
                    <li><?= $attr['answer4']; ?></li>
                </ul>
            </div>
        <? return ob_get_clean();
    }
}

$quize = new Quize();