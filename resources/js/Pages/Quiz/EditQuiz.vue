<template>
    <div>
        <form @submit.prevent="submit" class="shadow-md p-6 relative">
            <div  class="absolute top-4 right-4 text-lg cursor-pointer" @click="hide" v-if="parent=='cour'">X</div>
            <h2 class="text-center mb-4">Niveau {{ form.niveau }}</h2>
            <!-- <div v-if="!level">
                <InputLabel for="">Titre du quiz:</InputLabel>
                <TextInput v-model="form.niveau" type="text"></TextInput>
            </div> -->
            <!-- Question -->
            <div @click="addQuestion">Ajouter une autre question</div>
            <div class="flex gap-4 flex-wrap">
                <div v-for="(question, index) in form.questions" :key="index" class="relative shadow-md p-6">
                    <div v-if="index > 0" @click="delQuestion(index)" class="absolute top-4 right-4 text-lg cursor-pointer">X</div>
                    <div>
                        <InputLabel>Question</InputLabel>
                        <TextInput v-model="form.questions[index].contenu" type="text"></TextInput>
                    </div>
                    <!-- Réponses -->
                    <div @click="addReponse(index)">Ajouter une autre réponse</div>
                    <div class="divide-y">
                        <div v-for="(reponse, key) in form.questions[index].reponses" :key="key" class="relative p-4">
                            <div v-if="key > 0" @click="delReponse(index, key)" class="absolute top-2 right-2 text-lg cursor-pointer">X</div>
                            <div>
                                <InputLabel>reponse</InputLabel>
                                <TextInput v-model="form.questions[index].reponses[key].contenu" type="text"></TextInput>
                            </div>
                            <div>
                                <InputLabel>est-elle vrai</InputLabel>
                                <select v-model="form.questions[index].reponses[key].is_true">
                                    <option :value="0">Faux</option>
                                    <option :value="1">Vrai</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
            
            <div class="flex justify-center mt-4">
                <SubmitButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing" type="submit">
                    Enregistrer
                </SubmitButton>
            </div>
        </form>
    </div>
</template>

<script>
    import TextInput from '@/Components/TextInput.vue';
    import SubmitButton from '@/Components/SubmitButton.vue';
    import InputLabel from '@/Components/InputLabel.vue';
    import InputError from '@/Components/InputError.vue';
    import MainLayout from '@/Layouts/MainLayout.vue';
    import BaseSelect from '@/Components/BaseSelect.vue';
    export default {
        components:{
            TextInput,
            SubmitButton,
            InputLabel,
            InputError,
            MainLayout,
            BaseSelect
        },
        props: ['id','parent', 'quiz'],
        data(){
            return {
                form: this.$inertia.form({
                    _method:'put',
                    niveau: this.quiz.niveau,
                    questions: this.quiz.questions
                }),
            }
        },
        mounted(){
            /* if(this.level){
                this.form.titre= this.level
            } */
            /* console.log(this.quiz); */
        },
        methods:{
            addQuestion(){
                this.form.questions.push({
                    contenu:'',
                    reponses: [{
                        contenu: '',
                        is_true: false
                    }]
                })
            },
            hide(){
                this.$emit('close')
            },
            delQuestion(index){
                if(this.form.questions.length > 1)
                    this.form.questions.splice(index,1)
            },
            addReponse(index){
                this.form.questions[index].reponses.push({
                    contenu: '',
                    is_true: false
                })
            },
            delReponse(index, key){
                if(this.form.questions[index].reponses.length > 1)
                    this.form.questions[index].reponses.splice(key,1)
            },
            submit() {
                this.form.post(route('store.quiz', [this.id, this.parent]),{
                    preserveScroll: true,                   
                })
            },
        }   
    }
</script>

<style lang="scss" scoped>

</style>