jQuery(window).load(() => {
    const flexslider = jQuery('.flexslider')
    const showBullets = jQuery('.flexslider').data('showBullets')
    flexslider.flexslider({
        animation: 'slide',
        touch: true,
        directionNav: false,
        smoothHeight: true,
        controlNav: showBullets
    })
})