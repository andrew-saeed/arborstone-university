<!DOCTYPE html>
<html <? language_attributes(); ?> dir="<? echo is_rtl() ? 'rtl' : 'ltr' ?>">
<head>
    <meta charset="<? bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <? if( !is_wp_error(wp_remote_get(HMR_HOST)) ): ?>
        <script type="module" src="<? echo HMR_HOST . '@vite/client'; ?>"></script>
    <? endif; ?>
    <? wp_head(); ?>
</head>
<body <? body_class('bg-white-light font-inter'); ?>>
    <header>
        <nav id="main-nav" class="absolute top-0 left-0 z-50 w-full">
            <div id="nav-layout"
                class="max-w-screen-xlg grid grid-cols-[max-content_1fr_max-content] items-center justify-items-center
                text-white-light font-bold capitalize
                mx-auto lg:p-2"
            >
                <div id="logo" 
                    class="w-full
                    row-start-1 row-end-2 col-start-2 col-end-3 lg:col-start-1 lg:col-end-2
                    text-center
                    py-2"
                >
                    <a class="logo_a font-black" href="<? echo site_url(); ?>">arborstone <span class="font-light">university</span></a>
                </div>
                <div id="trigger"
                    class="w-[2rem]
                    row-start-1 row-end-2 col-start-1 col-end-2 lg:hidden
                    cursor-pointer"
                    role="button"
                    tabindex="0"
                    aria-label="open menu"
                >
                    <svg width="100%" height="100%" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M4 18L20 18" stroke-width="2" stroke-linecap="round" class="stroke-white"></path>
                        <path d="M4 12L20 12" stroke-width="2" stroke-linecap="round" class="stroke-white"></path>
                        <path d="M4 6L20 6" stroke-width="2" stroke-linecap="round" class="stroke-white"></path>
                    </svg>
                </div>
                <ul id="links-list"
                    class="max-h-0 lg:!max-h-[unset] w-full
                    flex flex-col lg:flex-row lg:justify-end
                    row-start-2 row-end-3 lg:row-start-1 lg:row-end-2 col-start-1 col-end-4 lg:col-start-2 lg:col-end-3
                    md-left-right-padding-1
                    [&_li]:px-20 [&_li]:py-1 [&_li]:lg:p-0 [&_li:first-of-type]:mt-4 [&_li:last-of-type]:mb-4 [&_li:first-of-type]:lg:mt-0 [&_li:last-of-type]:lg:mb-0
                    overflow-hidden
                    transition-[max-height] duration-300 ease-in-out
                    [&.current-link]:bg-black"
                >
                    <li><a class="w-full block text-center font-bold p-2 md:!opacity-100 md:!translate-x-0 md:!delay-0 md:!duration-0 hover:text-white-dark <? echo (is_page('about-us') or wp_get_post_parent_id() == 19)? 'current-link':'' ?>" href="<? echo site_url('/about-us'); ?>">about us</a></li>
                    <li><a class="w-full block text-center font-bold p-2 md:!opacity-100 md:!translate-x-0 md:!delay-0 md:!duration-0 hover:text-white-dark <? echo is_page('programs')? 'current-link':'' ?>" href="<? echo site_url('/programs'); ?>">programs</a></li>
                    <li><a class="w-full block text-center font-bold p-2 md:!opacity-100 md:!translate-x-0 md:!delay-0 md:!duration-0 hover:text-white-dark <? echo is_page('events')? 'current-link':'' ?>" href="<? echo site_url('/events'); ?>">events</a></li>
                    <li><a class="w-full block text-center font-bold p-2 md:!opacity-100 md:!translate-x-0 md:!delay-0 md:!duration-0 hover:text-white-dark <? echo is_page('campuses')? 'current-link':'' ?>" href="<? echo site_url('/campuses'); ?>">campuses</a></li>
                    <li><a class="w-full block text-center font-bold p-2 md:!opacity-100 md:!translate-x-0 md:!delay-0 md:!duration-0 hover:text-white-dark <? echo get_post_type() === 'post'? 'current-link':'' ?>" href="<? echo site_url('/blog'); ?>">blog</a></li>
                </ul>
                <div 
                    id="ctrls"
                    class="row-start-1 row-end-2 col-start-3 col-end-4 h-full flex items-center gap-3"
                >
                    <div class="w-[2rem]">
                        <svg width="100%" height="100%" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">    
                            <path d="M15.7955 15.8111L21 21M18 10.5C18 14.6421 14.6421 18 10.5 18C6.35786 18 3 14.6421 3 10.5C3 6.35786 6.35786 3 10.5 3C14.6421 3 18 6.35786 18 10.5Z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="stroke-white"></path>
                        </svg>
                    </div>
                </div>
            </div>
        </nav>
    </header>