<? get_header(); ?>

<? $pageParent = wp_get_post_parent_id(get_the_ID()); ?>

<? while( have_posts() ): the_post(); ?>

    <? pageBanner(); ?>
    
    <main>
        <div id="main-box">
            <? if($pageParent): ?>
                <nav id="breadcrumb" class="invisible lg:visible" aria-label="breadcrumb">
                    <ul >
                        <li><a href="<? echo get_permalink($pageParent); ?>">Back to <? echo get_the_title($pageParent); ?></a></li>
                        <li aria-current="page"><? the_title(); ?></li>
                    </ul>
                </nav>
            <? endif; ?>

            <?  $hasChildren = get_pages(array('child_of' => get_the_ID())); 
                if($hasChildren or $pageParent):
            ?>
                <nav id="side-nav" aria-label="side-nav" class="inline-block lg:float-right w-full lg:max-w-xs lg-left-bottom-right-bottom-margin-2 border-2 border-white-dark mb-8">
                    <ul class="text-center">
                        <?  if($pageParent) {
                                $currentParent = $pageParent;
                            } else {
                                $currentParent = get_the_ID();
                            }
                        ?>
                        <li class="block bg-black-dark text-medium-1 text-white-light py-5 hover:bg-black-light"><a href="<? echo get_the_permalink($currentParent); ?>"><? echo get_the_title($currentParent); ?></a></li>
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