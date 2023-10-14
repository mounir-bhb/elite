<template>
    <MainLayout>
        
        <div class="flex mx-3 mt-20 min-h-full">
            <div class="w-3/4">
                <!-- <div @click="test">test</div> -->
                <!-- <videoPlayer v-if="type=='cour'" :url="'/storage/'+selectedCour.video.video_url"></videoPlayer> -->
                <div>
                    
                </div>
                <div v-if="selectedCour || selectedPdf">
                    <div v-if="type=='cour' && selectedCour">
                        <video 
                            v-if="selectedCour.video" 
                            :src="'/storage/'+selectedCour.video.video_url" 
                            controls 
                            type="video/mp4" 
                            @ended="videoEnded">
                        </video>
                        <div v-else class="flex justify-center">
                            <img :src="'/storage/'+formation.photo_url" alt="" class="img-vid">
                        </div>
                    </div>
                    
                    <!-- <VideoPlayer v-if="type=='cour'" :sourse="'/storage/'+selectedCour.video.video_url"></VideoPlayer> -->
                    <!-- <video v-if="type=='cour'" class="video-js" controls :src="'/storage/'+selectedCour.video.video_url" autoplay ref="videoPlayer">
                        
                    </video>-->
                    <div v-else-if="type=='pdf'">
                        <embed v-if="selectedPdf.ressource_url" :src="'/storage/'+selectedPdf.ressource_url" type="application/pdf" width="100%" height="500px" />
                        <div v-else>
                            <img :src="'/storage/'+formation.photo_url" alt="" class="img-vid">
                        </div>
                    </div>
                    
                    
                
                    <div class="flex justify-center gap-10  py-4" v-if="canInteract || canUpdate">
                        <div @click="changeInterractionType('avis')" class="text-lg cursor-pointer hover:bg-[#eee]"
                            :class="interraction_type == 'avis'? 'font-bold': ''">Avis</div>
                        <div @click="changeInterractionType('question')" class="text-lg cursor-pointer hover:bg-[#eee]"
                            :class="interraction_type == 'question'? 'font-bold': ''">Question</div>
                        <div @click="changeInterractionType('test')" class="text-lg cursor-pointer hover:bg-[#eee]"
                            :class="interraction_type == 'test'? 'font-bold': ''">Test</div>
                    </div>
                    <div v-if="interraction_type=='avis' && (canInteract || canUpdate)" >
                        <div class="flex justify-center" v-if="!open_note">
                            <div class="p-2 my-2 cursor-pointer text-lg bg-blue-800 text-white rounded-lg"
                                @click="open_note=true"
                                v-if="canInteract"
                            >
                                Noter la formation
                            </div>
                        </div>
                        <CreateStarRating :formation="formation.id" :myComment="myComment" v-if="open_note && canInteract" @close="open_note=false"></CreateStarRating>
                        <Ratings :stars1="stars1" :stars2="stars2" :stars3="stars3" :stars4="stars4" :stars5="stars5"></Ratings>
                    </div>
                    <div v-if="interraction_type=='question' && (canInteract || canUpdate)">
                        <!-- <InputLabel>Poser une question</InputLabel> -->
                        <NewQuestion :formation_id="formation.id" :cour_id="selectedCour.id" v-if="canInteract"></NewQuestion>
                        <!-- <Link :href="route('forum.create', [formation.id, selectedCour.id])">Poser une question</Link> -->
                        <div class="mx-20">
                            <div v-for="question in selectedCour.questions" class="mb-3">
                                <!-- <ForumSujet :sujet="sujet"></ForumSujet> -->
                                <Question :question="question" :formation_id="formation.id" :canUpdate="canUpdate" 
                                    :canInteract="canInteract"
                                    path="reponse.cour">
                                </Question>
                            </div>
                        </div>
                    </div>
                    <div v-if="interraction_type=='test' && (canInteract || canUpdate)" class="flex justify-center">
                        <div  v-if="!selectedCour.quiz && canUpdate" class="flex flex-col items-center mb-10">
                            <div class="w-fit text-lg bg-blue-700 text-white p-2 rounded-xl cursor-pointer" @click="open_create_quiz=true" v-if="!open_create_quiz">
                                Créé quiz
                            </div>
                            <CreateQuiz :id="selectedCour.id" parent="cour" v-if="open_create_quiz && canUpdate" :formation_id="formation.id" @close="open_create_quiz=false"></CreateQuiz>
                        </div>
                        
                        <!-- <div class="relative w-full h-5 bg-[#eee]">
                            <div class="progress"></div>
                            <div></div>
                        </div> -->
                        <!-- <CreateQuiz :id="selectedCour.id" parent="cour"></CreateQuiz> -->
                        <div v-else-if="selectedCour.quiz">
                            <!-- <div v-for="(question, index) in selectedCour.quiz.questions" :key="index">
                                <QuizQuestionRadio :question="question" v-if="index <= i" @checked="checkValid"></QuizQuestionRadio>
                            </div>
                            <div v-if="can_pass" @click="suivant">
                                suivant
                            </div>
                            <div>

                            </div>
                            <div>
                                wrongs: {{ wrongs }} <br>
                                essai: {{ essai }} 
                            </div> -->
                            <div class="flex flex-col items-center" v-if="canUpdate">
                                <div class="w-fit text-lg bg-blue-700 text-white p-2 rounded-xl cursor-pointer" @click="open_edit_quiz=true" v-if="!open_edit_quiz">
                                    Modifier le test
                                </div>
                                <EditQuiz :quiz="selectedCour.quiz" :id="selectedCour.id" parent="cour" v-if="open_edit_quiz" @close="open_edit_quiz=false"></EditQuiz>
                            </div>
                            
                            <Quiz :quiz="selectedCour.quiz" v-if="!open_edit_quiz"></Quiz>
                        </div>
                    </div>
                </div>
                
                
                
            </div>
            <div class="px-4 divide-y w-1/4">
                <div class="flex justify-center text-xl font-bold py-2">Contenu du cours</div>
                <div class="py-2 divide-y">
                    <div v-for="(chapitre, index) in formation.chapitres">
                        <div >
                            <!-- <div class="flex gap-1 items-center cursor-pointer py-2 hover:bg-[#eee]">
                                <span >
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                                    </svg>

                                </span>
                                
                                <div class="text-xl">
                                    {{ chapitre.titre }}
                                </div>
                            </div>
                    
                            <div v-for="(cour, cindex) in chapitre.cours" class="">
                                <div @click="selectCour(cour)" class="pl-10 text-lg cursor-pointer hover:bg-[#eee]">
                                    {{ cour.titre }}
                                </div>
                                <div v-for="(ressource, rindex) in cour.ressources" @click="selectPdf(ressource)" class="pl-14 text-lg cursor-pointer hover:bg-[#eee]">
                                    ressource {{ rindex+1 }}
                                </div>
                            </div> -->
                            <Chapitre :chapitre="chapitre" :canUpdate="canUpdate" :canInteract="canInteract" @selectedCour="selectCour" @selectedPdf="selectPdf"></Chapitre>
                            
                            
                        </div>
                    </div>
                    <div @click="open_chapitre=true" class="cursor-pointer" v-if="canUpdate">
                        Ajouter un Chapitre
                    </div>
                </div>
            </div>
            
            <FixedModal :show="should_repeat" @close="repeat">
                <div>
                    something
                    <div @click="repeat">
                        réessayer
                    </div>
                </div>
            </FixedModal>
            <Modal :show="congrat" @close="congrat= false">
                <div>
                    Bravooo!!!!
                </div>
            </Modal>
            <Modal :show="open_chapitre" @close="open_chapitre=false">
                <CreateChapitre @close="open_chapitre=false" :formation_id="formation.id"></CreateChapitre>
            </Modal>
        </div>
        <Footer></Footer>
    </MainLayout>
    
