<template>
    <div class="flex justify-center">
        <form @submit.prevent="submit" class="shadow-md w-fit p-6 relative">
            <div  class="absolute top-4 right-4 text-lg cursor-pointer" @click="hide">X</div>
            <div>
                <div class="flex justify-center">
                    <div class="btn btn-add underline text-lg hover:font-bold cursor-pointer" @click="ajouterPaiment">Ajouter</div>
                </div>
                <div class="flex justify-center gap-4 flex-wrap">
                    <div v-if="prices" class="flex justify-center gap-2 flex-wrap mx-30">
                        <div v-for="(price, index) in form.old_prices" class="shadow-md p-4 relative">
                            <div>
                                <InputLabel>Type d'abonnement</InputLabel>
                                <Listbox v-model="form.old_prices[index].type">
                                <div class="relative mt-1">
                                    <ListboxButton
                                        class="relative w-full cursor-default rounded-lg bg-[#eee] py-2 pl-3 pr-10 text-left shadow-md focus:outline-none focus-visible:border-indigo-500 focus-visible:ring-2 focus-visible:ring-white focus-visible:ring-opacity-75 focus-visible:ring-offset-2 focus-visible:ring-offset-orange-300 sm:text-sm"
                                    >
                                        <span class="block truncate" v-if="form.old_prices[index].type">{{ form.old_prices[index].type }}</span>
                                        <span class="block truncate" v-else>Choisi une option</span>
                                        <span
                                            class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-2"
                                        >
                                        <ChevronUpDownIcon
                                            class="h-5 w-5 text-gray-400"
                                            aria-hidden="true"
                                        />
                                        </span>
                                    </ListboxButton>
                                
                                    
                                </div>
                            </Listbox>
                            </div>
                            <div class="mt-3">
                                <InputLabel>Prix d'abonnement</InputLabel>
                                <TextInput type="number" v-model="form.old_prices[index].price" disabled class="bg-[#eee]"></TextInput>
                            </div>
                            <div class="mt-3">
                                <InputLabel>abonnement actif</InputLabel>
                                <Listbox v-model="form.old_prices[index].is_active">
                                <div class="relative mt-1">
                                    <ListboxButton
                                        class="relative w-full cursor-default rounded-lg bg-white py-2 pl-3 pr-10 text-left shadow-md focus:outline-none focus-visible:border-indigo-500 focus-visible:ring-2 focus-visible:ring-white focus-visible:ring-opacity-75 focus-visible:ring-offset-2 focus-visible:ring-offset-orange-300 sm:text-sm"
                                    >
                                        <span class="block truncate" v-if="form.old_prices[index].is_active === 1">Oui</span>
                                        <span class="block truncate" v-if="form.old_prices[index].is_active === 0">Non</span>
                                        <!-- <span class="block truncate" v-else>Choisi une option</span> -->
                                        <span
                                            class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-2"
                                        >
                                        <ChevronUpDownIcon
                                            class="h-5 w-5 text-gray-400"
                                            aria-hidden="true"
                                        />
                                        </span>
                                    </ListboxButton>
                                
                                    <transition
                                    leave-active-class="transition duration-100 ease-in"
                                    leave-from-class="opacity-100"
                                    leave-to-class="opacity-0"
                                    >
                                        <ListboxOptions
                                        class="absolute z-40 mt-1 max-h-60 w-full overflow-auto rounded-md bg-white py-1 text-base shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none sm:text-sm"
                                        >
                                            <ListboxOption
                                            v-slot="{ active, selected }"
                                            
                                            :value="1"
                                            as="template"
                                            >
                                                <li
                                                :class="[
                                                    active ? 'bg-amber-100 text-amber-900' : 'text-gray-900',
                                                    'relative cursor-default select-none py-2 pl-10 pr-4',
                                                ]"
                                                >
                                                    <span
                                                    :class="[
                                                        selected ? 'font-medium' : 'font-normal',
                                                        'block truncate',
                                                    ]"
                                                    >Oui</span
                                                    >
                                                    <span
                                                    v-if="selected"
                                                    class="absolute inset-y-0 left-0 flex items-center pl-3 text-amber-600"
                                                    >
                                                    <CheckIcon class="h-5 w-5" aria-hidden="true" />
                                                    </span>
                                                </li>
                                            </ListboxOption>
                                            <ListboxOption
                                            v-slot="{ active, selected }"
                                            
                                            :value="0"
                                            as="template"
                                            >
                                                <li
                                                :class="[
                                                    active ? 'bg-amber-100 text-amber-900' : 'text-gray-900',
                                                    'relative cursor-default select-none py-2 pl-10 pr-4',
                                                ]"
                                                >
                                                    <span
                                                    :class="[
                                                        selected ? 'font-medium' : 'font-normal',
                                                        'block truncate',
                                                    ]"
                                                    >Non</span
                                                    >
                                                    <span
                                                    v-if="selected"
                                                    class="absolute inset-y-0 left-0 flex items-center pl-3 text-amber-600"
                                                    >
                                                    <CheckIcon class="h-5 w-5" aria-hidden="true" />
                                                    </span>
                                                </li>
                                            </ListboxOption>
                                        </ListboxOptions>
                                    </transition>
                                </div>
                            </Listbox>
                            </div>
                            <!-- <div class="flex justify-center my-4">
                                <div class="btn btn-del" @click="supprimerOldPaiment(index)">supprimer</div>
                            </div> -->
                        </div>
                    </div>
                    <div v-for="(price, index) in form.new_prices" class="shadow-md p-4 relative">
                        <div  class="absolute top-2 right-2 text-lg cursor-pointer text-red-600" @click="supprimerPaiment(index)" v-if="form.new_prices.length>1">X</div>
                        <div>
                            <InputLabel>Type d'abonnement</InputLabel>
                            <Listbox v-model="form.new_prices[index].type">
                            <div class="relative mt-1">
                                <ListboxButton
                                    class="relative w-full cursor-default rounded-lg bg-white py-2 pl-3 pr-10 text-left shadow-md focus:outline-none focus-visible:border-indigo-500 focus-visible:ring-2 focus-visible:ring-white focus-visible:ring-opacity-75 focus-visible:ring-offset-2 focus-visible:ring-offset-orange-300 sm:text-sm"
                                >
                                    <span class="block truncate" v-if="form.new_prices[index].type">{{ form.new_prices[index].type }}</span>
                                    <span class="block truncate" v-else>Choisi une option</span>
                                    <span
                                        class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-2"
                                    >
                                    <ChevronUpDownIcon
                                        class="h-5 w-5 text-gray-400"
                                        aria-hidden="true"
                                    />
                                    </span>
                                </ListboxButton>
                            
                                <transition
                                leave-active-class="transition duration-100 ease-in"
                                leave-from-class="opacity-100"
                                leave-to-class="opacity-0"
                                >
                                    <ListboxOptions
                                    class="absolute z-40 mt-1 max-h-60 w-full overflow-auto rounded-md bg-white py-1 text-base shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none sm:text-sm"
                                    >
                                        <ListboxOption
                                        v-slot="{ active, selected }"
                                        v-for="t in types"
                                        
                                        :value="t"
                                        as="template"
                                        >
                                            <li
                                            :class="[
                                                active ? 'bg-amber-100 text-amber-900' : 'text-gray-900',
                                                'relative cursor-default select-none py-2 pl-10 pr-4',
                                            ]"
                                            >
                                                <span
                                                :class="[
                                                    selected ? 'font-medium' : 'font-normal',
                                                    'block truncate',
                                                ]"
                                                >{{ t }}</span
                                                >
                                                <span
                                                v-if="selected"
                                                class="absolute inset-y-0 left-0 flex items-center pl-3 text-amber-600"
                                                >
                                                <CheckIcon class="h-5 w-5" aria-hidden="true" />
                                                </span>
                                            </li>
                                        </ListboxOption>
                                    </ListboxOptions>
                                </transition>
                            </div>
                        </Listbox>
                        </div>
                        <div class="mt-3">
                            <InputLabel>Prix d'abonnement</InputLabel>
                            <TextInput type="number" v-model="form.new_prices[index].price"></TextInput>
                        </div>
                        <!-- <div class="flex justify-center my-4">
                            <div class="btn btn-del" @click="supprimerPaiment(index)"
                            v-if="form.new_prices.length>1">supprimer</div>
                        </div> -->
                    </div>
                </div>
                
            </div>
            <div class="flex justify-center mt-4">
                <SubmitButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing" type="submit">
                    Enregistrer
                </SubmitButton>
            </div>
        </form>
    </div>
