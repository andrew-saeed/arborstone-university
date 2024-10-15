<? $eventDate = new DateTime(get_field('event_date')); ?>

<div class="posts-sample__item">
    <div class="posts-sample__item__date style--blue">
        <span class="date__month"><?= $eventDate->format('M'); ?></span>
        <span class="date__day"><?= $eventDate->format('d'); ?></span>
    </div>
    <div class="posts-sample__item__info">
        <h5 class="item__title">
            <a href="<? the_permalink(); ?>"><? the_title(); ?></a>
        </h5>
        <p class="item__excerpt"><?= get_the_excerpt(); ?></p>
        <a class="item__read-more" href="<? the_permalink(); ?>">learn more</a>
    </div>
</div>