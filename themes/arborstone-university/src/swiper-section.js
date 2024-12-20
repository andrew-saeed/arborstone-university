import Swiper, {Pagination} from 'swiper';

export default () => {
    const swiper = new Swiper('.swiper', {
        modules: [Pagination],
        pagination: {
            el: '.swiper-pagination',
            clickable: true
        },
    })
}