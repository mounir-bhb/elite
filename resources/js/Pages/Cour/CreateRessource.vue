<template>
    <div>
        <form @submit.prevent="submit" class="flex flex-col items-center p-4">
            <h2>Ajouter une ressource</h2>
            <div>
                <div class="mt-3">
                    <InputLabel>Nom du ressource</InputLabel>
                    <TextInput v-model="form.nom" type="text"></TextInput>
                </div>
                <div class="mt-3">
                    <InputLabel>Fichier</InputLabel>
                    <Pdf v-model:value="form.pdf_file"></Pdf>
                </div>
            </div>
            <div class="flex justify-center mt-4">
                <SubmitButton :class="{ 'opacity-25': form.processing || !can_submit }" :disabled="form.processing || !can_submit" type="submit">
                    Enregistrer
                </SubmitButton>
            </div>
        </form>
    </div>
</template>

<script>
import InputLabel from '@/Components/InputLabel.vue';
import Pdf from '@/Components/Pdf.vue';
import SubmitButton from '@/Components/SubmitButton.vue';
import TextInput from '@/Components/TextInput.vue';

    export default {
        components: { SubmitButton, Pdf, InputLabel, TextInput },
    props: ['cour_id'],
    data() {
        return {
            form: this.$inertia.form({
                nom:'',
                pdf_file: null
            })
            
        };
    },
    computed: {
        can_submit(){
            return  this.form.nom && this.form.pdf_file;
        }
    },
    methods: {
        submit() {
            //console.log(this.form );
            this.form.post(route('ressource.store', this.cour_id), {
                preserveScroll: true
            });
            this.$emit('close');
        }
    },
    
}
</script>

<style lang="scss" scoped>

</style>