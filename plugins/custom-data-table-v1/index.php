<?

/*
    Plugin Name: Custom Data Table Plugin
    Description: Create a custom data table for your wordpress website
    Version: 0.0.1
    Author: Andrew Saeed
    Author URI: https://andrewsaeed.dev
*/

if( !defined('ABSPATH') ) exit;

class CustomDataTable {
    private $charset;
    private $tablename;

    function __construct() {
        global $wpdb;
        $this->charset = $wpdb->get_charset_collate();
        $this->tablename = $wpdb->prefix . 'pets';

        add_action('activate_custom-data-table-v1/index.php', [$this, 'onActivate']);
        // add_action('admin_head', [$this, 'createData']);
        add_action('wp_enqueue_scripts', [$this, 'loadAssets']);
        add_action('admin_post_createPet', [$this, 'createPet']);
        add_action('admin_post_deletePet', [$this, 'deletePet']);
        add_filter('template_include', [$this, 'loadTemplate']);
    }

    function deletePet() {
        if(current_user_can('administrator')) {
            if(isset($_POST['id'])) $id = sanitize_text_field($_POST['id']);

            global $wpdb;
            $wpdb->delete($this->tablename, ['id' => $id]);
            wp_redirect(site_url('/custom-data-table'));
        } else {
            wp_redirect(site_url());
        }
    }

    function createPet() {
        if(current_user_can('administrator')) {
            $pet = [];
            $count = $_POST['count'];
            if(isset($_POST['petname'])) $pet['petname'] = sanitize_text_field($_POST['petname']);
            $pet['birthyear'] = 1990 + $count + 1;
            $pet['petweight'] = ($count + 1) * 10;
            $pet['favfood'] = "favfood " . $count + 1;
            $pet['favcolor'] = "favcolor " . $count + 1;

            global $wpdb;
            $wpdb->insert($this->tablename, $pet);
            wp_redirect(site_url('/custom-data-table'));
        } else {
            wp_redirect(site_url());
        }
    }

    function onActivate() {
        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');

        dbDelta("CREATE TABLE $this->tablename (
            id int(20) unsigned NOT NULL AUTO_INCREMENT,
            birthyear smallint(5) NOT NULL DEFAULT 0,
            petweight smallint(5) NOT NULL DEFAULT 0,
            favfood varchar(60) NOT NULL DEFAULT '',
            favcolor varchar(60) NOT NULL DEFAULT '',
            petname varchar(60) NOT NULL DEFAULT '',
            PRIMARY KEY (id)
        ) $this->charset;");
    }

    function createData() {
        global $wpdb;
        $wpdb->insert($this->tablename, [
            'birthyear' => 1111,
            'petweight' => 1111,
            'favfood' => 'favfood 1',
            'favcolor' => 'favcolor 1',
            'petname' => 'name 1'
        ]);
    }

    function loadTemplate($template) {
        if(is_page('custom-data-table')) {
            return plugin_dir_path(__FILE__) . 'inc/template.php';
        }
        return $template;
    }

    function loadAssets() {
        if(is_page('custom-data-table')) {
            wp_enqueue_style('customDataTableCSS', plugin_dir_url(__FILE__) . 'main.css');
        }
    }
}

$customDataTable = new CustomDataTable();