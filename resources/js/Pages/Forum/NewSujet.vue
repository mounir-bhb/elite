<template>
    <MainLayout>
        <div class="mt-20">
            <form @submit.prevent="submit">
                <div>
                    <h2>{{ formation_titre.title }}</h2>
                </div>
                <div>
                    <label for="cour">Cour</label>
                    <select v-model="form.selected_cour">
                        <optgroup v-for="chapitre in chapitres" :label="chapitre.titre">
                            <option v-for="cour in chapitre.cours" :value="cour.id">{{ cour.titre }} </option>
                        </optgroup>
                    </select>
                </div>
                <div>
                    <label for="sujet">Sujet</label>
                    <TextInput type="text" v-model="form.sujet"></TextInput>
                </div>
                <div>
                    <label for="question"></label>
                    <Editor v-model="form.question"></Editor>
                </div>
                <div class="flex justify-center mt-4">
                    <SubmitButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing" type="submit">
                        Enregistrer
                    </SubmitButton>
                </div>
            </form>
        </div>
    </MainLayout>
</template>

<script>
    import Editor from '@/Components/Editor.vue';
    import SubmitButton from '@/Components/SubmitButton.vue';
    import TextInput from '@/Components/TextInput.vue';
    import MainLayout from '@/Layouts/MainLayout.vue';

    export default {
        components: { MainLayout, TextInput, Editor, SubmitButton },
        props: ['chapitres', 'cour_id', 'formation_titre', 'formation_id'],
        data() {
            return {
                form: this.$inertia.form({
                    id: this.formation_id.id,
                    selected_cour: this.cour_id,
                    sujet: '',
                    question: ''
                })
            };
        },
        methods: {
            submit(){
                this.form.post(route('forum.store'), {
                    preserveScroll: true
                })
            }
        }
    
    }
</script>

<style lang="scss" scoped>

</style>