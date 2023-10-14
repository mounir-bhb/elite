<template>
    <form @submit.prevent="submit" class="flex flex-col items-center">
        
        <div class="shadow-md px-4 pb-4 pt-8 relative">
            <div  class="absolute top-4 right-4 text-lg cursor-pointer" @click="hide">X</div>
            <div class="flex justify-center gap-2">
                <div v-for="i in stars" @mouseover="hoverRating(i)" @mouseleave="outRating" @click="setStar(i)" class="cursor-pointer">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-10 h-10 fill-none transition duration-700" :class="i<= temp_index || i<= form.star? 'fill-yellow-500 stroke-none': '' ">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.563.563 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.563.563 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z" />
                    </svg>
                </div>
            </div>
            <div>
                <textarea  id="" cols="30" rows="5" placeholder="votre commentaire" v-model="form.commentaire"></textarea>
            </div>
            <div class="flex justify-center mt-4">
                <SubmitButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing" type="submit">
                    Enregistrer
                </SubmitButton>
            </div>
        </div>
        
    </form>
    
</template>

<script>
import InputLabel from '@/Components/InputLabel.vue'
import SubmitButton from '@/Components/SubmitButton.vue';

    export default {
    props: ['formation', 'myComment'],
    data() {
        return {
            stars: [1, 2, 3, 4, 5],
            temp_index: null,
            form: this.$inertia.form({
                star: null,
                formation_id: this.formation,
                commentaire: null,
                avis_id: null
            }),
        };
    },
    created(){
        if (this.myComment) {
            this.form.star= this.myComment.valeur
            if(this.myComment.commentaire)
                this.form.commentaire= this.myComment.commentaire.contenu
            this.form.avis_id= this.myComment.id
        }
    },
    methods: {
        hoverRating(i) {
            this.temp_index = i;
        },
        outRating() {
            this.temp_index = null;
        },
        setStar(i) {
            this.form.star = i;
        },
        hide(){
            this.$emit('close')
        },
        submit() {
            //console.log(this.form);
            this.form.post(route('store.avis'), {
                preserveScroll: true
            });
        }
    },
    components: { InputLabel, SubmitButton }
}
</script>

<style lang="scss" scoped>

</style>