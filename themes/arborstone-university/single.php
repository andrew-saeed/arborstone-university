<? get_header(); ?>

<? while( have_posts() ): the_post(); ?>

    <? pageBanner(); ?>
    
    <main>
        <div id="main-box">
            <nav id="breadcrumb" aria-label="breadcrumb">
                <ul>
                    <li><a class="capitalize" href="<?= site_url('/blog'); ?>">articles</a></li>
                    <li aria-current="page">
                        By <? the_author_posts_link(); ?> on <? the_time('n.j.y') ?> in <?= get_the_category_list(', '); ?>
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