</template>

<script>
    //import VideoPlayer from '@/Components/VideoPlayer.vue';
    import MainLayout from '@/Layouts/MainLayout.vue';
    import { Link } from '@inertiajs/vue3';
    import ForumSujet from '../Forum/ForumSujet.vue';
    import Question from '../Forum/Question.vue';
    import NewQuestion from '../Forum/NewQuestion.vue'
    import InputLabel from '@/Components/InputLabel.vue';
    import CreateQuiz from '../Quiz/CreateQuiz.vue';
    import CreateStarRating from '../Rating/CreateStarRating.vue'
    import QuizQuestionRadio from '../Quiz/QuizQuestionRadio.vue';
    import FixedModal from '@/Components/FixedModal.vue';
    import Modal from '@/Components/Modal.vue';
    import Ratings from '../Rating/Ratings.vue';
    import Chapitre from '../Chapitre/Chapitre.vue';
    import CreateChapitre from '../Chapitre/CreateChapitre.vue';
    import Quiz from '../Quiz/Quiz.vue';
    import EditQuiz from '../Quiz/EditQuiz.vue';
    import Footer from '@/Components/Footer.vue';
    //import VideoPlayer from '@/Components/VideoPlayer.vue';
    //import videojs from 'video.js';
    export default {
        components: { MainLayout, Link, ForumSujet, Question, NewQuestion, InputLabel, CreateQuiz, CreateStarRating, QuizQuestionRadio, FixedModal, Modal, Ratings, Chapitre, CreateChapitre, Quiz, EditQuiz, Footer },
        props: ['formation', 'stars5', 'stars4', 'stars3', 'stars2', 'stars1', 'canUpdate', 'canInteract', 'myComment'],
        data(){
            return {
                selectedCour: null,
                selectedPdf: null,
                type: 'cour',
                interraction_type: 'question',
                i: 0,
                wrongs:0,
                essai:0,
                can_pass: false,
                should_repeat: false,
                len: null,
                congrat: false,
                progress: null,
                form_quiz: {
                    formation: this.formation.id,
                    quiz_id: null
                },
                form_cour: {
                    formation: this.formation.id,
                    cour_id: null
                },
                open_chapitre: false,
                open_note: false,
                open_create_quiz: false,
                open_edit_quiz: false
            }
        },
        created(){
            if(this.formation.chapitres.length > 0){
                if(this.formation.chapitres[0].cours.length > 0){
                    this.selectedCour= this.formation.chapitres[0].cours[0]
                    if(this.selectedCour.ressources > 0){
                        this.selectedPdf= this.selectedCour.ressources[0]   
                }
                    if(this.formation.chapitres[0].cours[0].quiz){
                        if(this.formation.chapitres[0].cours[0].quiz.length > 0)
                            this.len= this.formation.chapitres[0].cours[0].quiz.questions.length
                    }
                }
            }
        },
        methods:{
            selectCour(cour){
                if(this.canUpdate || this.canInteract ||cour.gratuit){
                    this.selectedCour= cour
                    this.type= 'cour'
                    if(this.selectedCour.quiz)
                        this.len= this.selectedCour.quiz.questions.length
                }
                
            },
            selectPdf(ressource){
                this.selectedPdf= ressource
                this.type= 'pdf'
            },
            changeInterractionType(type){
                this.interraction_type= type
            },
            checkValid(check){
                if(check.sel && this.i < this.len - 1)
                    this.can_pass= true
                else if(!check.sel) {
                    /* if(this.essai == 0) */
                    this.wrongs++
                    this.essai++
                    if(this.essai>1)
                        this.should_repeat =true
                }
                else if( this.i == this.len - 1){
                    this.form_quiz.quiz_id= this.selectedCour.quiz.id
                    this.quizSoumission()
                    this.congrat= true
                    this.progress= 100+'%'
                }
            },
            
            suivant(){
                this.i++
                this.essai= 0
                this.can_pass= false
                this.should_repeat= false
                this.progress= ((this.i)*100)/this.len +'%'
                /* console.log(this.progress); */
            },
            repeat(){
                this.i= 0
                this.essai= 0
                this.wrongs= 0
                this.can_pass= false
                this.should_repeat= false
            },
            /* test(){
                console.log(this.formation.id);
            } */
            videoEnded(){
                if(this.canInteract){
                    this.form_cour.cour_id= this.selectedCour.id
                    this.courSoumission()
                }
                
            },
            async quizSoumission(){
                if(this.canInteract){
                    try{
                        const response = await axios.post(route('quiz.soumission'), this.form_quiz);
                    }catch (error) {
                        console.log(error);
                    }
                }
                
                
            },
            async courSoumission(){
                if(this.canInteract){
                    try{
                        const response = await axios.post(route('cour.soumission'), this.form_cour);
                    }catch (error) {
                        console.log(error);
                    }
                }
                
                
            },
        }
    }
</script>

<style lang="scss" scoped>
    .progress{
        position: absolute;
        height: 100%;
        width: v-bind(progress);
        background: blue;
        transition-duration: 0.7;
    }
    .img-vid{
        height: 500px;
    }
</style>