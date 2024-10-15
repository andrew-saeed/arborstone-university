<? get_header(); ?>

<? pageBanner(); ?>

<main>
    <div id="main-box">
        <section class="posts-sample">
            <div class="posts-sample__box with-divider">
                <?  
                    $today = date('Ymd');
                    $olderEvents = new WP_Query(array(
                        'paged' => get_query_var('paged', 1),
                        'posts_per_page' => 3,
                        'post_type' => 'event',
                        'meta_key' => 'event_date',
                        'orderby' => 'meta_value_num',
                        'order' => 'DES',
                        'meta_query' => array(
                            array(
                                'key' => 'event_date',
                                'compare' => '<',
                                'value' => $today,
                                'type' => 'numeric'
                            )
                        )
                    ));

                    while($olderEvents->have_posts()) {
                        $olderEvents->the_post();
                        get_template_part('template-parts/event');
                    }
                    
                    wp_reset_postdata();
                ?>
            </div>
        </section>
        <section class="text-center text-base-1 text-black-dark mt-8 [&_span]:text-black-light [&_span]:font-black">
            <?= paginate_links(array(
                'total' => $olderEvents->max_num_pages
            )); ?>
        </section>
    </div>
</main>

<? get_footer(); ?>