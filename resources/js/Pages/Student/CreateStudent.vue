<template>
    <div class="flex justify-center">
    <div class="create-etudiant">
        <h1>Créer un compte étudiant</h1>
        <form @submit.prevent="submit" class="shadow-md rounded-lg p-4">
            <div class="form ">
                <div class="avatar-input">
                    <Avatar v-model:value="form.photo_url" :image="image"></Avatar>
                    <InputLabel for="">Photo de profil</InputLabel>
                </div>
                <div>
                    <div class="input">
                        <InputLabel for="sex">Sex</InputLabel>
                        <!-- <base-select :options="options" placeholder="select" v-model:value="form.sex" @change="changeImg"></base-select> -->
                        
                        <div class="w-72">
                            <Listbox v-model="form.sex">
                                <div class="relative mt-1">
                                    <ListboxButton
                                    class="relative w-full cursor-default rounded-lg bg-white py-2 pl-3 pr-10 text-left shadow-md focus:outline-none focus-visible:border-indigo-500 focus-visible:ring-2 focus-visible:ring-white focus-visible:ring-opacity-75 focus-visible:ring-offset-2 focus-visible:ring-offset-orange-300 sm:text-sm"
                                    >
                                        <span class="block truncate">{{ form.sex }}</span>
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
                                            v-for="(option, index) in options"
                                            :key="index"
                                            :value="option"
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
                                                    >{{ option }}</span
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
                    <div class="input mt-3">
                        <InputLabel for="date_naissance">Date de naissance</InputLabel>
                        <TextInput type="date" v-model="form.date_naissance" 
                            autofocus
                            required/>
                    </div>
                    <!-- <div class="input mt-3">
                        <InputLabel for="date_naissance">Année scolaire</InputLabel>
                        <TextInput type="text" v-model="form.annee" 
                            autofocus
                            required/>
                    </div> -->
                    <div class="mt-3">
                        <InputLabel for="tel" value="Numero de téléphone" />

                        <TextInput
                            id="tel"
                            type="tel"
                            class="mt-1 block w-full"
                            v-model="form.tel"
                            required
                            autocomplete="tel"
                        />

                        <InputError class="mt-2" :message="form.errors.tel" />
                    </div>
                    <div class="mt-3">
                        <InputLabel>Cycle</InputLabel>
                        <div class="w-72">
                            <Listbox v-model="form.cycle" @change="cycleEdited">
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
                </div>
            </div>
            
            <div class="flex justify-center mt-4">
                <SubmitButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing" type="submit">
                    Enregistrer
                </SubmitButton>
            </div>
            
        </form>
    </div>
</div>

</template>

<script>
import TextInput from '@/Components/TextInput.vue';
import SelectInput from '@/Components/SelectInput.vue';
import Avatar from '@/Components/Avatar.vue';
import BaseSelect from '@/Components/BaseSelect.vue';
import SubmitButton from '@/Components/SubmitButton.vue';
import InputLabel from '@/Components/InputLabel.vue';
import InputError from '@/Components/InputError.vue';
import MainLayout from '@/Layouts/MainLayout.vue';
import {
    Listbox,
    ListboxLabel,
    ListboxButton,
    ListboxOptions,
    ListboxOption,
  } from '@headlessui/vue'
  import { CheckIcon, ChevronUpDownIcon } from '@heroicons/vue/20/solid'
    export default {
    components: { TextInput, Avatar, BaseSelect, SubmitButton, InputLabel, InputError, MainLayout, SelectInput,
        Listbox,
        ListboxLabel,
        ListboxButton,
        ListboxOptions,
        ListboxOption,
        CheckIcon, 
        ChevronUpDownIcon
    },
    props: ['cycles'],
    data() {
        return {
            form: this.$inertia.form({
                date_naissance: '',
                annee: '',
                sex: 'Homme',
                tel: '',
                description: '',
                cycle: this.cycles[0],
                annee: this.cycles[0].annees[0],
                filiere: this.cycles[0].filieres[0],
                photo_url: '/images/boy.jpg',
            }),
            filieres: this.cycles[0].filieres,
            annees: this.cycles[0].annees,
            options: ['Homme','Femme'],
            image:'/images/boy.jpg'
        };
    },
    watch: {
        'form.cycle'(newValue){
            this.filieres= newValue.filieres
            this.form.filiere= this.filieres[0]
            this.annees= newValue.annees
            this.form.annee= this.annees[0]
        }
    },
    methods:{
        changeImg(){
            if (this.form.sex=="homme" && this.image != "/images/girl.jpg" && !this.image) {
                this.image="/images/boy.jpg"
               
            }
            else if(this.form.sex=="femme" && this.image != "/images/boy.jpg" && !this.image){
                this.image="/images/girl.jpg"
                
            }
            
        },
        cycleEdited(){
            console.log(this.form.cycle);
            this.filieres= this.form.cycle.filieres
        },
        submit() {
            this.form.post(route('student.store'),{
                preserveScroll: true,                   
            })
        },
    }
}
</script>

<style lang="css" scoped>
    .form{
        display: flex;
        justify-content: space-around;
        gap: 100px;
        /* padding: 20px; */
    }
    @media (max-width: 767px){
        .form{
            flex-direction:column;
            justify-items: center;
            gap:20px
        }
    }
    .avatar-input{
        display: flex;
        flex-direction: column;
        align-items: center;
        /* width: fit-content; */
    }
    h1{
        text-align: center;
        margin-top: 5px;
        margin-bottom: 30px;
    }
    .create-etudiant{
        background-color: white;
        border-radius: 20px;
        padding: 20px 50px;
        margin: 20px;
        width: fit-content;
    }
    textarea{
        border-radius: 10px;
        border-color: #d1d5db;
    }
</style>