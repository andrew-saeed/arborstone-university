import loadNavMenu from "./nav-menu"
import overlayMask from "./overlay-mask"
import swiperSection from "./swiper-section"

window.onload = () => {
    // init mask
    overlayMask()
    // init swiper
    swiperSection()
    // load nav menu
    loadNavMenu()
}