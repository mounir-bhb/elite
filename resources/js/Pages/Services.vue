<template>
    <div class="contain mb-20">
        <h2 class="text-center py-2">Nos services</h2>
        <div class=" grid place-items-center"><div class="border border-blue-600 w-3/4 lg:w-1/4"></div></div>
        <div class="mt-10">
            <Swiper class="swiper "
            :modules="modules"
            :slides-per-view="1"
            :space-between="30"
            :grabCursor="true"
            :loop="true"
            :autoplay="{
                delay: 5000,
                disableOnInteraction: false,
            }"
            :pagination="{
                clickable: true,
            }"
            :effect="'cube'"
            :cubeEffect="{
                shadow: true,
                slideShadows: true,
                shadowOffset: 20,
                shadowScale: 0.94,
            }"
            :speed="1500"
            >
                <swiper-slide>
                    <div class="flex items-center service ">
                        <img src="/images/online.jpg" alt="" >
                        <div class="desc">
                            <h3 class="text-center">Formation</h3>
                            <div class=" grid place-items-center"><div class="border border-white w-3/4 lg:w-1/3"></div></div>
                            <div class="text-lg mt-2">
                                Choisissez librement la formation de votre choix avec l'instructeur de votre préférence, quelle que soit la matière ou la filière. Vous pouvez le faire à tout moment, où que vous soyez. Des enseignants de toute l'Algérie créent des formations pour vous aider à améliorer votre niveau et à mieux comprendre.
                            </div>
                        </div>
                        
                    </div>
                </swiper-slide>
                <swiper-slide>
                    <div class="flex items-center service">
                        <div class="desc">
                            <h3 class="text-center">Exercice interactif</h3>
                            <div class=" grid place-items-center"><div class="border border-white w-3/4 lg:w-1/3"></div></div>
                            <div class="text-lg mt-2">
                                Grâce à notre large choix de quiz, vous avez la possibilité de vous exercer et de réviser autant que vous le souhaitez. Nos quiz couvrent toutes les matières de toutes les filières, en abordant toutes les questions possibles pour garantir un apprentissage optimal.
                            </div>
                        </div>
                        
                        <img src="/images/quiz.jpg" alt="">
                        
                    </div>
                </swiper-slide>
                <swiper-slide>
                    <div class="flex items-center service">
                        <img src="/images/forum.jpg" alt="" >
                        <div class="desc">
                            <h3 class="text-center">Forum de discution</h3>
                            <div class=" grid place-items-center"><div class="border border-white w-3/4 lg:w-1/2"></div></div>
                            <div class="text-lg mt-2">
                                Si vous avez besoin d'aide, n'hésitez pas à participer sur notre forum. Vous pouvez poser votre question ou vérifier si quelqu'un a déjà répondu à une question similaire à la vôtre. De plus, vous avez la possibilité d'aider en répondant aux questions d'autres personnes.
                            </div>
                        </div>
                    </div>
                </swiper-slide>
            </Swiper>
            
            
            
        </div>
    </div>
</template>

<script>
    import { Swiper, SwiperSlide } from 'swiper/vue';
    import { Autoplay, Pagination, EffectFade, EffectCreative, EffectCube } from 'swiper/modules';
    import "swiper/css/effect-cube";  
    import 'swiper/css/pagination';
    import 'swiper/css/effect-fade';
    import 'swiper/css/effect-creative';
    /* import 'swiper/css/navigation'; */
    import 'swiper/css';
    export default {
        components: { Swiper, SwiperSlide, Pagination, EffectFade, EffectCreative, EffectCube },
        setup() {
            return {
                modules: [Autoplay, Pagination, EffectFade, EffectCreative, EffectCube]
            }
        },
    }
</script>

<style lang="scss" scoped>
    .contain{
        margin-left: 150px;
        margin-right: 150px;
    }
    .service{
        background: rgb(4, 14, 158); /* fallback for old browsers */
        background: -webkit-linear-gradient(to left, rgb(4, 14, 158), rgb(0, 132, 255)); /* Chrome 10-25, Safari 5.1-6 */
        background: linear-gradient(to left, rgb(4, 14, 158), rgb(0, 132, 255));
        img{
            height: 250px;
        }
    }
    .desc{
        
        color: white;
        padding: 20px;
    }
</style>