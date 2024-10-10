<? get_header(); ?>

<section id="page-banner">
    <div id="page-banner__bg"style="background-image: url(<? echo get_theme_file_uri('/images/office.webp') ?>)"></div>
    <div id="page-banner__box">
        <h1 id="page-banner__title">all events</h1>
        <p id="page-banner__intro"><? echo strip_tags(get_the_archive_description()); ?></p>
    </div>
</section>

<main>
    <div id="main-box" class="[&_article_a:hover]:underline">
        <section class="posts-sample">
            <div class="posts-sample__box with-divider">
                <? while( have_posts() ): the_post(); ?>
                    <div class="posts-sample__item">
                        <div class="posts-sample__item__date style--blue">
                            <span class="date__month"><? the_time('M'); ?></span>
                            <span class="date__day"><? the_time('d'); ?></span>
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
    </div>
</main>

<? get_footer(); ?>