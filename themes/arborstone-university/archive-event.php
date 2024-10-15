<? get_header(); ?>

<? pageBanner(array(
    'title' => 'upcoming events',
    'excerpt' => 'see what is going on and be updated'
)); ?>

<main>
    <div id="main-box">
        <section class="posts-sample">
            <div class="posts-sample__box with-divider">
                <? 
                    while( have_posts() ): the_post();

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
                <? endwhile; ?>
            </div>
        </section>
        <section class="text-center mt-8">
            <a href="<?= site_url('/older-events'); ?>" class="btn btn--medium btn--outline !font-[400]">browse older events ...</a>
        </section>
    </div>
</main>

<? get_footer(); ?>