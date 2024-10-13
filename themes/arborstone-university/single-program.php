<? get_header(); ?>

<? while( have_posts() ): the_post(); ?>

    <section id="page-banner">
        <div id="page-banner__bg"style="background-image: url(<? echo get_theme_file_uri('/images/office.webp') ?>)"></div>
        <div id="page-banner__box">
            <h1 id="page-banner__title"><? the_title(); ?></h1>
            <p id="page-banner__intro"><?= get_the_excerpt(); ?></p>
        </div>
    </section>
    
    <main>
        <div id="main-box">
            <nav id="breadcrumb" aria-label="breadcrumb">
                <ul>
                    <li><a class="capitalize" href="<? echo get_post_type_archive_link('program'); ?>">programs</a></li>
                    <li aria-current="page"><? the_title(); ?></li>
                </ul>
            </nav>
            
            <div id="main-content">
                <? the_content(); ?>
            </div>

            <? 
                $today = date('Ymd');
                $relatedEvents = new WP_Query(array(
                    'paged' => get_query_var('paged', 1),
                    'posts_per_page' => 3,
                    'post_type' => 'event',
                    'meta_key' => 'event_date',
                    'orderby' => 'meta_value_num',
                    'order' => 'DES',
                    'meta_query' => array(
                        array(
                            'key' => 'event_date',
                            'compare' => '>=',
                            'value' => $today,
                            'type' => 'numeric'
                        ),
                        array(
                            'key' => 'related_programs',
                            'compare' => 'LIKE',
                            'value' => '"' . get_the_ID() . '"'
                        )
                    )
                ));
                if($relatedEvents):
            ?>
                <div class="mt-12">
                    <h2 class="text-large leading-large font-light text-black-light capitalize tracking-wider">upcoming events</h2>
                    <section class="posts-sample">
                        <div class="posts-sample__box with-divider">
                            <?  
                                while($relatedEvents->have_posts()): $relatedEvents->the_post();
    
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
                </div>
            <? endif ?>
        </div>
    </main>
<? endwhile; ?>

<? get_footer(); ?>