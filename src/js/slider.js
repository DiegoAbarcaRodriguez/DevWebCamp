/*import Swiper, {navigation} from 'swiper';
import 'swiper/css';
import 'swiper/css/navigation';
*/ //Uso con webpack y npm (bundler)

document.addEventListener('DOMContentLoaded',function(){
    if(document.querySelector('.slider')){
        opciones={
            slidesPerView:1,
            spaceBetween:15,
            freeMode:true,
            navigation:{
                nextEl:'.swiper-button-next',
                prevEl:'.swiper-button-prev'
            },
            breakpoints:{
                768:{
                    slidesPerView:2,
                },
                1024:{
                    slidesPerView:3,
                },
                1200:{
                    slidesPerView:4,
                }
            }
        };
        new Swiper('.slider',opciones);
        Swiper.use([navigation]);
        
    }
});