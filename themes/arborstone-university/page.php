<? get_header(); ?>

<? $pageParent = wp_get_post_parent_id(get_the_ID()); ?>

<? while( have_posts() ): the_post(); ?>

    <header>
        <h1><? the_title(); ?></h1>

        <? if($pageParent): ?>
            <nav aria-label="breadcrumb">
                <ul class="flex gap-4">
                    <li><a href="<? echo get_permalink($pageParent); ?>"><? echo get_the_title($pageParent); ?></a></li>
                    <li aria-current="page"><? the_title(); ?></li>
                </ul>
            </nav>
        <? endif; ?>
    </header>
    
    <main>
        <?  $hasChildren = get_pages(array('child_of' => get_the_ID())); 
            if($hasChildren or $pageParent):
        ?>
            <nav aria-label="side-nav">
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
        <div id="main-content">
            <? the_content(); ?>
        </div>
    </main>
<? endwhile; ?>

<? get_footer(); ?>