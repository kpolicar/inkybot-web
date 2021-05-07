import Swiper, { Autoplay, Lazy } from 'swiper';
// import Swiper styles
import 'swiper/swiper-bundle.css';

Swiper.use([Autoplay, Lazy]);

let swiperElement = document.querySelector('#swiper-exos');

if (swiperElement) {
    let swiper = new Swiper(swiperElement, {
        slidesPerView: 2,
        lazy: true,
        spaceBetween: 5,
        grabCursor: true,
        autoplay: {
            delay: 5000,
        },
        breakpoints: {
            1280: {
                slidesPerView: 3,
                spaceBetween: 10
            },
        }
    });

    swiperElement.classList.remove('opacity-0')
}
