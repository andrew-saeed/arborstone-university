<? get_header(); ?>

<? while( have_posts() ): the_post(); ?>
    <h1><? the_title(); ?></h1>
    <? the_content(); ?>
<? endwhile; ?>

<? get_footer(); ?>