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
            <nav id="breadcrumb" class="absolute top-0 left-0 translate-x-2 -translate-y-1/2" aria-label="breadcrumb">
                <ul class="bg-white-dark flex items-center text-sm-1 border border-white-dark rounded-md shadow-base">
                    <li><a class="inline-block bg-black-dark text-white-light capitalize px-4 py-3 rounded-l-md rounded-bl-md hover:bg-black-light" href="<? echo site_url('/blog'); ?>">articles</a></li>
                    <li aria-current="page" class="meta-box text-black-light font-light p-2">
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