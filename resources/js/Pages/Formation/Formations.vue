<template>
    <div class="mx-20 mt-20 min-h-screen">
        <div class="mt-20 mb-10">
            <Filter :matieres="matieres" :cycles="cycles" :items="formations" @items="newItems"
            ></Filter>
        </div>
        <Link :href="route('formation.create')" class="p-2 rounded-md bg-blue-600 text-white text-lg" v-if="$page.props.canCreate">Créer une formation</Link>
        <div class="flex flex-wrap gap-8 mt-10">
            <div v-for="(formation, index) in selectedFormations" :key="index" >
                <FormationCard :formation="formation"></FormationCard>
            </div>
        </div>
    </div>
    
</template> 

<script>
    import MainLayout from '@/Layouts/MainLayout.vue';
    import FormationCard from './FormationCard.vue';
    import { Link } from '@inertiajs/vue3';
    import Filter from '@/Components/Filter.vue';
    export default {
        components: { FormationCard, MainLayout, Link, Filter },
        props: ['formations', 'cycles', 'matieres'],
        data(){
            return {
                selectedFormations: this.formations,
                
            }
        },
        
        methods: {
            newItems(items){
                //console.log(items);
                this.selectedFormations= items
            }
        }
    }
</script>

<style lang="scss" scoped>
    
</style>