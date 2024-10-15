<? get_header(); ?>

<? pageBanner(array(
    'title' => 'programs',
    'excerpt' => 'Find your major, ask for help if you need!'
)); ?>

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