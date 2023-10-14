<template>
    <div>
        <form @submit.prevent="submit" class="p-4 flex flex-col items-center">
            <h2 class="text-center">Créé chapitre</h2>
            <div>
                <InputLabel>Chapitre</InputLabel>
                <TextInput v-model="form.titre" type="text" required autofocus></TextInput>
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
import BaseSelect from '@/Components/BaseSelect.vue';
    export default {
        components: {
            TextInput, SubmitButton, InputLabel, InputError, BaseSelect
        },
        props: ['formation_id'],
        data(){
            return {
                form: this.$inertia.form({
                    formation_id: this.formation_id,
                    titre: ''
                })
            }
        },
        methods:{
            submit(){
                this.form.post(route('chapitre.store'),{
                    preserveScroll: true
                })
                this.$emit('close')
            }
        }
    }
</script>

<style lang="scss" scoped>

</style>