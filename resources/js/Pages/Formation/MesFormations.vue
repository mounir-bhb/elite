<template>
    <MainLayout>
        <Formations :formations="formations"></Formations>
    </MainLayout>
    <!-- <div>
        {{ formations }}
    </div> -->
</template>

<script>
import MainLayout from '@/Layouts/MainLayout.vue';
import FormationCard from './FormationCard.vue';
import Formations from './Formations.vue';

    export default {
    props: ['formations'],
    components: { MainLayout, FormationCard, Formations }
}
</script>

<style lang="scss" scoped>

</style>