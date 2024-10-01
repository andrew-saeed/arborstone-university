<?

define('HMR_HOST', 'http://localhost:4200/wp-content/themes/arborstone-university/');

function theme_files() {

    $js = '';
    $style = '';
    
    if( !is_wp_error(wp_remote_get(HMR_HOST)) ) {
        $js = HMR_HOST . 'src/main.js';
        $style = HMR_HOST . 'src/style.scss';
    } else {
        $manifest = [];
        $path = dirname(__FILE__) . '/dist/manifest.json';
        if(empty($path) || !file_exists($path)) {
            wp_die('Run: <code>`npm run build`</code> in your application root!');
        }
        $manifest = json_decode(file_get_contents($path), true);
        $js = get_theme_file_uri('/dist/' . $manifest['src/main.js']['file']);
        $style = get_theme_file_uri('/dist/' . $manifest['src/style.scss']['file']);
    }

    wp_enqueue_script_module('theme_main_js', $js);
    wp_enqueue_style('theme_main_style', $style);
}

add_action('wp_enqueue_scripts', 'theme_files');