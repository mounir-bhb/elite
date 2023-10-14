<template>
    <div>
        <div class="flex gap-1 items-center cursor-pointer py-2 hover:bg-[#eee]" @click="open=!open">
            <span >
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-5 transform duration-700" :class=" open ? 'rotate-90 ': ''">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                </svg>

            </span>
            <!-- <span>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                </svg>
            </span> -->
            <div class="text-xl">
                {{ chapitre.titre }}
            </div>
        </div>
                    
        <div v-for="(cour, cindex) in chapitre.cours" class="" v-if="open">
            <div class="pl-10 text-lg cursor-pointer hover:bg-[#eee]">
                {{ cour.titre }}
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['chapitre'],
        data(){
            return {
                open: false
            }
        }
    }
</script>

<style lang="scss" scoped>

</style>