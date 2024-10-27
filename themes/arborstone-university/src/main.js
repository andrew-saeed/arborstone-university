import Alpine from 'alpinejs'

import loadNavMenu from './nav-menu'
import overlayMask from './overlay-mask'
import swiperSection from './swiper-section'
import loadSearching from './searching'
import notesList from './notesList'
import professorLike from './professor-like'

window.onload = () => {

    // load mask
    overlayMask()
    // load swiper
    swiperSection()
    // load nav menu
    loadNavMenu()
    // load searching
    loadSearching()
    // load notes list
    notesList()
    // load professor like
    professorLike()

    // init alpinejs
    Alpine.start()
}