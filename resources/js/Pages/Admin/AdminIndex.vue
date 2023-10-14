<template>
    <MainLayout>
        <div class="flex justify-center admin">
            <div class="types">
                <div @click="changeType('inscription')" class="type" :class="{'bg-orange-300' : (type=='inscription')}">Validation Inscriptions</div>
                <div @click="changeType('creation')" class="type" :class="{'bg-orange-300' : (type=='creation')}">Création</div>
                <div @click="changeType('paiement')" class="type" :class="{'bg-orange-300' : (type=='paiement')}">Paiements</div>
                <div @click="changeType('historique')" class="type" :class="{'bg-orange-300' : (type=='historique')}">Historique paiements</div>
                <div @click="changeType('revenu')" class="type" :class="{'bg-orange-300' : (type=='revenu')}">Revenu</div>
                <div @click="changeType('formations')" class="type" :class="{'bg-orange-300' : (type=='formations')}">formations</div>
            </div>
        </div>

        <div class="flex justify-center mt-2" v-if="type=='inscription'">
            <div class="types">
                <div @click="subType('form-insc')" class="type" :class="{'bg-orange-300' : (sub_type=='form-insc')}">Formation inscription</div>
                <div @click="subType('quiz-insc')" class="type" :class="{'bg-orange-300' : (sub_type=='quiz-insc')}">Quiz Inscriptions</div>
            </div>
        </div>

        <div v-if="type=='inscription'">
            <Inscriptions :inscriptions="inscriptions" v-if="sub_type=='form-insc'"></Inscriptions>
            <QuizInscriptions :inscriptions="quizInscriptions" v-else-if="sub_type=='quiz-insc'"></QuizInscriptions>
        </div>
        <div v-else-if="type=='paiement'">
            <PaiementTeachers :teachers="teachers"></PaiementTeachers>
        </div>
        <div v-else-if="type=='creation'" class="flex justify-around gap-6 p-8 mx-20">
            <CreateCycle :cycles="cycles"></CreateCycle>
            <CreateMatiere :matieres="matieres"></CreateMatiere>
        </div>
        <div v-else-if="type== 'historique'">
            <HistoriquePaiements :paiements="paiements"></HistoriquePaiements>
        </div>
        <div v-else-if="type== 'revenu'">
            <Revenu :revenus="revenus"></Revenu>
        </div>
        <div v-else-if="type=='formations'">
            <ValidFormations :formations="formations"></ValidFormations>
        </div>
    </MainLayout>
</template>

<script>
    import MainLayout from '@/Layouts/MainLayout.vue';
    import Inscriptions from './Inscriptions.vue';
    import CreateCycle from '../Cycle/CreateCycle.vue'
    import CreateMatiere from '../Matiere/CreateMatiere.vue'
    import PaiementTeachers from './PaiementTeachers.vue';
    import HistoriquePaiements from './HistoriquePaiements.vue';
    import Revenu from './Revenu.vue';
    import ValidFormations from './ValidFormations.vue'
import QuizInscriptions from './QuizInscriptions.vue';
    export default {
        components: { MainLayout, Inscriptions, CreateCycle, CreateMatiere, PaiementTeachers, HistoriquePaiements, Revenu, ValidFormations, QuizInscriptions },
        props:['inscriptions', 'matieres', 'cycles', 'teachers', 'paiements', 'quizInscriptions', 'revenus', 'formations'],
        data(){
            return{
                type: 'inscription',
                sub_type: 'form-insc'
            }
        },
        methods: {
            changeType(type){
                this.type= type
            },
            subType(type){
                this.sub_type=type
                /* console.log(this.sub_type); */
            },
        }
    }
</script>

<style lang="scss" scoped>
    .admin{
        padding-top: 100px;
    }
    .types{
        display: flex;
        justify-content: center;
        align-items: center;
        border-radius: 20px;
        background: #fff;
        width: fit-content;
        overflow: hidden;
    }
    .type{
        padding-left: 20px;
        padding-right: 20px;
        padding-top: 10px;
        padding-bottom: 10px;
        font-size: large;
        font-weight: bold;
        cursor: pointer;
        transition: all;
        transition-duration: 0.7s;
    }
    .type:hover{
        background-color: beige;
    }
</style>