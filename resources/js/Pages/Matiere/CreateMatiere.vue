<template>
    <div>
        <form @submit.prevent="submit" class="shadow-md p-4">
            <div class="flex justify-center gap-2">
                <h2 class="text-center">Matières</h2>
                <div @click="addMatiere" class="flex items-end font-bold text-xl cursor-pointer">+</div>
            </div>
            <div class="divide-y">
                <div v-for="(matiere, index) in form.old_matieres" :key="index" class="mt-3 p-4">
                    <InputLabel>Nom de la matière</InputLabel>
                    <div class="flex gap-2 items-center">
                        <TextInput v-model="form.old_matieres[index].nom" type="text"></TextInput>
                        <!-- <div @click="delMatiere(index)" v-if="index > 0"  class="text-2xl text-red-600 cursor-pointer">x</div> -->
                    </div>
                    
                </div>
                <div v-for="(matiere, index) in form.matieres" :key="index" class="mt-3 p-4">
                    <InputLabel>Nom de la matière</InputLabel>
                    <div class="flex gap-2 items-center">
                        <TextInput v-model="form.matieres[index].nom" type="text"></TextInput>
                        <div @click="delMatiere(index)" v-if="index > 0"  class="text-2xl text-red-600 cursor-pointer">x</div>
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
    export default {
        components:{
            TextInput,
            SubmitButton,
            InputLabel,
            InputError
        },
        props: ['matieres'],
        data(){
            return {
                form: this.$inertia.form({
                    old_matieres: this.matieres,
                    matieres:[{
                        nom: '',
                    }]
                })
            }
        },
        methods: {
            addMatiere(){
                this.form.matieres.push({nom: ''})
            },
            delMatiere(index){
                if(index > 0)
                    this.form.matieres.splice(index, 1)
            },
            submit() {
                this.form.post(route('matiere.store'),{
                    preserveScroll: true
                })
            }
        }
    }
</script>

<style lang="scss" scoped>

</style>