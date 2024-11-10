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
    wp_localize_script('wp-editor', 'themeData', ['path' => get_stylesheet_directory_uri()]);

    register_block_type_from_metadata(__DIR__ . '/build/header');
    register_block_type_from_metadata(__DIR__ . '/build/banner');
    register_block_type_from_metadata(__DIR__ . '/build/footer');
}

class JSXBlock {
    private $name;
    private $data;
    private $renderCallback;

    function __construct($name, $renderCallback = null, $data = null) {
        $this->name = $name;
        $this->data = $data;
        $this->renderCallback = $renderCallback;
        add_action('init', [$this, 'onInit']);
    }
  
    function renderCallback($attributes, $content) {
        ob_start();
        require get_theme_file_path("/blocks/{$this->name}.php");
        return ob_get_clean();
    }
  
    function onInit() {
        wp_register_script($this->name, get_stylesheet_directory_uri() . "/build/{$this->name}.js", array('wp-blocks', 'wp-editor'));
        
        if ($this->data) {
            wp_localize_script($this->name, $this->name, $this->data);
        }

        $baseArgs = array(
            'editor_script' => $this->name
        );

        if ($this->renderCallback) {
            $baseArgs['render_callback'] = [$this, 'renderCallback'];
        }

        register_block_type("arborstone/{$this->name}", $baseArgs);
    }
}
new JSXBlock('genericheading');
new JSXBlock('genericbutton');