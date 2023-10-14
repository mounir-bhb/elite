<template>
    <div>
        <div>
            {{ question.question }}
        </div>
        <NewMap :countries="question.reponse" @validate="$emit('validate')"></NewMap>
    </div>
</template>

<script>
    import NewMap from '@/Components/NewMap.vue';
    export default {
        components:{
            NewMap
        },
        props: ['question'],
        emits: ['validate'],
    }
</script>

<style lang="scss" scoped>

</style>