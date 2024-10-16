import Alpine from 'alpinejs'

import loadNavMenu from './nav-menu'
import overlayMask from './overlay-mask'
import swiperSection from './swiper-section'
import loadSearching from './searching'

window.onload = () => {
    // init alpinejs
    Alpine.start()

    // load mask
    overlayMask()
    // load swiper
    swiperSection()
    // load nav menu
    loadNavMenu()
    // load searching
    loadSearching()
}