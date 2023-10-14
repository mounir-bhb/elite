<template>
    <div class="relative h-screen">
        <div class="img">
            <img src="images/virtual_school_Learner.jpg" alt="" srcset="" class="h-screen w-full object-cover pt-10">
        </div>
        <!-- <div class="slogan-1">
            Apprenez en ligne, réussissez à votre rythme
        </div>
        <div class="slogan-2">
            Explorez, apprenez et grandissez.
        </div> -->
        <div class="action">
            <Link href="formation.index" class="px-2 py-8 text-2xl">Consulter les formations</Link>
        </div>
    </div>
</template>

<script>
    import { Link } from '@inertiajs/vue3';
    export default {
        components: { Link }
    }
</script>

<style lang="scss" scoped>
    /* .img{
        filter: blur(1px);
    } */
    .slogan-1{
        position: absolute;
        top : 48%;
        left: 50%;
        transform: translate(-50%, -70%);
        font-size: xx-large;
        font-weight: bolder;
        padding: 3px 6px;
        border-radius: 10px;
        /* backdrop-filter: blur(1px); */
        /* background-color: rgba(4, 4, 180, 0.76); */
        color: black;
    }
    .slogan-2{
        position: absolute;
        top : 52%;
        left: 50%;
        transform: translate(-50%, 20%);
        font-size: xx-large;
        font-weight: bolder;
        padding: 3px 6px;
        
        border-radius: 10px;
        /* backdrop-filter: blur(15px); */
        /* background-color: rgba(4, 4, 180, 0.76); */
        color: black;
    }
    .action{
        position: absolute;
        top : 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background-color: rgba(2, 2, 116, 0.575);
        color: white;
        border-radius: 5px;
    }
</style>