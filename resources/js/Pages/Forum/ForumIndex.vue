<template>
    <div>
        <MainLayout>
            <div class="mt-20">
                <Filter :matieres="matieres" :cycles="cycles" :items="questions" @items="newItems"></Filter>
            </div>
            
            <div class="mx-20 ">
                <div class="p-3 mt-8 bg-slate-500 w-fit text-white rounded-lg cursor-pointer" 
                    @click="open_new_question=true"
                    v-if="!open_new_question && $page.props.canSurfe"
                >
                    Poser une question
                </div>
                <NewQuestionForum :matieres="matieres" :cycles="cycles" v-if="open_new_question==true && $page.props.canSurfe" @close="open_new_question=false"></NewQuestionForum>
                <div class="mt-10">
                    <div v-for="question in filteredQuestions">
                        <Question :question="question" path="reponse.forum"></Question>
                    </div>
                </div>
                
            </div>
        </MainLayout>
    </div>
</template>

<script>
import MainLayout from '@/Layouts/MainLayout.vue';
import NewQuestionForum from './NewQuestionForum.vue';
import Filter from '@/Components/Filter.vue';
import Question from './Question.vue'
    export default {
        props: ['matieres','cycles', 'questions'],
        data() {
            return {
                annee: null,
                filiere: null,
                cycle: null,
                matiere: null,
                open_new_question: false,
                filteredQuestions: this.questions
            };
        },
        components: { MainLayout, NewQuestionForum, Filter, Question },
        methods: {
            newItems(items){
                this.filteredQuestions= items
            }
        }
}
</script>

<style lang="scss" scoped>

</style>