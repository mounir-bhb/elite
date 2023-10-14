<template>
    <MainLayout :simple="true">
    <div class="create-user">
        
        <div class="flex justify-center items-center gap-4">
            <RadioGroup v-model="role">
                <div class="flex space-x-8">

                <RadioGroupOption
                  as="template"
                  v-for="rol in roles"
                  :key="rol"
                  :value="rol"
                  v-slot="{ active, checked }"
                >
                    <div
                        :class="[
                            active
                                ? 'ring-2 ring-white ring-opacity-60 ring-offset-2 ring-offset-sky-300'
                                : '',
                            checked ? 'bg-sky-900 bg-opacity-75 text-white ' : 'bg-white ',
                        ]"
                        class="relative flex cursor-pointer rounded-lg px-5 py-4 shadow-md focus:outline-none"
                    >
                        <div class="flex w-full items-center justify-between gap-4">
                            <div class="flex items-center">
                                <div class="text-sm">
                                    <RadioGroupLabel
                                        as="p"
                                        :class="checked ? 'text-white' : 'text-gray-900'"
                                        class="font-medium"
                                    >
                                        {{ rol }}
                                    </RadioGroupLabel>
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
                </RadioGroupOption>
            
                </div>

            </RadioGroup>
            </div>
        <CreateStudent v-if="role=='Etudiant'" :cycles="cycles"></CreateStudent>
        <CreateTeacher v-else-if="role=='Enseignant'"></CreateTeacher>
    </div>
    </MainLayout>
</template>

<script>
    
    import CreateStudent from './Student/CreateStudent.vue';
    import CreateTeacher from './Teacher/CreateTeacher.vue';
    import MainLayout from '@/Layouts/MainLayout.vue';
    /* import { ref } from 'vue' */
    import {
        RadioGroup,
        RadioGroupLabel,
        RadioGroupOption,
        RadioGroupDescription
    } from '@headlessui/vue'
    export default {
        components:{
            CreateStudent,
            CreateTeacher,
            
            MainLayout,
            RadioGroup,
            RadioGroupLabel,
            RadioGroupOption,
            RadioGroupDescription
        },
        props:['cycles'],
        data(){
            return {
                roles:['Etudiant','Enseignant'],
                role:'Etudiant'
            }
        },
        
    }
</script>

<style lang="scss">
    .create-user{
        margin-top: 100px;
    }
</style>