<template>
    <MainLayout>
        <div>
            <form @submit.prevent="submit" class="mt-20 mb-5">
                <h2 class="text-center">Modifier la formation</h2>
                <div class="flex gap-20 justify-center ">
                    <div>
                        <div>
                            <InputLabel for=""></InputLabel>
                            <NewImg v-model:value="form.photo_url"></NewImg>
                        </div>
                    </div>
                    <div>
                        <div>
                            <InputLabel>Nom</InputLabel>
                            <TextInput v-model="form.nom" type="text"
                                class="mt-1 block border-none"></TextInput>
                        </div>
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
                        <div class="mt-3">
                            <InputLabel>Description</InputLabel>
                            <textarea v-model="form.description" cols="30"></textarea>
                        </div>
                    </div>
                    
                </div>
                
                <div class="flex flex-col items-center">
                    <div class="mt-3">
                        <!-- <TextEditor v-model="form.a_apprendre" language="fr"></TextEditor> -->
                        <label class="font-bold">A apprendre</label>
                        <Editor v-model="form.a_apprendre"></Editor>
                    </div>
                    <div class="mt-3">
                        <InputLabel>A propos</InputLabel>
                        <Editor v-model="form.a_propos"></Editor>
                    </div>
                    <div class="mt-3">
                        <InputLabel>Prérequis</InputLabel>
                        <Editor v-model="form.prerequis"></Editor>
                    </div>
                </div>

                <div class="mt-5">
                    <div class="flex justify-center gap-2">
                        <h2>Paiements</h2>
                        <div class="flex items-end font-bold text-xl cursor-pointer" @click="ajouterPaiment">+</div>
                    </div>
                    <div class="flex justify-center gap-2 flex-wrap mx-30">
                        <div v-for="(price, index) in form.old_prices" class="shadow-md w-fit p-4">
                            <div>
                                <InputLabel>Type d'abonnement</InputLabel>
                                <Listbox v-model="form.old_prices[index].type">
                                <div class="relative mt-1">
                                    <ListboxButton
                                        class="relative w-full cursor-default rounded-lg bg-white py-2 pl-3 pr-10 text-left shadow-md focus:outline-none focus-visible:border-indigo-500 focus-visible:ring-2 focus-visible:ring-white focus-visible:ring-opacity-75 focus-visible:ring-offset-2 focus-visible:ring-offset-orange-300 sm:text-sm"
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
                                
                                    <!-- <transition
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
                                    </transition> -->
                                </div>
                            </Listbox>
                            </div>
                            <div class="mt-3">
                                <InputLabel>Prix d'abonnement</InputLabel>
                                <TextInput type="number" disabled v-model="form.old_prices[index].price"></TextInput>
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
                        </div>
                        <div v-for="(price, index) in form.prices" class="shadow-md w-fit p-4 relative">
                            <div v-if="index > 0" @click="supprimerPaiment(index) " class="absolute top-4 right-4 text-lg cursor-pointer">X</div>
                            <div>
                                <InputLabel>Type d'abonnement</InputLabel>
                                <Listbox v-model="form.prices[index].type">
                                <div class="relative mt-1">
                                    <ListboxButton
                                        class="relative w-full cursor-default rounded-lg bg-white py-2 pl-3 pr-10 text-left shadow-md focus:outline-none focus-visible:border-indigo-500 focus-visible:ring-2 focus-visible:ring-white focus-visible:ring-opacity-75 focus-visible:ring-offset-2 focus-visible:ring-offset-orange-300 sm:text-sm"
                                    >
                                        <span class="block truncate" v-if="form.prices[index].type">{{ form.prices[index].type }}</span>
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
                                <TextInput type="number" v-model="form.prices[index].price"></TextInput>
                            </div>
                            <!-- <div class="flex justify-center my-4">
                                <div class="btn btn-del" @click="supprimerPaiment(index)"
                                v-if="form.prices.length>1">supprimer</div>
                            </div> -->
                        </div>
                    </div>
                    
                </div>

                <div class="flex justify-center mt-4">
                    <SubmitButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing" type="submit">
                        Modifier
                    </SubmitButton>
                </div>
            </form>
        </div>
    </MainLayout>
</template>

<script>
    import TextInput from '@/Components/TextInput.vue';
    import BaseSelect from '@/Components/BaseSelect.vue';
    import SubmitButton from '@/Components/SubmitButton.vue';
    import InputLabel from '@/Components/InputLabel.vue';
    import InputError from '@/Components/InputError.vue';
    import NewImg from '@/Components/NewImg.vue';
    import {
        Listbox,
        ListboxLabel,
        ListboxButton,
        ListboxOptions,
        ListboxOption,
    } from '@headlessui/vue'
    import { CheckIcon, ChevronUpDownIcon } from '@heroicons/vue/20/solid'
    import TextEditor from '@/Components/TextEditor.vue';
    import Editor from '@/Components/Editor.vue';
    import ClassicEditor from '@ckeditor/ckeditor5-build-classic';
    import CKEditor from '@ckeditor/ckeditor5-vue';
    import MainLayout from '@/Layouts/MainLayout.vue';
    export default {
        components: { TextInput, BaseSelect, SubmitButton, InputLabel, InputError, NewImg, Listbox, ListboxLabel, ListboxButton, ListboxOptions, ListboxOption, CheckIcon, ChevronUpDownIcon, CKEditor: CKEditor.component, TextEditor, Editor, MainLayout },
        props:['matieres', 'cycles', 'formation'],
        data(){
            return{
                form: this.$inertia.form({
                    _method:'put',
                    nom: this.formation.title,
                    cycle: this.formation.cycle,
                    annee: this.formation.annee,
                    filiere: this.formation.filiere,
                    matiere: this.formation.matiere, 
                    description: this.formation.description,
                    photo_url: '/storage/'+this.formation.photo_url,
                    a_apprendre: this.formation.a_apprendre,
                    prerequis: this.formation.prerequis,
                    a_propos: this.formation.a_propos,
                    old_prices: this.formation.prices,
                    prices: [{
                        type: null,
                        price: null
                    }],
                    
                }),
                types: ['1 mois','3 mois', '1 année', 'illimité'],
                active_options: [ 0, 1 ],
                filieres: this.cycles[0].filieres,
                annees: this.cycles[0].annees,
                editor: ClassicEditor,
                editorConfig: {},
                image: ''
            }
        },
        /* mounted() {
    this.editor.create()
      .then(editorInstance => {
        console.log('Editor instance created:', editorInstance);
      })
      .catch(error => {
        console.error('Failed to create editor instance:', error);
      });
  }, */
        watch: {
            'form.cycle'(newValue){
                this.filieres= newValue.filieres
                this.form.filiere= this.filieres[0]
                this.annees= newValue.annees
                this.form.annee= this.annees[0]
            }
        },
        methods: {
            ajouterPaiment(){
                this.form.prices.push({
                    type: null,
                    price: ''
                })
            },
            supprimerPaiment(index){
                if(this.form.prices.length>1)
                    this.form.prices.splice(index,1)    
            },
            submit() {
                this.form.post(route('formation.update', this.formation.id),{
                    preserveScroll: true
                })
            }
        }
    }
</script>

<style lang="scss" scoped>

</style>