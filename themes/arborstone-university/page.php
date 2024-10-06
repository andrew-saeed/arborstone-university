<? get_header(); ?>

<? $pageParent = wp_get_post_parent_id(get_the_ID()); ?>

<? while( have_posts() ): the_post(); ?>

    <section id="page-banner" class="relative text-white-light font-light pt-32 pb-20 px-4 bg-black">
        <div id="page-banner__bg" class="absolute top-0 left-0 right-0 bottom-0 bg-cover opacity-30" style="background-image: url(<? echo get_theme_file_uri('/images/office.webp') ?>)"></div>
        <div id="page-banner__box" class="relative z-10 max-w-screen-lg mx-auto">
            <h1 id="page-banner__title" class="leading-xxlarge mb-4"><? the_title(); ?></h1>
            <p id="page-banner__intro" class="text-medium-1 leading-medium-1">Lorem ipsum dolor sit amet consectetur adipisicing elit. Soluta!</p>
        </div>
    </section>
    
    <main>
        <div id="main-box" class="relative max-w-screen-lg mx-auto px-2">
            <? if($pageParent): ?>
                <nav class="absolute top-0 left-0 translate-x-2 -translate-y-1/2" aria-label="breadcrumb">
                    <ul class="bg-white-dark flex items-center text-sm-1 border border-white-dark rounded-md shadow-base">
                        <li><a class="inline-block bg-black-dark text-white-light px-4 py-3 rounded-l-md rounded-bl-md hover:bg-black-light" href="<? echo get_permalink($pageParent); ?>">Back to <? echo get_the_title($pageParent); ?></a></li>
                        <li aria-current="page"><span class="inline-block text-black-dark px-4 py-3 rounded-r-md rounded-br-md"><? the_title(); ?></span></li>
                    </ul>
                </nav>
            <? endif; ?>
            
            <?  $hasChildren = get_pages(array('child_of' => get_the_ID())); 
                if($hasChildren or $pageParent):
            ?>
                <nav class="inline-block float-right" aria-label="side-nav">
                    <ul>
                        <?  if($pageParent) {
                                $currentParent = $pageParent;    
                            } else {
                                $currentParent = get_the_ID();
                            }
                            wp_list_pages(array('title_li'=> NULL, 'child_of'=> $currentParent));
                        ?>
                    </ul>
                </nav>
            <? endif; ?>

            <div id="main-content" class="py-14 space-y-7 [&_p]:text-base-1 [&_p]:leading-base-1">
                <? the_content(); ?>
            </div>
        </div>
    </main>
<? endwhile; ?>

<? get_footer(); ?>