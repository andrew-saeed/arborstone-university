<? get_header(); ?>

<? while( have_posts() ): the_post(); ?>
    <h2 class="text-4xl font-bold"><a href="<? the_permalink(); ?>"><? the_title(); ?></a></h2>
<? endwhile; ?>

<? get_footer(); ?>