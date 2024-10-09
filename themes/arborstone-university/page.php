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
            <? if($pageParent): ?>
                <nav id="breadcrumb" class="invisible lg:visible absolute top-0 left-0 translate-x-2 -translate-y-1/2" aria-label="breadcrumb">
                    <ul class="bg-white-dark flex items-center text-sm-1 border border-white-dark rounded-md shadow-base">
                        <li><a class="inline-block bg-black-dark text-white-light px-4 py-3 rounded-l-md rounded-bl-md hover:bg-black-light" href="<? echo get_permalink($pageParent); ?>">Back to <? echo get_the_title($pageParent); ?></a></li>
                        <li aria-current="page"><span class="inline-block text-black-dark px-4 py-3 rounded-r-md rounded-br-md"><? the_title(); ?></span></li>
                    </ul>
                </nav>
            <? endif; ?>
            
            <?  $hasChildren = get_pages(array('child_of' => get_the_ID())); 
                if($hasChildren or $pageParent):
            ?>
                <nav id="side-nav" class="inline-block lg:float-right w-full lg:max-w-xs lg-left-bottom-right-bottom-margin-2 border-2 border-white-dark mb-8" aria-label="side-nav">
                    <ul class="text-center">
                        <?  if($pageParent) {
                                $currentParent = $pageParent;
                            } else {
                                $currentParent = get_the_ID();
                            }
                        ?>
                        <li><a href="<? echo get_the_permalink($currentParent); ?>" class="block bg-black-dark text-medium-1 text-white-light py-5 hover:bg-black-light"><? echo get_the_title($currentParent); ?></a></li>
                        <? wp_list_pages(array('title_li'=> NULL, 'child_of'=> $currentParent)); ?>
                    </ul>
                </nav>
            <? endif; ?>

            <div id="main-content">
                <? the_content(); ?>
            </div>
        </div>
    </main>
<? endwhile; ?>

<? get_footer(); ?>