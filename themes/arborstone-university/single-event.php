<? get_header(); ?>

<? while( have_posts() ): the_post(); ?>

    <? pageBanner(); ?>
    
    <main>
        <div id="main-box">
            <nav id="breadcrumb" aria-label="breadcrumb">
                <ul>
                    <li><a class="capitalize" href="<?= get_post_type_archive_link('event'); ?>">events</a></li>
                    <li aria-current="page"><? the_title(); ?></li>
                </ul>
            </nav>
            
            <div id="main-content">
                <? the_content(); ?>
            </div>

            <? 
                $relatedPrograms = get_field('related_programs');
                if($relatedPrograms):
            ?>
                <div id="related-programs" class="mt-12">
                    <h2 class="text-large leading-large text-black-light capitalize">related programs</h2>
                    <ul class="flex gap-x-2 flex-wrap mt-2">
        
                        <? foreach($relatedPrograms as $program): ?>
                            
                            <h3>
                                <a class="btn btn--small btn--outline" href="<?= get_the_permalink($program); ?>">
                                    <?= get_the_title($program); ?>
                                </a>
                            </h3>
                                
                        <? endforeach; ?>
                    </ul>
                </div>
            <? endif; ?>
        </div>
    </main>
<? endwhile; ?>

<? get_footer(); ?>