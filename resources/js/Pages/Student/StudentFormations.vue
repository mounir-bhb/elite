<template>
    <div>
        <MainLayout>
            <div class="formations flex flex-wrap gap-8 mx-20 mt-20">
                <div v-for="formation in formations">
                    <FormationCard :formation="formation.formation"></FormationCard>
                </div>
            </div>
        </MainLayout>
    </div>
</template>

<script>
    import MainLayout from '@/Layouts/MainLayout.vue'
    import FormationCard from '../Formation/FormationCard.vue';
    export default {
        components: { MainLayout, FormationCard },
        props: ['formations']
    }
</script>

<style lang="scss" scoped>

</style>