</template>

<script>
    import InputLabel from '@/Components/InputLabel.vue';
    import SubmitButton from '@/Components/SubmitButton.vue';
    import TextInput from '@/Components/TextInput.vue';
    import {
        Listbox,
        ListboxLabel,
        ListboxButton,
        ListboxOptions,
        ListboxOption,
    } from '@headlessui/vue'
    import { CheckIcon, ChevronUpDownIcon } from '@heroicons/vue/20/solid'

    export default {
        components: { SubmitButton, Listbox, ListboxLabel, ListboxButton, ListboxOptions, ListboxOption, CheckIcon, ChevronUpDownIcon, InputLabel, TextInput },
        props: ['prices'],
        data() {
            return {
                form: this.$inertia.form({
                    old_prices: this.prices,
                    new_prices: [{
                        type: null,
                        price: ''
                    }],
                }),
                types: ['1 mois','3 mois', '1 année', 'illimité'],
            };
        },
        methods: {
            hide(){
                this.$emit('close')
            },
            ajouterPaiment() {
                this.form.new_prices.push({
                    type: null,
                    price: ''
                });
            },
            supprimerPaiment(index) {
                if (this.form.new_prices.length > 1)
                    this.form.new_prices.splice(index, 1);
            },
            

            submit(){
                this.form.post(route('quiz.prices'), {
                    preserveScroll: true
                })
            }
        },
    }
</script>

<style lang="scss" scoped>

</style>