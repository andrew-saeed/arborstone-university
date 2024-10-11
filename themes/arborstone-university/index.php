<? get_header(); ?>

<section id="page-banner">
    <div id="page-banner__bg"style="background-image: url(<? echo get_theme_file_uri('/images/office.webp') ?>)"></div>
    <div id="page-banner__box">
        <h1 id="page-banner__title">Blog</h1>
        <p id="page-banner__intro">Lorem ipsum dolor sit amet consectetur adipisicing elit. Soluta!</p>
    </div>
</section>

<main>
    <div id="main-box" 
        class="divide-y-2 divide-white-dark
        [&_article]:py-12 [&_article:first-of-type]:pt-0 [&_article:last-of-type]:pb-0"
    >
        <? while( have_posts() ): the_post(); ?>
            <article class="space-y-4">
                <header>
                    <h2 class="text-large leading-large capitalize">
                        <a href="<? the_permalink(); ?>"><? the_title(); ?></a>
                    </h2>
                    <p class="inline-block bg-white-dark text-base-1 text-black-light font-light capitalize p-2 mt-4 shadow-base [&_a]:font-bold">
                        By <? the_author_posts_link(); ?> on <? the_time('n.j.y') ?> in <? echo get_the_category_list(', '); ?>
                    </p>
                </header>
                <div class="[&_p]:text-base-1 [&_p]:leading-base-1">
                    <? the_excerpt(); ?>
                </div>
                <p><a class="text-base-1 font-bold capitalize" href="<? the_permalink(); ?>">read more</a> ...</p>
            </article>
        <? endwhile; ?>
    </div>
</main>

<? get_footer(); ?>