<template>
    <form @submit.prevent="submit" class=" p-6 shadow-md relative my-4">
        <div class="absolute top-4 right-4 text-lg cursor-pointer" @click="hide">
            X
        </div>
        <div class="my-4 flex justify-center text-xl">
            Posez votre question
        </div>
        <div class="flex justify-around flex-wrap">
        
            <div>
                <div class="mt-3">
                    <InputLabel>Cycle</InputLabel>
                    <div class="w-72">

                        <Listbox v-model="form.cycle">
                            <div class="relative mt-1">
                                <ListboxButton
                                    class="relative w-full cursor-default rounded-lg bg-white py-2 pl-3 pr-10 text-left shadow-md focus:outline-none focus-visible:border-indigo-500 focus-visible:ring-2 focus-visible:ring-white focus-visible:ring-opacity-75 focus-visible:ring-offset-2 focus-visible:ring-offset-orange-300 sm:text-sm"
                                >
                                    <span class="block truncate">{{ form.cycle.nom }}</span>
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
                                        v-for="cycle in cycles"
                                        :key="cycle.id"
                                        :value="cycle"
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
                                                >{{ cycle.nom }}</span
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
                    <!-- <SelectInput v-model:value="form.cycle" :options="cycles" @change="cycleEdited"></SelectInput> -->
                </div>
                <div v-if="filieres.length > 0" class="mt-3">
                    <InputLabel>Filière</InputLabel>
                    <div class="w-72">
                        <Listbox v-model="form.filiere">
                            <div class="relative mt-1">
                                <ListboxButton
                                class="relative w-full cursor-default rounded-lg bg-white py-2 pl-3 pr-10 text-left shadow-md focus:outline-none focus-visible:border-indigo-500 focus-visible:ring-2 focus-visible:ring-white focus-visible:ring-opacity-75 focus-visible:ring-offset-2 focus-visible:ring-offset-orange-300 sm:text-sm"
                                >
                                    <span class="block truncate">{{ form.filiere.nom }}</span>
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
                                        v-for="filiere in filieres"
                                        :key="filiere.id"
                                        :value="filiere"
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
                                                >{{ filiere.nom }}</span
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
                    <!-- <SelectInput v-model:value="form.filiere" :options="form.filieres"></SelectInput> -->
                </div>
                <div v-if="annees.length > 0" class="mt-3">
                    <InputLabel>Année scolaire</InputLabel>
                    <div class="w-72">
                        <Listbox v-model="form.annee">
                            <div class="relative mt-1">
                                <ListboxButton
                                class="relative w-full cursor-default rounded-lg bg-white py-2 pl-3 pr-10 text-left shadow-md focus:outline-none focus-visible:border-indigo-500 focus-visible:ring-2 focus-visible:ring-white focus-visible:ring-opacity-75 focus-visible:ring-offset-2 focus-visible:ring-offset-orange-300 sm:text-sm"
                                >
                                    <span class="block truncate">{{ form.annee.nom }}</span>
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
                                        v-for="annee in annees"
                                        :key="annee.id"
                                        :value="annee"
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
                                                >{{ annee.nom }}</span
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
                    <!-- <SelectInput v-model:value="form.filiere" :options="form.filieres"></SelectInput> -->
                </div>
                <div v-if="matieres.length > 0" class="mt-3">
                    <InputLabel>Matiere</InputLabel>
                    <div class="w-72">
                        <Listbox v-model="form.matiere">
                            <div class="relative mt-1">
                                <ListboxButton
                                class="relative w-full cursor-default rounded-lg bg-white py-2 pl-3 pr-10 text-left shadow-md focus:outline-none focus-visible:border-indigo-500 focus-visible:ring-2 focus-visible:ring-white focus-visible:ring-opacity-75 focus-visible:ring-offset-2 focus-visible:ring-offset-orange-300 sm:text-sm"
                                >
                                    <span class="block truncate">{{ form.matiere.nom }}</span>
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
                                        v-for="matiere in matieres"
                                        :key="matiere.id"
                                        :value="matiere"
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
                                                >{{ matiere.nom }}</span
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
                    <!-- <SelectInput v-model:value="form.filiere" :options="form.filieres"></SelectInput> -->
                </div>
            </div>
            <div>
                <div class="mt-3">
                    <InputLabel>Titre du cours</InputLabel>
                    <TextInput type="text" v-model="form.titre"></TextInput>
                </div>
                <div class="flex items-center mt-3">
                    <SimpleEditor v-model="form.question" placeholder="Poser votre question ici"></SimpleEditor>
                </div>
            </div>
            
            
            
        
        </div>
        <div class="flex justify-center mt-4">
                <SubmitButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing" type="submit">
                    Enregistrer
                </SubmitButton>
            </div>
    </form>
</template>

<script>
    import SubmitButton from '@/Components/SubmitButton.vue';
    import InputLabel from '@/Components/InputLabel.vue';
    import {
        Listbox,
        ListboxLabel,
        ListboxButton,
        ListboxOptions,
        ListboxOption,
    } from '@headlessui/vue'
    import { CheckIcon, ChevronUpDownIcon } from '@heroicons/vue/20/solid'
    import TextInput from '@/Components/TextInput.vue';
    import SimpleEditor from '@/Components/SimpleEditor.vue';

    export default {
        components: {
            SubmitButton,
            InputLabel,
            Listbox,
            ListboxLabel,
            ListboxButton,
            ListboxOptions,
            ListboxOption,
            CheckIcon, 
            ChevronUpDownIcon,
            TextInput,
            SimpleEditor
        },
        props:['matieres', 'cycles'],
        data(){
            return {
                form: this.$inertia.form({
                    cycle: this.cycles[0],
                    annee: this.cycles[0].annees[0],
                    filiere: this.cycles[0].filieres[0],
                    matiere: this.matieres[0],
                    titre: '',
                    question: null
                }),
                filieres: this.cycles[0].filieres,
                annees: this.cycles[0].annees,
            }
        },
        watch: {
            'form.cycle'(newValue){
                this.filieres= newValue.filieres
                this.form.filiere= this.filieres[0]
                this.annees= newValue.annees
                this.form.annee= this.annees[0]
            }
        },
        methods: {
            hide(){
                this.$emit('close')
            },
            submit(){
                this.form.post(route('forum.store'),{
                    preserveScroll: true
                })
            }
        }
    }
</script>

<style lang="scss" scoped>

</style>