<?

function relatedPostsHTML($id) {
    $posts = new WP_Query([
        'posts_per_page' => -1,
        'post_type' => 'post',
        'meta_query' => [
            [
                'key' => 'featuredProfessor',
                'compare' => '=',
                'value' => $id
            ]
        ]
    ]);

    ob_start(); 
    if($posts->found_posts): ?>

        <div id="mentioned-in">
            <p>mentioned in the posts:</p>
            <ul>
                <? while($posts->have_posts()): $posts->the_post(); ?>
                    <li>
                        <div class="links">
                            <a href="<? the_permalink(); ?>"><? the_title(); ?></a>
                        </div>
                    </li>
                <? endwhile; ?>
            </ul>
        </div>

    <? endif;
    wp_reset_postdata();
    return ob_get_clean();
}