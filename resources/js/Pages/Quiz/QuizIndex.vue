<template>
    <div>
        <MainLayout>
            <div class="mt-20">
                <Filter :cycles="cycles" :matieres="matieres" :items="tests" @items="newItems"></Filter>
                <div class="tests mx-20">
                    <div class="flex justify-center gap-2 my-4">
                        <div class="p-3 mt-8 bg-slate-500 w-fit text-white rounded-lg cursor-pointer" 
                            @click="open_test=true"
                            v-if="!open_test && $page.props.canAdministrate"
                        >
                            Créé un test
                        </div>
                        <div class="p-3 mt-8 bg-slate-500 w-fit text-white rounded-lg cursor-pointer" 
                            @click="open_price=true"
                            v-if="!open_price && $page.props.canAdministrate"
                        >
                            Modifier les prix
                        </div>
                    </div>
                    
                    <CreateTest :cycles="cycles" :matieres="matieres" v-if="open_test && $page.props.canAdministrate" @close="open_test=false"></CreateTest>
                    <EditTestPrice v-if="open_price && $page.props.canAdministrate" :prices="prices" @close="open_price=false"></EditTestPrice>
                    <div class="flex justify-center ">
                        <div class="w-2/3 divide-y">
                            <div v-for="(test, index) in filteredTests">
                                <OpenTest :test="test"></OpenTest>
                            </div>
                        </div>
                    </div>
                    
                    <div class="w-2/3 mt-8">
                        <!-- <CreateQuizMap :cycles="cycles" :matieres="matieres"></CreateQuizMap> -->
                        <!-- <QuizMap></QuizMap> -->
                    </div>
                </div>
                
                <!-- <CreateQuiz></CreateQuiz>
                <CreateTest :cycles="cycles" :matieres="matieres"></CreateTest> -->
                
            </div>
            <form @submit.prevent="submit" v-if="canInscrire">
                    <div class="inscription rounded-lg shadow-md">
                        <div class="text-2xl text-center font-bold pb-2 border-b">
                            Abonnement
                        </div>
                        
                        <div class="w-full px-4 pt-6">
                            <div class="mx-auto w-full max-w-md">
                                <RadioGroup v-model="form.price">
                                    
                                    <div class="space-y-2 space-x-2 flex justify-around flex-wrap">
                                        <RadioGroupOption
                                            as="template"
                                            v-for="price in prices"
                                            
                                            :value="price.id"
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
                                            <div class="flex w-full items-center justify-between">
                                                <div class="flex items-center">
                                                    <div class="text-sm">
                                                        <RadioGroupLabel
                                                        as="p"
                                                        :class="checked ? 'text-white' : 'text-gray-900'"
                                                        class="font-medium"
                                                        >
                                                        <!-- {{ plan.name }} -->
                                                        <div class="text-xl text-center">{{ price.type }}</div>
                                                        <div class="text-xl text-center">
                                                            {{ price.price }} DA
                                                        </div>
                                                        </RadioGroupLabel>
                                                        
                                                    </div>
                                                </div>
                                                <!-- <div v-show="checked" class="shrink-0 text-white">
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
                                                </div> -->
                                            </div>
                                            </div>
                                        </RadioGroupOption>
                                    </div>
                                </RadioGroup>
                            </div>
                        </div>
                            <div class="flex justify-center mt-4">
                                <NewCcp v-model:value="form.image_ccp"></NewCcp>
                            </div>
                            <div class="flex justify-center mt-4">
                                <SubmitButton :class="{ 'opacity-25': form.processing || !can_submit }" :disabled="form.processing || !can_submit" type="submit">
                                    Je m'inscrie
                                </SubmitButton>
                            </div>
                        
                    </div>
                </form>
        </MainLayout>
        
    </div>
</template>

<script>
        import MainLayout from '@/Layouts/MainLayout.vue';
        import CreateQuiz from './CreateQuiz.vue';
        import QuizMap from './QuizMap.vue';
        import Filter from '@/Components/Filter.vue'
        import CreateTest from './CreateTest.vue';
        import Modal from '@/Components/Modal.vue';
        import OpenTest from './OpenTest.vue'
        import CreateQuizMap from './CreateQuizMap.vue';
        import EditTestPrice from './EditTestPrice.vue';
        import SubmitButton from '@/Components/SubmitButton.vue';
        import NewCcp from '@/Components/NewCcp.vue';
        import {
        RadioGroup,
        RadioGroupLabel,
        RadioGroupDescription,
        RadioGroupOption,
    } from '@headlessui/vue'

    export default {
        components: { CreateQuiz, QuizMap, MainLayout, Filter, CreateTest, Modal, OpenTest, CreateQuizMap, EditTestPrice, SubmitButton, NewCcp, RadioGroup,
        RadioGroupLabel,
        RadioGroupDescription,
        RadioGroupOption, },
        props: ['cycles', 'matieres', 'tests', 'prices', 'canInscrire'],
        data() {
            return {
                open_test: false,
                open_price:false,
                filteredTests: this.tests,
                open: null,
                form: this.$inertia.form({
                    image_ccp: null,
                    price: null
                }),
            };
        },
        computed: {
            can_submit(){
                return this.form.image_ccp && this.form.price;
            }
        },
        methods: {
            newItems(items){
                this.filteredTests= items
            },
            submit() {
                this.form.post(route('quiz.inscription'),{
                    preserveScroll: true
                })
            }
        }
}
</script>

<style lang="scss" scoped>
    li{
        margin-left: 10px;
    }
    .section{
        margin: 30px 100px;
        padding: 20px 20px;
    }
    .inscription{
        position: fixed;
        top: 200px;
        right: 50px;
        padding: 20px;
        width: 350px;
    }
    .tests{
        width: calc(100% - 400px);
    }
</style>