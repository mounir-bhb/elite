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
        <img :src="'/storage/'+formation.photo_url" alt="">
        <h2 class="text-center">{{ formation.title }}</h2>
        <div class="text-lg ml-4">Nombre d'inscriptions: {{ formation.nombre_inscri }}</div>
        <div class="text-lg ml-4">Montant reçu: {{ formation.totalPricePaid }} DA</div>
        <div class="text-lg ml-4">Le restes: {{ formation.totalPriceUnpaid }} DA</div>
        <Link :href="route('formation.details',formation.id)" class="text-lg flex justify-center underline pt-2 hover:font-bold">Voir la formation</Link>
    </div>
</template>

<script>
    import { Link } from '@inertiajs/vue3';
    export default {
        components: { Link },
        props: ['formation']
    }
</script>

<style lang="scss" scoped>
    .formation-card{
        width: 300px;
    }
</style>