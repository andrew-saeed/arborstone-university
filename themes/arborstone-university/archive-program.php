<? get_header(); ?>

<section id="page-banner">
    <div id="page-banner__bg"style="background-image: url(<? echo get_theme_file_uri('/images/office.webp') ?>)"></div>
    <div id="page-banner__box">
        <h1 id="page-banner__title">programs</h1>
        <p id="page-banner__intro">Find your major, ask for help if you need!</p>
    </div>
</section>

<main>
    <div id="main-box">
        <section>
            <ul class="text-large leading-large text-black-light font-black divide-y-2 divide-white-dark [&_li]:py-12 [&_li:first-of-type]:pt-0">
                <? while( have_posts() ): the_post(); ?>
                    <li>
                        <a href="<? the_permalink(); ?>"><? the_title(); ?></a>
                    </li>
                <? endwhile; ?>
            </ul>
        </section>
    </div>
</main>

<? get_footer(); ?>