<? get_header(); ?>

<? while( have_posts() ): the_post(); ?>

    <? pageBanner(); ?>
    
    <main>
        <div id="main-box">
            <div class="after:table after:clear-both">
                <div class="lg:float-left max-lg:text-center max-lg:mb-4">
                    <img class="inline-block lg-right-bottom-left-bottom-margin-2" src="<? the_post_thumbnail_url('professorPortrait'); ?>" alt="<? the_title(); ?>">
                </div>
                <div id="main-content">
                    <? the_content(); ?>
                </div>
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