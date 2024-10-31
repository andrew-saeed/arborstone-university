<?

/*
    Plugin Name: Word Count Plugin
    Description: Count words, characters, and read time for a post and print the results
    Version: 0.0.1
    Author: Andrew Saeed
    Author URI: https://andrewsaeed.dev
*/

if( !defined('ABSPATH') ) exit;

class WordCount {

    function __construct() {
        add_action('admin_menu', array($this, 'adminSettingsPage'));
        add_action('admin_init', array($this, 'settings'));
        add_filter('the_content', array($this, 'doCount'));
    }

    function doCount($content) {
        if((is_main_query() AND is_single()) AND
        (
            get_option('wcp_wordcount', '1') OR
            get_option('wcp_charactercount', '1') OR
            get_option('wcp_readtime', '1')
        )) {
            return $this->createHTML($content);
        }
        return $content;
    }

    function createHTML($content) {
        $html = '<div id="post-statistics"><h3>' . esc_html(get_option('wcp_headline', 'Post Statistics')) . '</h3><p>';
        
        if(get_option('wcp_wordcount', '1') OR get_option('wcp_readtime', '1')) {
            $wordCount = str_word_count(strip_tags($content));
        }

        if(get_option('wcp_wordcount', '1')) $html .= $wordCount . ' words <br />';

        if(get_option('wcp_charactercount', '1')) $html .= strlen(strip_tags($content)) . ' characters <br />';

        if(get_option('wcp_readtime', '1')) $html .= round($wordCount/255) . ' minute(s) <br />';

        $html .= '</p></div>';

        if(get_option('wcp_location', '0') == '0') {
            return $html . $content;
        }

        return $content . $html;
    }

    function settings() {
        add_settings_section('wcp_first_section', null, null, 'word-count-settings');

        add_settings_field('wcp_location', 'Display Location', array($this, 'locationFieldHTML'), 'word-count-settings', 'wcp_first_section');
        register_setting('wordcountplugin', 'wcp_location', array('sanitize_callback' => array($this, 'sanitizeLocation'), 'default' => 0));

        add_settings_field('wcp_headline', 'Headline Text', array($this, 'headlineHTML'), 'word-count-settings', 'wcp_first_section');
        register_setting('wordcountplugin', 'wcp_headline', array('sanitize_callback' => 'sanitize_text_field', 'default' => 'Post Statistics'));

        add_settings_field('wcp_wordcount', 'Word Count', array($this, 'createCheckbox'), 'word-count-settings', 'wcp_first_section', array('name' => 'wcp_wordcount'));
        register_setting('wordcountplugin', 'wcp_wordcount', array('sanitize_callback' => 'sanitize_text_field', 'default' => '1'));

        add_settings_field('wcp_charactercount', 'Character Count', array($this, 'createCheckbox'), 'word-count-settings', 'wcp_first_section', array('name' => 'wcp_charactercount'));
        register_setting('wordcountplugin', 'wcp_charactercount', array('sanitize_callback' => 'sanitize_text_field', 'default' => '1'));

        add_settings_field('wcp_readtime', 'Read Time', array($this, 'createCheckbox'), 'word-count-settings', 'wcp_first_section', array('name' => 'wcp_readtime'));
        register_setting('wordcountplugin', 'wcp_readtime', array('sanitize_callback' => 'sanitize_text_field', 'default' => '1'));
    }

    function adminSettingsPage() {
        add_options_page('Word Count Settings', 'Word Count', 'manage_options', 'word-count-settings', array($this, 'pageHTML'));
    }

    function sanitizeLocation($input) {
        if($input != '0' AND $input != '1') {
            add_settings_error('wcp_location', 'wcp_location_error', 'Location must be 0 or 1');
            return get_option('wcp_location');
        }
        return $input;
    }

    function createCheckbox($args) { ?>
        <input type="checkbox" name="<?= $args['name'] ?>" value="1" <? checked(get_option($args['name']), '1'); ?> />
    <? }

    function headlineHTML() { ?>
        <input type="text" name="wcp_headline" value="<?= esc_attr(get_option('wcp_headline')); ?>" />
    <? }

    function locationFieldHTML() { ?>
        <select name="wcp_location">
            <option value="0" <? selected(get_option('wcp_location'), '0') ?>>Beginning of post</option>
            <option value="1" <? selected(get_option('wcp_location'), '1') ?>>End of post</option>
        </select>
    <? }

    function pageHTML() { ?>
        <div class="wrap">
            <h1>Word Count Admin</h1>
            <form action="options.php" method="POST">
                <?  
                    settings_fields('wordcountplugin');
                    do_settings_sections('word-count-settings');
                    submit_button();
                ?>
            </form>
        </div>
    <? }
}

$wordCounter = new WordCount();