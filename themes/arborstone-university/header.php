<!DOCTYPE html>
<html lang="en">
<head>
    <? if( !is_wp_error(wp_remote_get(HMR_HOST)) ): ?>
        <script type="module" src="<? echo HMR_HOST . '@vite/client'; ?>"></script>
    <? endif; ?>
    <? wp_head(); ?>
</head>
<body class="font-inter">
    <nav>
        <p class="text-4xl font-bold capitalize"><a href="<? echo site_url(); ?>">arborstone university</a></p>
        <ul>
            <li class="text-2xl capitalize"><a href="<? echo site_url('/about-us'); ?>">about us</a></li>
            <li class="text-2xl capitalize"><a href="<? echo site_url('/programs'); ?>">programs</a></li>
            <li class="text-2xl capitalize"><a href="<? echo site_url('/events'); ?>">events</a></li>
            <li class="text-2xl capitalize"><a href="<? echo site_url('/campuses'); ?>">campuses</a></li>
            <li class="text-2xl capitalize"><a href="<? echo site_url('/blog'); ?>">blog</a></li>
        </ul>
    </nav>