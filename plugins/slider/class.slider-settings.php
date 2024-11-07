<?

class Slider_Settings {
    public static $options;

    function __construct() {
        self::$options = get_option('slider_options');
        add_action('admin_init', [$this, 'admin_init']);
    }

    function admin_init() {
        register_setting('slider_group', 'slider_options', [$this, 'slider_validate']);

        add_settings_section(
            'slider_main_section',
            'How does it work?',
            null,
            'slider_page1'
        );

        add_settings_section(
            'slider_second_section',
            'Other Plugin Options',
            null,
            'slider_page2'
        );

        add_settings_field(
            'slider_shortcode',
            'Shortcode',
            [$this, 'slider_shortcode_callback'],
            'slider_page1',
            'slider_main_section',
            [
                'label_for' => 'slider_shortcode'
            ]
        );

        add_settings_field(
            'slider_title',
            'Slider Title',
            [$this, 'slider_title_callback'],
            'slider_page2',
            'slider_second_section',
            [
                'label_for' => 'slider_title'
            ]
        );

        add_settings_field(
            'slider_bullets',
            'Display Bullets',
            [$this, 'slider_bullets_callback'],
            'slider_page2',
            'slider_second_section',
            [
                'label_for' => 'slider_bullets'
            ]
        );

        add_settings_field(
            'slider_style',
            'Slider Styles',
            [$this, 'slider_styles_callback'],
            'slider_page2',
            'slider_second_section',
            [
                'items' => ['style 1', 'style 2'],
                'label_for' => 'slider_style'
            ]
        );
    }

    function slider_shortcode_callback() { ?>
        <span>this is shortcode callback</span>
    <? }

    function slider_title_callback() { ?>
        <input 
            type="text"
            name="slider_options[slider_title]"
            id="slider_title"
            value="<?= esc_attr(self::$options['slider_title'] ?? ''); ?>"
        />
    <? }

    function slider_bullets_callback() { ?>
        <input 
            type="checkbox"
            name="slider_options[slider_bullets]"
            id="slider_bullets"
            value="1"
            <?  if(isset(self::$options['slider_bullets'])): checked("1", self::$options['slider_bullets'], true); endif; ?>
        />
    <? }

    function slider_styles_callback($args) { ?>
        <select
            id="slider_style"
            name="slider_options[slider_style]"
        >
            <option 
                value=""
                disabled
                <?= !isset(self::$options['slider_style']) ? 'selected' : ''; ?>
            >Select</option>
            <? foreach($args['items'] as $item): ?>
                <option 
                    value="<?= esc_attr($item); ?>"
                    <? if(isset(self::$options['slider_style'])): selected($item, self::$options['slider_style'] , true); endif; ?>
                ><?= esc_html(ucfirst($item)); ?></option>
            <? endforeach; ?>
        </select>
    <? }

    function slider_validate($inputs) {
        $validated_inputs = [];
        foreach ($inputs as $key => $value) {
            switch ($key) {
                case 'slider_title':
                    if(empty($value)) {
                        add_settings_error('slider_options', 'slider_message', 'The field Title is empty!', 'error');
                    }
                    $validated_inputs[$key] = sanitize_text_field($value);
                default:
                    $validated_inputs[$key] = sanitize_text_field($value);
                break;
            }
        }
        return $validated_inputs;
    }
}