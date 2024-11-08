<?

function professorInfo($id) {
    $profPost = new WP_Query([
        'post_type' => 'professor',
        'p' => $id
    ]);

    while($profPost->have_posts()): $profPost->the_post();
    ob_start(); ?>

    <div class="featured-professor">
        <div class="featured-professor__box">
            <div class="content">
                <div class="image" style="background-image: url('<? the_post_thumbnail_url() ?>')"></div>
                <div class="text">
                    <div class="title"><? the_title(); ?></div>
                    <div class="description"><?= wp_trim_words(get_the_content(), 15); ?></div>
                    <div class="related-programs">
                        <span>Teaches: </span>
                        <? 
                            $relatedPrograms = get_field('related_programs');

                            foreach($relatedPrograms as $key => $program): ?>
                                <span><?= get_the_title($program); ?></span>
                                <? 
                                    if($key != array_key_last($relatedPrograms) && count($relatedPrograms) > 1) { echo ', '; }
                                ?>
                            <? endforeach;
                        ?>
                    </div>
                    <div class="links">
                        <a href="<? the_permalink(); ?>">about <? the_title() ?> &raquo;</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <? return ob_get_clean();
    endwhile;
    wp_reset_postdata();
}