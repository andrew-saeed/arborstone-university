<?

class Slider_Shortcode {
    function __construct() {
        add_shortcode('slider', [$this, 'add_shortcode']);
    }

    function add_shortcode($atts = [], $content = null, $tag = '') {

        $atts = array_change_key_case($atts, CASE_LOWER);

        extract( shortcode_atts(
            array(
                'id' => '',
                'orderby' => ''
            ),
            $atts,
            $tag
        ));

        if(!empty($id)) {
            $id = array_map('absint', explode(',', $id));
        }

        ob_start();
        require(SLIDER_PATH . 'view.slider.php');
        wp_enqueue_script('main');
        wp_enqueue_script('settings');
        wp_enqueue_style('main-style');
        wp_enqueue_style('base-style');
        return ob_get_clean();
    }
}