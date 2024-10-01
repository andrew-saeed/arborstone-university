<!DOCTYPE html>
<html lang="en">
<head>
    <? if( !is_wp_error(wp_remote_get(HMR_HOST)) ): ?>
        <script type="module" src="<? echo HMR_HOST . '@vite/client'; ?>"></script>
    <? endif; ?>
    <? wp_head(); ?>
</head>
<body>
