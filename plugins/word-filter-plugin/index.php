<?

/*
    Plugin Name: Word Filter Plugin
    Description: Filter words by creating your own list of reserved words and also convert the results to another text.
    Version: 0.0.1
    Author: Andrew Saeed
    Author URI: https://andrewsaeed.dev
*/

if( !defined('ABSPATH') ) exit;

class WordFilter {

    function __construct() {
        add_action('admin_menu', array($this, 'adminMenu'));
        add_action('admin_init', array($this, 'settings'));
        if(get_option('wf_words-list')) add_filter('the_content', array($this, 'doFilter'));
    }

    function settings() {
        add_settings_section('wf_first_section', null, null, 'word-filter-settings');

        add_settings_field('wf_target_text', 'Target Text', array($this, 'targetTextHTML'), 'word-filter-settings', 'wf_first_section');
        register_setting('wordfilterplugin', 'wf_target_text', array('sanitize_callback' => 'sanitize_text_field', 'default' => '****'));
    }

    function targetTextHTML() { ?>
        <input type="text" name="wf_target_text" value="<?= esc_attr(get_option('wf_target_text', '****')); ?>" />
    <? }

    function doFilter($content) {
        $wordsList = explode(',', get_option('wf_words-list'));
        $wordsListTrim = array_map('trim', $wordsList);
        return str_ireplace($wordsListTrim, esc_html(get_option('wf_target_text', '****')), $content);
    }
    
    function adminMenu() {
        $wf_menu = add_menu_page('', 'Word Filter', 'manage_options', 'word-filter', array($this, 'wordFilterHomePage'), plugin_dir_url(__FILE__) . 'icon.svg', 100);
        add_submenu_page('word-filter', '', 'Words List', 'manage_options', 'word-filter', array($this, 'wordFilterHomePage'));
        add_submenu_page('word-filter', '', 'Settings', 'manage_options', 'word-filter-settings', array($this, 'wordFilterSettingsPage'));
        add_action("load-{$wf_menu}", array($this, 'loadAssets'));
    }

    function loadAssets() {
        wp_enqueue_style('mainStyle', plugin_dir_url(__FILE__) . 'styles.css');
    }

    function handleForm() {
        if(isset($_POST['wfSaveNonce']) AND wp_verify_nonce($_POST['wfSaveNonce'], 'wfSave') AND current_user_can('manage_options')) {
            update_option('wf_words-list', sanitize_text_field($_POST['wf_words-list'])); ?>
            <div class="updated">
                <p>List of words were updated</p>
            </div>
        <? } else { ?>
            <div class="error">
                <p>You don't have permission to add filter words</p>
            </div>
        <? }
    }

    function wordFilterHomePage() { ?>
        <div class="wrap">
            <h1>Word Filter</h1>
            <? if(isset($_POST['submitted']) == 'submitted') $this->handleForm(); ?>
            <form method="POST">
                <input type="hidden" name="submitted" value="submitted" />
                <? wp_nonce_field('wfSave', 'wfSaveNonce'); ?>
                <label for="wf_words-list">Enter your list of words <strong>Comma-Separated</strong></label>
                <div class="wf_form-fields-box">
                    <textarea name="wf_words-list" id="wf_words-list" cols="4" rows="4"><?= esc_textarea(get_option('wf_words-list')); ?></textarea>
                </div>
                <input type="submit" name="submit" id="submit" class="button button-primary" />
            </form>
        </div>
    <? }

    function wordFilterSettingsPage() { ?>
        <div class="wrap">
            <h1>Word Count Admin</h1>
            <form action="options.php" method="POST">
                <?  
                    settings_errors();
                    settings_fields('wordfilterplugin');
                    do_settings_sections('word-filter-settings');
                    submit_button();
                ?>
            </form>
        </div>
    <? }
}

$wordFilter = new WordFilter();