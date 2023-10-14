<template>
    <div class="shadow-lg bg-white">
        <div class="px-4 pt-4 text-xl">{{ question.contenu }}</div>

        <div class="w-full px-4 py-4">
            <div class="mx-auto w-full max-w-md">
                <RadioGroup v-model="selected">
                    <div class="space-y-2">
                        <RadioGroupOption
                            as="template"
                            v-for="(reponse, index) in question.reponses"
                            :key="index"
                            :value="reponse.is_true"
                            v-slot="{ active, checked }"
                            @click="emitChange"
                        >
                            <div
                                :class="[
                                    active
                                        ?   'ring-2 ring-white ring-opacity-60 ring-offset-2 ring-offset-sky-300'
                                        :   ''  ,
                                    checked 
                                        ?   reponse.is_true ? 'bg-sky-800 text-white ' : 'bg-red-600 text-white ' : 'bg-white ',
                                    
                                ]"
                                class="relative flex cursor-pointer rounded-lg px-5 py-4 shadow-md focus:outline-none"
                            >
                                <div class="flex w-full items-center justify-between">
                                    <div class="flex items-center">
                                        <div class="text-sm">
                                            <RadioGroupLabel
                                                as="p"
                                                :class="checked ? 'text-white' : 'text-gray-900'"
                                                class="font-medium"
                                            >
                                                {{ reponse.contenu }}
                                            </RadioGroupLabel>
                                            <!-- <RadioGroupDescription
                                                as="span"
                                                :class="checked ? 'text-sky-100' : 'text-gray-500'"
                                                class="inline"
                                            >
                                                <span> {{ plan.ram }}/{{ plan.cpus }}</span>
                                                <span aria-hidden="true"> &middot; </span>
                                                <span>{{ plan.disk }}</span>
                                            </RadioGroupDescription> -->
                                        </div>
                                    </div>
                                    <div v-show="checked" class="shrink-0 text-white">
                                        <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" v-if="reponse.is_true">
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
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="white" class="w-6 h-6" v-else>
                                            <path fill-rule="evenodd" d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25zm-1.72 6.97a.75.75 0 10-1.06 1.06L10.94 12l-1.72 1.72a.75.75 0 101.06 1.06L12 13.06l1.72 1.72a.75.75 0 101.06-1.06L13.06 12l1.72-1.72a.75.75 0 10-1.06-1.06L12 10.94l-1.72-1.72z" clip-rule="evenodd" />
                                        </svg>

                                    </div>
                                </div>
                            </div>
                        </RadioGroupOption>
                    </div>
                </RadioGroup>
                <div v-if="selected === 0" class="flex gap-2 py-3">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="red" class="w-6 h-6">
                        <path fill-rule="evenodd" d="M9.401 3.003c1.155-2 4.043-2 5.197 0l7.355 12.748c1.154 2-.29 4.5-2.599 4.5H4.645c-2.309 0-3.752-2.5-2.598-4.5L9.4 3.003zM12 8.25a.75.75 0 01.75.75v3.75a.75.75 0 01-1.5 0V9a.75.75 0 01.75-.75zm0 8.25a.75.75 0 100-1.5.75.75 0 000 1.5z" clip-rule="evenodd" />
                    </svg>
                    <div>
                        faux!! essaye encore
                    </div>
                    
                </div>
                <div v-else-if="selected == true"  class="flex gap-2 py-3">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="w-6 h-6" fill="blue">
                        <path d="M10.007 2.10377C8.60544 1.65006 7.08181 2.28116 6.41156 3.59306L5.60578 5.17023C5.51004 5.35763 5.35763 5.51004 5.17023 5.60578L3.59306 6.41156C2.28116 7.08181 1.65006 8.60544 2.10377 10.007L2.64923 11.692C2.71404 11.8922 2.71404 12.1078 2.64923 12.308L2.10377 13.993C1.65006 15.3946 2.28116 16.9182 3.59306 17.5885L5.17023 18.3942C5.35763 18.49 5.51004 18.6424 5.60578 18.8298L6.41156 20.407C7.08181 21.7189 8.60544 22.35 10.007 21.8963L11.692 21.3508C11.8922 21.286 12.1078 21.286 12.308 21.3508L13.993 21.8963C15.3946 22.35 16.9182 21.7189 17.5885 20.407L18.3942 18.8298C18.49 18.6424 18.6424 18.49 18.8298 18.3942L20.407 17.5885C21.7189 16.9182 22.35 15.3946 21.8963 13.993L21.3508 12.308C21.286 12.1078 21.286 11.8922 21.3508 11.692L21.8963 10.007C22.35 8.60544 21.7189 7.08181 20.407 6.41156L18.8298 5.60578C18.6424 5.51004 18.49 5.35763 18.3942 5.17023L17.5885 3.59306C16.9182 2.28116 15.3946 1.65006 13.993 2.10377L12.308 2.64923C12.1078 2.71403 11.8922 2.71404 11.692 2.64923L10.007 2.10377ZM6.75977 11.7573L8.17399 10.343L11.0024 13.1715L16.6593 7.51465L18.0735 8.92886L11.0024 15.9999L6.75977 11.7573Z"></path>
                    </svg>
                    <div>
                        bravooo!! passer a la question suivante
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
    import {
        RadioGroup,
        RadioGroupLabel,
        RadioGroupDescription,
        RadioGroupOption,
    } from '@headlessui/vue'
    export default {
        components: {
            RadioGroup,
            RadioGroupLabel,
            RadioGroupDescription,
            RadioGroupOption,
        },
        props: ['question', 'submitted'],
        data(){
            return {
                selected: ''
            }
        },
        emits: ['checked'],
        /* watch: {
            'this.selected'(newValue){
                console.log('heeyy');
            }
        }, */
        methods: {
            emitChange(){
                const sel= this.selected
                this.$emit('checked', {sel})
            }
        }
    }
</script>

<style lang="scss" scoped>

</style>