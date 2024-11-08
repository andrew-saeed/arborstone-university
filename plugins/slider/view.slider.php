<h3>
    <?= (!empty($content)) ? esc_html($content) : esc_html(Slider_Settings::$options['slider_title']); ?>
</h3>
<div 
    class="flexslider <?= Slider_Settings::$options['slider_style'] ?? 'style-1' ?>"
    data-show-bullets="<?= (isset(Slider_Settings::$options['slider_bullets']) && Slider_Settings::$options['slider_bullets'] == '1') ? 'true' : 'false'; ?>"
>
    <ul class="slides">

        <? 
        
            $slidesQuery = new WP_Query([
                'post_type' => 'slider',
                'post_status' => 'publish',
                'post__in' => $id,
                'orderby' => $orderby
            ]);

            while($slidesQuery->have_posts()): $slidesQuery->the_post();
            $button_text = get_post_meta(get_the_ID(), 'slider_link_text', true);
            $button_url = get_post_meta(get_the_ID(), 'slider_link_url', true);
        ?>

        <li>
            <? 
                if(has_post_thumbnail()) {
                    the_post_thumbnail('full', ['class' => 'img-fluid']);
                } else {
                    echo "<img src='" . SLIDER_URL . 'assets/default.jpg' . "' />";
                }
            ?>
            <div class="slider-container">
                <div class="slider-details-container">
                    <div class="wrapper">
                        <div class="slider-title">
                            <h2><?= the_title(); ?></h2>
                        </div>
                        <div class="slider-description">
                            <div class="subtitle"><? the_content(); ?></div>
                            <a href="<?= esc_attr($button_url); ?>" class="link"><?= esc_html($button_text); ?></a>
                        </div>
                    </div>
                </div>
            </div>
        </li>

        <?
            endwhile; 
            wp_reset_postdata();
        ?>
    </ul>
</div>