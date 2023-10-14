<template>
    <div class="mt-3 ml-6 relative w-fit shadow-md p-3 bg-slate-50">
        
        <form @submit.prevent="submit" class="flex gap-6 items-center">
            <div class="absolute top-4 right-4 text-lg cursor-pointer" @click="hide">
            X
        </div>
            <SimpleEditor v-model="form.reponse"></SimpleEditor>
            <!-- <Editor v-model="form.reponse"></Editor> -->
            <SubmitButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing" type="submit">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                    <path d="M3.478 2.405a.75.75 0 00-.926.94l2.432 7.905H13.5a.75.75 0 010 1.5H4.984l-2.432 7.905a.75.75 0 00.926.94 60.519 60.519 0 0018.445-8.986.75.75 0 000-1.218A60.517 60.517 0 003.478 2.405z" />
                </svg>
            </SubmitButton>
        </form>
    </div>
</template>

<script>
    import Editor from '@/Components/Editor.vue';
    import SimpleEditor from '@/Components/SimpleEditor.vue';
    import SubmitButton from '@/Components/SubmitButton.vue';

    export default {
        components: { Editor, SubmitButton, SimpleEditor },
        props: ['path', 'id', 'formation_id'],
        data() {
            return {
                form: this.$inertia.form({
                    parent_id: this.id,
                    reponse: null,
                    formation: this.formation_id
                })
            };
        },
        methods: {
            hide(){
                this.$emit('close')
            },
            submit() {
                //console.log(this.form);
                this.form.post(route(this.path), {
                    preserveScroll: true,
                    onFinish: () => this.form.reset('reponse'),
                });
            }
        },
    }
</script>

<style lang="scss" scoped>

</style>