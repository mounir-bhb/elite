<template>
    <div class="formation-card shadow-md p-2 bg-slate-50"
        data-aos="fade-up"
        data-aos-offset="0"
        data-aos-delay="500"
        data-aos-duration="700"
        data-aos-easing="ease-in-out"
        data-aos-mirror="false"
        data-aos-once="false"
    >
        <Link :href="route('formation.details',formation.id)">
            <img :src="'/storage/'+formation.photo_url" alt="">
            <div>
                <h2 class="text-center mt-2 underline">{{ formation.title }}</h2>
                
                <!-- <div class="px-3 description text-center">
                    {{ formation.description }}
                </div> -->
            </div>
            <div class="text-center  text-lg"><span class="underline text-lg">Matière</span>: {{ formation.matiere.nom }}</div>
        </Link>
        <div class="flex justify-center flex-wrap gap-3 ">
            <div class="">{{ formation.annee.nom }} année</div>
            <div class="">{{ formation.cycle.nom }}</div>
            <div class="">{{ formation.filiere.nom }}</div>
        </div>
        <div v-if="formation.teacher" class="mt-3 flex gap-2 items-center justify-center">
            <img :src="'/storage/'+formation.teacher.photo_url" alt="" v-if="formation.teacher.photo_url" class="w-8 h-8 rounded-full">
            <img src="/images/boy.jpg" class="w-8 rounded-full" v-else-if="formation.teacher.sex=='Homme'">
            <img src="/images/girl.jpg" class="w-8 rounded-full" v-else-if="formation.teacher.sex=='Femme'">
            <div class="text-lg">
                {{ formation.teacher.user. nom }} {{ formation.teacher.user. prenom }}
            </div>              
        </div>
    </div>
</template>

<script>
    import { Link } from '@inertiajs/vue3';
    
    export default {
        components:{
            Link
        },
        props:['formation'],
    }
</script>

<style lang="scss" scoped>
    .formation-card{
        width: 300px;
    }
    .formation-tag{
        background-color: #eee;
        padding: 5px;
        border-radius: 10px;
    }
    .description{
        overflow: hidden;
        display: -webkit-box;
        -webkit-box-orient: vertical;
        -webkit-line-clamp: 3;
        hyphens: auto;
    }
    /* img{
        border-radius: 20px;
    } */
</style>