<?

add_action('wp_enqueue_scripts', 'theme_files');
add_action('after_setup_theme', 'theme_features');
add_action('init', 'theme_blocks');

function theme_files() {
    wp_enqueue_script('arbor-main-js', get_theme_file_uri('/build/index.js'), array('jquery'), '1.0', true);
    wp_enqueue_style('arbor-main-css', get_theme_file_uri('/build/index.css'));
}

function theme_features() {
    add_theme_support('editor-styles');
    add_editor_style(['build/index.css']);
}

function theme_blocks() {
    register_block_type_from_metadata(__DIR__ . '/build/footer');
    register_block_type_from_metadata(__DIR__ . '/build/header');
}