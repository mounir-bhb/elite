<template>
        <div class="shadow-lg px-4 py-6 my-8 bg-slate-100">
        <h2 class="text-center mb-6 underline" v-if="quiz.niveau">Niveau {{ quiz.niveau }}</h2>
        <div class="flex justify-around gap-16" v-if="quiz.questions.length">
            <div class="flex flex-col justify-around ">
                <div class="text-lg">question: {{ i+1 }} / {{ quiz.questions.length }} </div>
                <div class="text-lg">
                    fautes: {{ wrongs }} /3 <br>
                </div>
                <div class="text-lg">essai: {{ essai }} / 2</div>
                     <!-- <br>
                    can pass: {{ can_pass }} <br>
                    should_repeat: {{ should_repeat }} -->
                </div>
            <div class="quiz">
                <!-- <Swiper class="swiper "
                :navigation="true"
                :effect="'creative'"
                :creativeEffect="{
                    prev: {
                      shadow: true,
                      translate: [0, 0, -800],
                      rotate: [180, 0, 0],
                    },
                    next: {
                      shadow: true,
                      translate: [0, 0, -800],
                      rotate: [-180, 0, 0],
                    },
                }"
                :modules="modules"
                >
                    <swiper-slide v-for="(question, index) in quiz.questions" :key="index">
                        <QuizQuestionRadio :question="question" @checked="checkValid"></QuizQuestionRadio>
                    </swiper-slide>
                </Swiper> -->
                <div class="previous" @click="i>0? i--: ''" v-if="i > 0">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10" :class="[i>0? 'fill-blue-600 cursor-pointer' : 'fill-slate-400']" viewBox="0 0 24 24">
                        <path d="M12 2C17.52 2 22 6.48 22 12C22 17.52 17.52 22 12 22C6.48 22 2 17.52 2 12C2 6.48 6.48 2 12 2ZM12 11V8L8 12L12 16V13H16V11H12Z"></path>
                    </svg>
                </div>
                <div v-for="(question, index) in quiz.questions" :key="index" class="">
                    <QuizQuestionRadio :question="question" v-if="index == i" @checked="checkValid"></QuizQuestionRadio>
                </div>
                <div class="next" @click="can_pass? suivant() : ''" v-if="can_pass">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10" :class="[can_pass? 'fill-blue-600 cursor-pointer' : 'fill-slate-400']" viewBox="0 0 24 24">
                        <path d="M12 2C17.52 2 22 6.48 22 12C22 17.52 17.52 22 12 22C6.48 22 2 17.52 2 12C2 6.48 6.48 2 12 2ZM12 11H8V13H12V16L16 12L12 8V11Z"></path>
                    </svg>
                </div>
                <!-- <div v-if="can_pass" @click="suivant">
                    suivant
                </div> -->
                
            </div>
            <div>
                <CirculProgression :progression="progress"></CirculProgression>
            </div>
        </div>
        <div v-else-if="quiz.quiz_maps.length" class=" flex justify-center ">
            
            <div class="relative w-4/5">
                <div class="previous" @click="i>0? i--: ''">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10" :class="[i>0? 'fill-blue-400 cursor-pointer' : 'fill-slate-400']" viewBox="0 0 24 24">
                        <path d="M12 2C17.52 2 22 6.48 22 12C22 17.52 17.52 22 12 22C6.48 22 2 17.52 2 12C2 6.48 6.48 2 12 2ZM12 11V8L8 12L12 16V13H16V11H12Z"></path>
                    </svg>
                </div>
                <div v-for="(question, index) in quiz.quiz_maps" class="">
                    <QuizMap :question="question" v-if="index == i" @validate="validate"></QuizMap>
                </div>
                <div class="next" @click="can_pass? suivant : ''">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10" :class="[can_pass? 'fill-blue-400 cursor-pointer' : 'fill-slate-400']" viewBox="0 0 24 24">
                        <path d="M12 2C17.52 2 22 6.48 22 12C22 17.52 17.52 22 12 22C6.48 22 2 17.52 2 12C2 6.48 6.48 2 12 2ZM12 11H8V13H12V16L16 12L12 8V11Z"></path>
                    </svg>
                </div>
            </div>
            
            
        </div>
    </div>
        <FixedModal :show="should_repeat" @close="repeat">
                <div class="p-4 flex flex-col items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-20 h-20" viewBox="0 0 24 24"><path d="M12 22C6.47715 22 2 17.5228 2 12C2 6.47715 6.47715 2 12 2C17.5228 2 22 6.47715 22 12C22 17.5228 17.5228 22 12 22ZM12 20C16.4183 20 20 16.4183 20 12C20 7.58172 16.4183 4 12 4C7.58172 4 4 7.58172 4 12C4 16.4183 7.58172 20 12 20ZM7 17C7 14.2386 9.23858 12 12 12C14.7614 12 17 14.2386 17 17H15C15 15.3431 13.6569 14 12 14C10.3431 14 9 15.3431 9 17H7ZM8 11C7.17157 11 6.5 10.3284 6.5 9.5C6.5 8.67157 7.17157 8 8 8C8.82843 8 9.5 8.67157 9.5 9.5C9.5 10.3284 8.82843 11 8 11ZM16 11C15.1716 11 14.5 10.3284 14.5 9.5C14.5 8.67157 15.1716 8 16 8C16.8284 8 17.5 8.67157 17.5 9.5C17.5 10.3284 16.8284 11 16 11Z"></path></svg>
                    
                    <div @click="repeat" class="p-1 text-white bg-red-600 rounded-md cursor-pointer">
                        réessayer
                    </div>
                </div>
            </FixedModal>
            <Modal :show="congrat" @close="congrat= false">
                <div class="p-2 flex flex-col items-center justify-center">
                    <img src="/images/award.png" alt="" class="w-60">
                    <div class="text-xl mt-2">Bravooo!!!!</div>
                    
                </div>
            </Modal>
    
