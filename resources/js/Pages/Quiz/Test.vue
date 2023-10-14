<template>
    <MainLayout>
        <div class="mt-20 mx-40">
            <h1 class="text-center mt-5">{{ test.titre }}</h1>
            <!-- <ProgressBar></ProgressBar> -->
            <div class="relative">
                <div class="previous" @click="i>0? i--: ''" v-if="i>0">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10" :class="[i>0? 'fill-blue-600 cursor-pointer' : 'fill-slate-400']" viewBox="0 0 24 24">
                        <path d="M12 2C17.52 2 22 6.48 22 12C22 17.52 17.52 22 12 22C6.48 22 2 17.52 2 12C2 6.48 6.48 2 12 2ZM12 11V8L8 12L12 16V13H16V11H12Z"></path>
                    </svg>
                </div>
                
                <div v-for="(quiz, index) in test.quizzes">
                    <Quiz :quiz="quiz" v-if="index==i" @validate="new_submitted++"></Quiz>
                </div>
                <div v-if="$page.props.auth.user && test.quizzes.length">
                    <div class="next" @click="(i< new_submitted || $page.props.canAdministrate) && i < test.quizzes.length - 1? i++: ''"
                        v-if="(i< new_submitted || $page.props.canAdministrate) && i < this.test.quizzes.length - 1"
                    >
                        
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10" :class="[(i< new_submitted || $page.props.canAdministrate) && i < this.test.quizzes.length - 1? 'fill-blue-600 cursor-pointer' : 'fill-slate-400']" viewBox="0 0 24 24">
                            <path d="M12 2C17.52 2 22 6.48 22 12C22 17.52 17.52 22 12 22C6.48 22 2 17.52 2 12C2 6.48 6.48 2 12 2ZM12 11H8V13H12V16L16 12L12 8V11Z"></path>
                        </svg>
                    </div>
                </div>
                <!-- <div v-else class="next">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 fill-slate-400" viewBox="0 0 24 24">
                        <path d="M12 2C17.52 2 22 6.48 22 12C22 17.52 17.52 22 12 22C6.48 22 2 17.52 2 12C2 6.48 6.48 2 12 2ZM12 11H8V13H12V16L16 12L12 8V11Z"></path>
                    </svg>
                </div> -->
                
            </div>
            
            <div class="flex justify-center">
                <LevelProgress :len="test.quizzes.length" :submitted_len="new_submitted" @level="toLevel" :current="i+1" class="w-4/5"></LevelProgress>

            </div>

            
        </div>
    </MainLayout>
    
</template>

<script>
    import MainLayout from '@/Layouts/MainLayout.vue';
    import Quiz from './Quiz.vue';
    import ProgressBar from '@/Components/ProgressBar.vue';
    import { Swiper, SwiperSlide } from 'swiper/vue';
    import 'swiper/css/effect-creative';
    //import { Navigation } from 'swiper';
    import 'swiper/css/pagination';
    import 'swiper/css';
    import { EffectCreative, Navigation } from 'swiper/modules';
import LevelProgress from './LevelProgress.vue';

    export default {
        components: { MainLayout, Quiz, ProgressBar, Swiper, SwiperSlide, LevelProgress },
        props: ['test','submitted_len', 'canPractice'],
        data() {
            return {
                i: 0,
                level: this.test.quizzes[0],
                new_submitted: this.submitted_len
            }
        },
        mounted(){
            if(this.submitted_len){
                if(this.submitted_len < this.test.quizzes.length)
                    this.i= this.submitted_len
                else
                    this.i= this.submitted_len - 1
            }
            
        },
        methods: {
            toLevel(e){
                this.i= e-1
            }
        }
    
    }
</script>

<style lang="scss" scoped>
    .previous{
        position: absolute;
        top: 50%;
        left: -50px;
        transform: translateY(-50%);
    }
    .next{
        position: absolute;
        top: 50%;
        right: -50px;
        transform: translateY(-50%);
    }
</style>