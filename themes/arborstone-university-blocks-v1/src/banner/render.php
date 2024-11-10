<?

if (!isset($attributes['imgURL'])) {
    $attributes['imgURL'] = get_theme_file_uri('/images/fallback-hero-image.jpg');
}

?>

<div class="page-banner">
    <div class="page-banner__bg-image" style="background-image: url('<?= $attributes['imgURL'] ?>')"></div>
    <div class="page-banner__content">
        <?= $content; ?>
    </div>
</div>