</template>

<script>
    import MainLayout from '@/Layouts/MainLayout.vue';
    import QuizQuestionRadio from './QuizQuestionRadio.vue';
    import CirculProgression from '@/Components/CirculProgression.vue';
    import FixedModal from '@/Components/FixedModal.vue';
    import Modal from '@/Components/Modal.vue';
import QuizMap from './QuizMap.vue';
    /* import { Swiper, SwiperSlide } from 'swiper/vue';
    import 'swiper/css/effect-creative';
    import 'swiper/css/pagination';
    import 'swiper/css';
    import { EffectCreative, Navigation } from 'swiper/modules'; */

    export default {
        components: { MainLayout, QuizQuestionRadio, CirculProgression, FixedModal, Modal, QuizMap },
        props: ['quiz'],
        emits: ['validate'],
        data(){
            return {
                i: 0,
                wrongs:0,
                essai:1,
                can_pass: false,
                should_repeat: false,
                len: null,
                congrat: false,
                progress: 0,
                form_quiz: {
                    quiz_id: null,
                    type: null
                },
            }
        },
        created(){
            if( this.quiz.questions.length)
                this.len= this.quiz.questions.length
            else if(this.quiz.quiz_maps.length)
                this.len= this.quiz.quiz_maps.length
            if(this.quiz.isSubmitted){
                this.progress= 100
            }
            if(this.$page.props.canAdministrate)
                this.can_pass= true
        },
        methods: {
            checkValid(check){
                if(check.sel && this.i < this.len - 1)
                    this.can_pass= true
                else if(!check.sel) {
                    /* if(this.essai == 0) */
                    this.wrongs++
                    this.essai++
                    if(this.essai>2 || this.wrongs>3)
                        this.should_repeat =true
                    
                }
                else if( this.i == this.len - 1){
                    this.form_quiz.quiz_id= this.quiz.id
                    this.form_quiz.type= 'question'
                    this.quizSoumission()
                    this.congrat= true
                    /* this.progress= 100+'%' */
                    this.progress= 100
                    this.$emit('validate')
                }
            },
            validate(){
                if(this.i < this.len - 1)
                    this.can_pass= true
                else if( this.i == this.len - 1){
                    this.form_quiz.quiz_id= this.quiz.id
                    this.form_quiz.type= 'map'
                    this.quizSoumission()
                    this.congrat= true
                    /* this.progress= 100+'%' */
                    this.progress= 100
                    
                }
            },
            
            suivant(){
                this.i++
                this.essai= 1
                this.can_pass= false
                this.should_repeat= false
                this.progress= ((this.i)*100)/this.len
            },
            repeat(){
                this.i= 0
                this.essai= 1
                this.wrongs= 0
                this.can_pass= false
                this.should_repeat= false
            },
            async quizSoumission(){
                try{
                    const response = await axios.post(route('quiz.soumission'), this.form_quiz);
                    if(response== 'done'){
                        this.$emit('validate')
                    }
                }catch (error) {
                    console.log(error);
                }
            },
            validatedLevels(){
                
            }
        },
        /* setup() {
            return {
                modules: [EffectCreative, Navigation]
            }
        }, */
    
}
</script>

<style lang="scss" scoped>
    .quiz{
        width: 400px;
        position: relative;
    }
    
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