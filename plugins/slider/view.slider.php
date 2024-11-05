<? $postmeta = get_post_meta($post->ID); ?>

<table class="form-table slider-metabox">
<input type="hidden" name="slider_nonce" value="<?= wp_create_nonce('slider_nonce'); ?>" />
    <tr>
        <th>
            <label for="slider_link_text">Link Text</label>
        </th>
        <td>
            <input type="text" name="slider_link_text" id="slider_link_text" class="regular-text link-text" value="<?= esc_html($postmeta['slider_link_text'][0] ?? ''); ?>" required />
        </td>
    </tr>
    <tr>
        <th>
            <label for="slider_link_url">Link Url</label>
        </th>
        <td>
            <input type="text" name="slider_link_url" id="slider_link_url" class="regular-text link-url" value="<?= esc_url($postmeta['slider_link_url'][0] ?? ''); ?>" required />
        </td>
    </tr>
</table>