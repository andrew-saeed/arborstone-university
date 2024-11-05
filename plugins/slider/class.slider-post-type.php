<?

class Slider_Post_Type {
    function __construct() {
        add_action('init', [$this, 'create_post_type']);
        add_action('add_meta_boxes', [$this, 'add_meta_boxes']);
        add_action('save_post', [$this, 'save_post'], 10, 2);
        add_filter('manage_slider_posts_columns', [$this, 'slider_posts_columns_headers']);
        add_action('manage_slider_posts_custom_column', [$this, 'slider_posts_columns_values'], 10, 2);
        add_filter('manage_edit-slider_sortable_columns', [$this, 'slider_sortable_columns']);
    }

    function create_post_type() {
        register_post_type('slider', [
            'label' => 'Slider',
            'description' => 'Sliders',
            'labels' => [
                'name' => 'Sliders',
                'singular_name' => 'Slider'
            ],
            'public' => true,
            'supports' => ['title', 'editor', 'thumbnail'],
            'hierarchical' => false,
            'menu_position' => 5,
            'has_archive' => false,
            'show_in_rest' => true,
            'menu_icon' => 'dashicons-images-alt2'
        ]);
    }

    function add_meta_boxes() {
        add_meta_box(
            'slider_meta_box', 
            'Link Options', 
            [$this, 'add_inner_meta_boxes'],
            'slider',
            'normal',
            'high'
        );
    }

    function add_inner_meta_boxes($post) {
        require_once(SLIDER_PATH . 'view.slider.php');
    }

    function save_post($post_id) {

        if(isset($_POST['slider_nonce'])) {
            if(!wp_verify_nonce($_POST['slider_nonce'], 'slider_nonce')) {
                return;
            }
        }

        if(defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;

        if(isset($_POST['post_type']) && $_POST['post_type'] == 'slider') {
            if(!current_user_can('edit_page', $post_id)) {
                return;
            } elseif(!current_user_can('edit_post', $post_id)) {
                return;
            }
        }

        if(isset($_POST['action']) && $_POST['action'] == 'editpost') {
            $sliderLinkOldText = get_post_meta($post_id, 'slider_link_text', true);
            $sliderLinkNewText = $_POST['slider_link_text'] ?? '';
            $sliderLinkOldUrl = get_post_meta($post_id, 'slider_link_url', true);
            $sliderLinkNewUrl = $_POST['slider_link_url'] ?? '';

            if(empty($sliderLinkNewText)) {
                update_post_meta($post_id, 'slider_link_text', 'add link text');
            } else {
                update_post_meta($post_id, 'slider_link_text', sanitize_text_field($sliderLinkNewText), $sliderLinkOldText);
            }

            if(empty($sliderLinkNewUrl)) {
                update_post_meta($post_id, 'slider_link_url', 'add link url');
            } else {
                update_post_meta($post_id, 'slider_link_url', sanitize_text_field($sliderLinkNewUrl), $sliderLinkOldUrl);
            }
        }
    }

    function slider_posts_columns_headers($columns) {
        $columns['slider_link_text'] = esc_html__('Link Text', 'slider');
        $columns['slider_link_url'] = esc_html__('Link Url', 'slider');
        return $columns;
    }

    function slider_posts_columns_values($column, $post_id) {
        echo match ($column) {
            'slider_link_text'=> esc_html(get_post_meta($post_id, 'slider_link_text', true)),
            'slider_link_url'=> esc_html(get_post_meta($post_id, 'slider_link_url', true))
        };
    }

    function slider_sortable_columns($columns) {
        $columns['slider_link_text'] = 'slider_link_text';
        return $columns;
    }
}