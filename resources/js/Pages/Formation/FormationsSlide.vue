<template>
    <div class="formation-s">
        <div class="mb-5">
            <h2 class="">Nos Formations</h2>
            <div class=" grid place-items-center"><div class="border border-blue-600 w-3/4 lg:w-1/4"></div></div>
        </div>
        
        <Swiper class="swiper "
            :navigation="true"
            :slidesPerView="'auto'"
            :space-between="10"
            :centeredSlides="true"
            :coverflowEffect="{
                rotate: 50,
                stretch: 0,
                depth: 100,
                modifier: 1,
                slideShadows: false,
            }"
            :autoplay="{
                delay: 3000,
                disableOnInteraction: false,
            }"
            :speed="1000"
            :modules="modules"
            :breakpoints="{
                '640': {
                  slidesPerView: 2,
                  spaceBetween: 20,
                },
                '768': {
                  slidesPerView: 3,
                  spaceBetween: 20,
                },
                
            }"
            :effect="'coverflow'"
            :grabCursor="true"
            :loop="true"
        >
            <swiper-slide v-for="(formation, chunkIndex) in formations" 
            :key="chunkIndex"
             >
                <FormationCard :formation="formation"></FormationCard>
            </swiper-slide>

        </Swiper>

        

    </div>
</template>

<script>
 import 'swiper/css/navigation';
    import "swiper/css/effect-flip";
    import { Swiper, SwiperSlide } from 'swiper/vue';
    import { Autoplay, Pagination, Navigation, EffectFade, EffectCoverflow, EffectFlip } from 'swiper/modules';
    import 'swiper/css/pagination';
    import 'swiper/css/effect-fade';  
    import 'swiper/css';
    import FormationCard from './FormationCard.vue';
    import 'swiper/css/virtual';
    import 'swiper/css/effect-coverflow';

    export default {
        props: ['formations'],
        components: { FormationCard, Swiper, SwiperSlide, Pagination, Navigation, EffectFade, EffectCoverflow, EffectFlip },
        data(){
            return {
                /* arrayOfArrays: [] */
            }
        },
        setup() {
            return {
                modules: [Autoplay, EffectFade, Pagination, Navigation, EffectCoverflow, EffectFlip]
            }
        },
    }
</script>

<style lang="scss" scoped>
.formation-s{
    width: 90%;
    height: 100%;
    h2{
        text-align: center;
    }
}
.swiper {
    width: 100%;
    height: fit-content;
    
}

.swiper-slide {
  margin-top: 0;
  padding-top: 20px;
  padding-bottom: 20px;
  display: flex;
  justify-content: center;
  align-items: center;
}
.swiper-button-next, .swiper-button-prev{
    color: #fc4a1a;
}
</style>