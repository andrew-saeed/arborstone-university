<? echo "Arborstone University"; ?>

<? while( have_posts() ): the_post(); ?>
    <h2><a href="<? the_permalink(); ?>"><? the_title(); ?></a></h2>
<? endwhile; ?>