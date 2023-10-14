<template>
    <div class="mt-10">
        <form @submit.prevent="submit" class="flex gap-2 justify-center items-center">
            <div>
                <!-- <label for="question">heeey</label> -->
                <!-- <Editor v-model="form.question"></Editor> -->
                <textarea cols="50" rows="3" placeholder="Poser votre question" v-model="form.question"></textarea>
            </div>
            <div class="flex justify-center">
                <SubmitButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing" type="submit">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                        <path d="M3.478 2.405a.75.75 0 00-.926.94l2.432 7.905H13.5a.75.75 0 010 1.5H4.984l-2.432 7.905a.75.75 0 00.926.94 60.519 60.519 0 0018.445-8.986.75.75 0 000-1.218A60.517 60.517 0 003.478 2.405z" />
                    </svg>
                </SubmitButton>
            </div>
        </form>
    </div>
</template>

<script>
    import Editor from '@/Components/Editor.vue';
    import SubmitButton from '@/Components/SubmitButton.vue';
    import TextInput from '@/Components/TextInput.vue';
    import MainLayout from '@/Layouts/MainLayout.vue';

    export default {
        components: { MainLayout, TextInput, Editor, SubmitButton },
        props: ['formation_id', 'cour_id'],
        data() {
            return {
                form: this.$inertia.form({
                    id: this.formation_id,
                    selected_cour: this.cour_id,
                    question: ''
                })
            };
        },
        methods: {
            submit(){
                //console.log(this.form.id);
                this.form.post(route('question.cour'), {
                    preserveScroll: true,
                    onFinish: () => this.form.reset('question'),
                })
            }
        }
    
    }
</script>

<style lang="scss" scoped>

</style>