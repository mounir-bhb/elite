<script setup>
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import { Link } from '@inertiajs/vue3';
</script>

<template>
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100 dark:bg-gray-900">
        <div>
            <Link href="/acceuil">
                <img src="/images/logo.png" alt="" class="logo-img">
                <h1 class="text-gray-900 text-center z-10">ELITE CORNER</h1>
            </Link>
        </div>

        <div
            class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-lg"
        >
            <slot />
        </div>
    </div>
</template>
<style lang="scss" scoped>
    h1{
        font-size: xx-large;
        font-weight: bold;
    }
</style>
