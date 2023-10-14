<template>
    <div>
        <div>{{ question.contenu }}</div>

        <div class="w-full px-4 py-16">
            <div class="mx-auto w-full max-w-md">
                <div >
                    <div class="space-y-2">
                        <div
                            as="template"
                            v-for="(reponse, index) in question.reponses"
                            :key="index"
                            :value="reponse.id"
                        >
                            <div
                                :class="[
                                    active
                                        ?   'r  ing-2 ring-white ring-opacity-60 ring-offset-2 ring-offset-sky-300'
                                        :   ''  ,
                                    checked ? 'bg-sky-900 bg-opacity-75 text-white ' : 'bg-white ',
                                ]"
                                class="relative flex cursor-pointer rounded-lg px-5 py-4 shadow-md focus:outline-none"
                            >
                                <div class="flex w-full items-center justify-between">
                                    <div class="flex items-center">
                                        <div class="text-sm">
                                            <div
                                                as="p"
                                                :class="checked ? 'text-white' : 'text-gray-900'"
                                                class="font-medium"
                                            >
                                                {{ reponse.contenu }}
                                            </div>
                                            <!-- <divDescription
                                                as="span"
                                                :class="checked ? 'text-sky-100' : 'text-gray-500'"
                                                class="inline"
                                            >
                                                <span> {{ plan.ram }}/{{ plan.cpus }}</span>
                                                <span aria-hidden="true"> &middot; </span>
                                                <span>{{ plan.disk }}</span>
                                            </divDescription> -->
                                        </div>
                                    </div>
                                    <div v-show="checked" class="shrink-0 text-white">
                                        <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none">
                                            <circle
                                                cx="12"
                                                cy="12"
                                                r="12"
                                                fill="#fff"
                                                fill-opacity="0.2"
                                            />
                                            <path
                                                d="M7 13l3 3 7-7"
                                                stroke="#fff"
                                                stroke-width="1.5"
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                            />
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- <div v-for="reponse in question.reponses">
            {{ reponse.contenu }}
        </div> -->
    </div>
</template>

<script>
   
    export default {
        
        props: ['question'],
    }
</script>

<style lang="scss" scoped>

</style>