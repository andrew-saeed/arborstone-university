import Swiper, {Pagination} from 'swiper';
import 'swiper/css';
import 'swiper/css/pagination';

export default () => {
    const swiper = new Swiper('.swiper', {
        modules: [Pagination],
        pagination: {
            el: '.swiper-pagination',
            clickable: true
        },
    })
}