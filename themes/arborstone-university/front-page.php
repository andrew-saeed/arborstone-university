<? get_header(); ?>

<? $pageParent = wp_get_post_parent_id(get_the_ID()); ?>

<? while( have_posts() ): the_post(); ?>

    <section id="page-banner">
        <div id="page-banner__bg"style="background-image: url(<? echo get_theme_file_uri('/images/office.webp') ?>)"></div>
        <div id="page-banner__box" class="text-center">
            <h1 class="text-[6.25rem] leading-[6.25rem]">Welcome</h1>
            <h2 class="text-[3.125rem] leading[3.125rem]">We think you’ll like it here.</h2>
            <h3 class="text-medium-2 leading-medium-2">Lorem ipsum dolor sit amet consectetur adipisicing elit. Soluta!</h3>
            <div class="mt-8">
                <a class="btn btn--blue btn--large" href="#">Find Your Major</a>
            </div>
        </div>
    </section>
    
    <main>
        <div id="latest-events-and-blogs" class="grid lg:grid-cols-2">
            <section id="upcoming-events" class="posts-sample justify-center lg:justify-end">
                <div class="posts-sample__box">
                    <h4 class="posts-sample__title">Upcoming Events</h4>
                    <div class="posts-sample__item">
                        <div class="posts-sample__item__date style--blue">
                            <span class="date__month">mar</span>
                            <span class="date__day">25</span>
                        </div>
                        <div class="posts-sample__item__info">
                            <h5 class="item__title">
                                <a href="#">Poetry in the 100</a>
                            </h5>
                            <p class="item__excerpt">Bring poems you’ve wrote to the 100 building this Tuesday for an open mic and snacks</p>
                            <a class="item__read-more" href="#">learn more</a>
                        </div>
                    </div>
                    <div class="posts-sample__item">
                        <div class="posts-sample__item__date style--blue">
                            <span class="date__month">apr</span>
                            <span class="date__day">02</span>
                        </div>
                        <div class="posts-sample__item__info">
                            <h5 class="item__title">
                                <a href="#">Quad Picnic Party</a>
                            </h5>
                            <p class="item__excerpt">Live music, a taco truck and more can found in our third annual quad picnic day</p>
                            <a class="item__read-more" href="#">learn more</a>
                        </div>
                    </div>
                    <div class="text-center">
                        <a href="#" class="btn btn--blue btn--medium">view all events</a>
                    </div>
                </div>
            </section>
            <section id="from-our-blogs" class="posts-sample justify-center lg:justify-start bg-white-dark">
                <div class="posts-sample__box">
                    <h4 class="posts-sample__title">From Our Blogs</h4>
                    
                    <?  
                        $homepagePosts = new WP_Query(array(
                            'posts_per_page' => 2
                        ));

                        while($homepagePosts->have_posts()): $homepagePosts->the_post();
                    ?>
                        <div class="posts-sample__item">
                            <div class="posts-sample__item__date style--yellow">
                                <span class="date__month"><? the_time('M'); ?></span>
                                <span class="date__day"><? the_time('d'); ?></span>
                            </div>
                            <div class="posts-sample__item__info">
                                <h5 class="item__title">
                                    <a href="<? the_permalink(); ?>"><? the_title() ?></a>
                                </h5>
                                <p class="item__excerpt"><? echo get_the_excerpt(); ?></p>
                                <a class="item__read-more" href="#">learn more</a>
                            </div>
                        </div>
                    <? 
                        endwhile;
                        wp_reset_postdata();
                    ?>
                    
                    <div class="text-center">
                        <a href="#" class="btn btn--yellow btn--medium">view all posts</a>
                    </div>
                </div>
            </section>
        </div>

        <div id="why-choose-us">
            <!-- Slider main container -->
            <div class="swiper">
                <!-- Additional required wrapper -->
                <div class="swiper-wrapper">
                    <!-- Slides -->
                    <div class="swiper-slide relative">
                        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-full md:w-3/4 bg-black/80 text-white-light text-center px-4 py-12 space-y-6">
                            <h4 class="text-medium-2 md:text-xlarge leading-xlarge">Free Transportation</h4>
                            <p class="text-base-1 leading-base-1">All students have free unlimited bus fare.</p>
                            <a href="#" class="btn btn--blue btn--medium">learn more</a>
                        </div>
                        <div class="h-[33.125rem] bg-cover bg-center" style="background-image: url(<? echo get_theme_file_uri('images/university-1.webp') ?>);"></div>
                    </div>
                    <div class="swiper-slide relative">
                        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-full md:w-3/4 bg-black/80 text-white-light text-center px-4 py-12 space-y-6">
                            <h4 class="text-medium-2 md:text-xlarge leading-xlarge">Free Food</h4>
                            <p class="text-base-1 leading-base-1">Arborstone University offers lunch plans for those in need</p>
                            <a href="#" class="btn btn--blue btn--medium">learn more</a>
                        </div>
                        <div class="h-[33.125rem] bg-cover bg-center" style="background-image: url(<? echo get_theme_file_uri('images/university-2.webp') ?>);"></div>
                    </div>
                    <div class="swiper-slide relative">
                        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-full md:w-3/4 bg-black/80 text-white-light text-center px-4 py-12 space-y-6">
                            <h4 class="text-medium-2 md:text-xlarge leading-xlarge">Meditation Day</h4>
                            <p class="text-base-1 leading-base-1">Meditation for all who need peace and tranquillity.</p>
                            <a href="#" class="btn btn--blue btn--medium">learn more</a>
                        </div>
                        <div class="h-[33.125rem] bg-cover bg-center" style="background-image: url(<? echo get_theme_file_uri('images/university-3.webp') ?>);"></div>
                    </div>
                </div>
                <!-- If we need pagination -->
                <div class="swiper-pagination"></div>
            </div>
        </div>
    </main>
<? endwhile; ?>

<? get_footer(); ?>