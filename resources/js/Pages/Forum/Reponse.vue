<template>
    <div class="">
        <div class="flex items-center gap-2">
            <img src="/images/boy.jpg" alt="" class="w-10 h-10 rounded-full">
            <div>
                <div class="text-lg">{{ reponse.user.nom }} {{ reponse.user.prenom }}</div>
                <!-- <div class="text-xs ml-2">{{ getTime(reponse.created_at) }}</div> -->
                <div class="text-xs ml-2">{{ getDate(reponse.created_at) }}</div>
            </div>
        </div>
        
        
        <div v-html="reponse.reponse" class="ml-2"></div>
        
        <div class="flex gap-2 mt-1 ml-2">
            <div v-if="!repondre && canAnswer" @click="repondre=true" class="cursor-pointer font-bold">repondre</div>
            
            <button @click="like ? resetAvis(): submitAvis('like')" v-if="canAnswer && !canUpdate">
                <svg xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6" :class="like ? 'fill-red-600 stroke-none' : 'fill-none'">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />
                </svg>
            </button>
            <div v-else-if="!$page.props.auth.user">
                <svg xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 fill-none">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />
                </svg>
            </div>
            
            <button @click="valider" v-if="!is_valide && canUpdate">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </button>
            <button v-if="is_valide" @click="canUpdate? annuleValidation() : ''">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="rgb(4, 14, 158)" class="w-6 h-6">
                    <path fill-rule="evenodd" d="M12.516 2.17a.75.75 0 00-1.032 0 11.209 11.209 0 01-7.877 3.08.75.75 0 00-.722.515A12.74 12.74 0 002.25 9.75c0 5.942 4.064 10.933 9.563 12.348a.749.749 0 00.374 0c5.499-1.415 9.563-6.406 9.563-12.348 0-1.39-.223-2.73-.635-3.985a.75.75 0 00-.722-.516l-.143.001c-2.996 0-5.717-1.17-7.734-3.08zm3.094 8.016a.75.75 0 10-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 00-1.06 1.06l2.25 2.25a.75.75 0 001.14-.094l3.75-5.25z" clip-rule="evenodd" />
                </svg>
            </button>

            <div>
                {{ likes }}
            </div>
            
        </div>
        
        <NewReponse v-if="repondre && canAnswer" path="reponse" :id="reponse.id" :formation_id="formation_id" @close="repondre=false"></NewReponse>
        <div class="mt-2">
            <div v-for="rep in reponse.reponses" class="flex flex-column gap-2 ml-4">
                <Reponse :reponse="rep" :formation_id="formation_id"></Reponse>
            </div>
        </div>
        
    </div>
</template>

<script>
    import NewReponse from './NewReponse.vue';
    import Reponse from './Reponse.vue';

    export default {
        components: { NewReponse },
        props: ['reponse', 'formation_id', 'canUpdate', 'canInteract', 'canAnswer'],
        data() {
            return {
                repondre: false,
                is_valide: this.reponse.is_valid,
                likes: 0,
                like: null,
                like_form: {
                    formation: this.formation_id,
                    reponse_id: this.reponse.id,
                    avis:'',
                },
                valide_form: {
                    formation: this.formation_id,
                    reponse_id: this.reponse.id,
                }
            }
        },
        created(){
            if(this.reponse.likes.length){
                this.likes= this.reponse.likes.length
                //this.like = this.reponse.likes.some(obj => obj.user_id === this.$page.props.auth.user.id);
                if(this.$page.props.auth.user)
                this.like= this.reponse.likes.find(obj => obj.user_id === this.$page.props.auth.user.id);
            }
                
        },
        methods: {
            getDate(dateTimeString) {
                const dateObject = new Date(dateTimeString);
                return dateObject.toISOString().slice(0, 10);
            },
            getTime(dateTimeString) {
                const dateObject = new Date(dateTimeString);
                const hours = dateObject.getUTCHours().toString().padStart(2, "0");
                const minutes = dateObject.getUTCMinutes().toString().padStart(2, "0");
                return `${hours}:${minutes}`;
                //return dateObject.toISOString().slice(11, 19);
            },
            async submitAvis(avis){
                this.like= true
                this.likes++
                this.like_form.avis=avis
                try{
                    const response = await axios.post(route('store.like'), this.like_form);
                }catch (error) {
                    console.log(error);
                }
                
                /* this.like_form.post(route('store.like'),{
                    preserveScroll: true
                }) */
            },
            async resetAvis(){
                this.like= null
                this.likes--
                try{
                    const response = await axios.delete(route('delete.like', this.like));
                    
                }catch (error) {
                    console.log(error);
                }
                
            },
            async valider(){
                this.is_valide=true
                try{
                    const response = await axios.post(route('valider.reponse'), this.valide_form);
                }catch (error) {
                    console.log(error);
                }
            },
            async annuleValidation(){
                this.is_valide= false
                try{
                    const response = await axios.post(route('valideation.annule'), this.valide_form);
                }catch (error) {
                    console.log(error);
                }
            }
        }
    }
</script>

<style lang="scss" scoped>

</style>