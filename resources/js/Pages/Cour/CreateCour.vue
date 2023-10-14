<template>
    <div>
        <form @submit.prevent="submit" class="flex flex-col items-center p-4">
            <h2 class="text-center">Créé un cour</h2>
            <div>
                <div>
                    <InputLabel>Cour</InputLabel>
                    <TextInput v-model="form.titre" type="text" required autofocus></TextInput>
                </div>
                <div class="mt-3">
                    <InputLabel>cour gratuit</InputLabel>
                    <select v-model="form.gratuit">
                        <option :value="false">Non</option>
                        <option :value=true>Oui</option>
                    </select>
                </div>
                <!-- <div class="mt-3">
                    <InputLabel>Résumé du cours (optionnel)</InputLabel>
                    <textarea v-model="form.resume"></textarea>
                </div> -->
                
                <div class="mt-3">
                    <InputLabel>video</InputLabel>
                    <!-- <input type='file' accept="video/mp4" @change="newVideo"> -->
                    <NewVideo v-model:value="form.videoId"></NewVideo>
                </div>
            </div>
            
            <!-- <div >
                <InputLabel>Fichiers joints (optionnel)</InputLabel>
                <Pdf v-model:value="form.pdf_files"></Pdf>
                
            </div> -->


            <div class="flex justify-center mt-4">
                <SubmitButton :class="{ 'opacity-25': form.processing || !can_submit }" :disabled="form.processing || !can_submit" type="submit">
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
    import NewImg from '@/Components/NewImg.vue';
    import DropZone from 'dropzone-vue';
    import Pdf from '@/Components/Pdf.vue';
    import NewVideo from '@/Components/NewVideo.vue';

    // optionally import default styles
    import 'dropzone-vue/dist/dropzone-vue.common.css';
    export default {
        components: {
    TextInput,
    SubmitButton,
    InputLabel,
    InputError,
    NewImg,
    DropZone,
    Pdf,
    NewVideo
},
        props:['chapitre'],
        data(){
            return {
                form: this.$inertia.form({
                    titre: '',
                    resume: '',
                    chapitre: this.chapitre,
                    //video_url: '',
                    gratuit: false,
                    //pdf_files:[],
                    videoId: null,
                    //can_submit: false
                })
            }
        },
        /* watch:{
            form(newValue){
                console.log(this.form);
                if(titre && chapitre && videoId!==null)
                    can_submit=true
            }
        }, */
        computed: {
            can_submit(){
                return this.form.titre && this.form.videoId!=null;
            }
        },
        methods:{
            submit() {
                //console.log(this.form );
                this.form.post(route('cour.store'), {
                    preserveScroll: true
                })
                this.$emit('close')
            }
        }
    }
</script>

<style lang="scss" scoped>

</style>