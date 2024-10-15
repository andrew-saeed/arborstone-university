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
                    while( have_posts() ) {
                        the_post();
                        get_template_part('template-parts/event');
                    }
                ?>
            </div>
        </section>
        <section class="text-center mt-8">
            <a href="<?= site_url('/older-events'); ?>" class="btn btn--medium btn--outline !font-[400]">browse older events ...</a>
        </section>
    </div>
</main>

<? get_footer(); ?>