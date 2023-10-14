<template>
    <div class="py-2">
        <div class="text-gray-900">{{ sujet.user.nom }} {{ sujet.user.prenom }}</div>
        <div class="text-xs">{{ getTime(sujet.created_at) }}</div>
        <!-- <div>{{ sujet.titre }}</div> -->
        <div v-html="sujet.question" class="ml-2"></div>
        <div>{{ getDate(sujet.created_at) }}</div>
    </div>
</template>

<script>
    export default {
        props: ['sujet'],
        data(){
            return {

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
        }
    }
</script>

<style lang="scss" scoped>

</style>