<? get_header(); ?>

<section id="page-banner">
    <div id="page-banner__bg"style="background-image: url(<? echo get_theme_file_uri('/images/office.webp') ?>)"></div>
    <div id="page-banner__box">
        <h1 id="page-banner__title"><? the_title(); ?></h1>
        <p id="page-banner__intro"><?= get_the_excerpt(); ?></p>
    </div>
</section>

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

                    while($olderEvents->have_posts()): $olderEvents->the_post();

                    $eventDate = new DateTime(get_field('event_date'));
                ?>
                    <div class="posts-sample__item">
                        <div class="posts-sample__item__date style--blue">
                            <span class="date__month"><?= $eventDate->format('M'); ?></span>
                            <span class="date__day"><?= $eventDate->format('d'); ?></span>
                        </div>
                        <div class="posts-sample__item__info">
                            <h5 class="item__title">
                                <a href="<? the_permalink(); ?>"><? the_title() ?></a>
                            </h5>
                            <p class="item__excerpt"><? echo get_the_excerpt(); ?></p>
                            <a class="item__read-more" href="#">learn more</a>
                        </div>
                    </div>
                <? 
                    endwhile;
                    wp_reset_postdata();
                ?>
            </div>
        </section>
        <section class="text-center text-base-1 text-black-dark [&_span]:text-black-light [&_span]:font-black">
            <?= paginate_links(array(
                'total' => $olderEvents->max_num_pages
            )); ?>
        </section>
    </div>
</main>

<? get_footer(); ?>