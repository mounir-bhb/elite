<template>
    <MainLayout>
        <div class="sections">
            <!-- <div class="section">
                <Header></Header>
            </div> -->
            <div v-if="formations" class="section section-formation py-5 flex justify-center mt-20">
                <FormationsSlide :formations="formations" ></FormationsSlide>
            </div>
            
            <div class=" section">
                <Services></Services>
            </div>
            <!-- a propos -->
            <div class="section mx-20 shadow-lg bg-slate-50">
                <div class="flex items-center gap-5 mt-20 mx-10 objectif py-5">
                    <div class="w-1/2">
                        <h2 class="text-center ">Notre objectif</h2>
                        <div class=" grid place-items-center"><div class="border border-blue-600 w-3/4 lg:w-1/3"></div></div>
                        <div class="text-lg mt-5"
                            data-aos="flip-right"
                            data-aos-offset="0"
                            data-aos-delay="500"
                            data-aos-duration="700"
                            data-aos-easing="ease-in-out"
                            data-aos-mirror="false"
                            data-aos-once="false"
                        >
                            L'objectif principal d'Elite Corner est de rendre l'éducation accessible à tous les étudiants, indépendamment de leur lieu de résidence, de leur situation géographique ou de leurs contraintes de temps. La plateforme vise à éliminer les barrières traditionnelles à l'éducation et à offrir des opportunités d'apprentissage équitables pour tous, et de fournir aux étudiants un accès à des ressources éducatives complémentaires telles que des livres électroniques, des vidéos, des articles, etc., qui peuvent enrichir leur apprentissage et approfondir leur compréhension des sujets étudiés.
                        </div>
                    </div>
                    <div
                    class="w-1/2"
                        data-aos="zoom-out-left"
                        data-aos-offset="0"
                        data-aos-delay="500"
                        data-aos-duration="700"
                        data-aos-easing="ease-in-out"
                        data-aos-mirror="false"
                        data-aos-once="false"
                    >
                        <img src="/images/man.jpg" alt="" class="objectif-img">
                    </div>
                    
                </div>
                
            </div>
            <!-- contact -->
            <div>
                <Footer></Footer>
            </div>
        </div>
        
    </MainLayout>
</template>

<script>
import MainLayout from '@/Layouts/MainLayout.vue';
import FormationsSlide from './Formation/FormationsSlide.vue';
import Footer from '@/Components/Footer.vue';
import Header from '@/Components/Header.vue'
import Services from './Services.vue';

    export default {
    props: ['formations'],
    components: { MainLayout, FormationsSlide, Footer, Header, Services },
    
}
</script>

<style lang="scss" scoped>
    .sections{
        /* overflow: auto; */
        scroll-snap-type: y mandatory;
    }
    .section{
        scroll-snap-align: start;
        scroll-snap-stop: always;
    }
    .objectif-img{
        width: 100%;
        padding: 20px;
        transform: translateY(-50%);
        transform: rotate(5deg);
    }
    
    
</style>