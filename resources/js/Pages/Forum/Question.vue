<template>
    <div class="py-2">
        <div class="flex items-center gap-2">
            <img src="/images/boy.jpg" alt="" class="w-10 h-10 rounded-full">
            <div>
                <div class="text-lg">{{ question.user.nom }} {{ question.user.prenom }}</div>
                <!-- <div class="text-xs">{{ getTime(question.created_at) }}</div> -->
                <div class="text-xs ml-2">{{ getDate(question.created_at) }}</div>
            </div>
        </div>
        
        <div class="ml-2" v-html="question.question"></div>
        
        <div v-if="!repondre && canAnswer" @click="repondre=true" class="cursor-pointer font-bold ml-4">repondre</div>
        <NewReponse v-else-if="repondre && canAnswer" :path="path" :id="question.id" :formation_id="formation_id" @close="repondre=false"></NewReponse>
        <div class="mt-2">
            <div v-for="reponse in question.reponses" class="flex flex-column gap-2 ml-4">
                <Reponse :reponse="reponse" :formation_id="formation_id" :canUpdate="canUpdate" :canInteract="canInteract" :canAnswer="canAnswer"></Reponse>
            </div>
        </div>
        
    </div>
</template>

<script>
import NewReponse from './NewReponse.vue';
import Reponse from './Reponse.vue';

    export default {
    props: ['question', 'path', 'formation_id', 'canUpdate', 'canInteract'],
    data() {
        return {
            repondre: false,
            canAnswer: ((this.$page.props.canSurfe || this.$page.props.canCreate) && !this.formation_id) || (this.formation_id && (this.canInteract || this.canUpdate))
        };
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
    },
    components: { NewReponse, Reponse }
}
</script>

<style lang="scss" scoped>

</style>