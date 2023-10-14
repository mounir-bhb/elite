<template>
    <MainLayout :simple="true">
        <Formations :formations="formations" :matieres="matieres" :cycles="cycles"></Formations>
        <Footer></Footer>
    </MainLayout>
    

</template>

<script>
    import MainLayout from '@/Layouts/MainLayout.vue';
    import FormationCard from './FormationCard.vue';
    import Formations from './Formations.vue';
    import Footer from '@/Components/Footer.vue';
    export default {
    props: ['formations','cycles', 'matieres'],
    components: { FormationCard, MainLayout, Formations, Footer },
    
    
}
</script>

<style lang="scss" scoped>
    .formations{
        margin-top: 80px;
    }
</style>