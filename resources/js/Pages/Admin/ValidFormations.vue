<template>
    <div class="flex justify-center pt-6">
        <table>
            <tr>
                <th></th>
                <th>Titre de formation</th>
                <th>Enseigant</th>
                
                <th>Téléphone</th>
                
            </tr>
            <tr v-for="(formation, index) in new_formations">
                <td>
                    <img :src="'/storage/'+formation.photo_url" alt="" class="w-20">
                </td>
                <td class="text-center"><Link :href="route('formation.details',formation.id)">{{ formation.title }}</Link></td>
                <td class="text-center">{{ formation.teacher.user.nom }} {{ formation.teacher.user.prenom }}</td>
                <td class="text-center">{{ formation.teacher.tel }}</td>
                
                <td>
                    <div class="m-2 p-2 rounded-lg bg-blue-700 text-white cursor-pointer transition duration-700 hover:bg-red-600" @click="enable(formation.id, index)" v-if="!formation.is_valide">
                        Valider
                    </div>
                </td>
            </tr>
        </table>
    </div>
</template>

<script>
import axios from 'axios';
import { Link } from '@inertiajs/vue3';
    export default {
        components: { Link },
        props: ['formations'],
        data(){
            return {
                new_formations: this.formations,
                
            }
        },
        methods:{
            async enable(formation, index){
                try{
                    //this.montant= montant
                    const response= await axios.put('/enable-formation', {formation_id: formation})
                    this.new_formations[index].is_valide= true
                } catch (error) {
                    console.log(error);
                }
            },
        }
    }
</script>

<style lang="scss" scoped>
    td, th{
        padding: 2px 8px;
        font-size: large;
    }
</style>