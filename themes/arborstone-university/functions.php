<?

define('HMR_HOST', 'http://localhost:4200/wp-content/themes/arborstone-university/');

function theme_files() {

    $js = '';
    $style = '';
    
    if( !is_wp_error(wp_remote_get(HMR_HOST)) ) {
        $js = HMR_HOST . 'src/main.js';
        wp_enqueue_script_module('theme_main_js', $js, [], false);

        $style = HMR_HOST . 'src/style.scss';
    } else {
        $manifest = [];
        $path = dirname(__FILE__) . '/dist/manifest.json';
        if(empty($path) || !file_exists($path)) {
            wp_die('Run: <code>`npm run build`</code> in your application root!');
        }
        $manifest = json_decode(file_get_contents($path), true);

        $js = get_theme_file_uri('/dist/' . $manifest['src/main.js']['file']);
        wp_enqueue_script('theme_main_js', $js, null, null, ['in_footer'=>true]);

        $style = get_theme_file_uri('/dist/' . $manifest['src/style.scss']['file']);
    }

    wp_enqueue_style('font-awesome', '//cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/fontawesome.min.css');
    wp_enqueue_style('google-fonts', '//fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap');
    wp_enqueue_style('theme_main_style', $style);
}

function theme_features() {
    add_theme_support('title-tag');
}

add_action('wp_enqueue_scripts', 'theme_files');
add_action('after_setup_theme', 'theme_features');