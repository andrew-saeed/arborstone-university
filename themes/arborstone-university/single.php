<? get_header(); ?>

<? $pageParent = wp_get_post_parent_id(get_the_ID()); ?>

<? while( have_posts() ): the_post(); ?>

    <section id="page-banner">
        <div id="page-banner__bg"style="background-image: url(<? echo get_theme_file_uri('/images/office.webp') ?>)"></div>
        <div id="page-banner__box">
            <h1 id="page-banner__title"><? the_title(); ?></h1>
            <p id="page-banner__intro">Lorem ipsum dolor sit amet consectetur adipisicing elit. Soluta!</p>
        </div>
    </section>
    
    <main>
        <div id="main-box">
            <nav id="breadcrumb" aria-label="breadcrumb">
                <ul>
                    <li><a class="capitalize" href="<? echo site_url('/blog'); ?>">articles</a></li>
                    <li aria-current="page">
                        By <? the_author_posts_link(); ?> on <? the_time('n.j.y') ?> in <? echo get_the_category_list(', '); ?>
                    </li>
                </ul>
            </nav>
            
            <div id="main-content">
                <? the_content(); ?>
            </div>
        </div>
    </main>
<? endwhile; ?>

<? get_footer(); ?>