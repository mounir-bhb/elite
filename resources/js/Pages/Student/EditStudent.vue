<template>
    <div>
        <form @submit.prevent="submit" class="shadow-md py-8">
            <div class="form">
                <div>
                    <div class="avatar-input">
                        <Avatar v-model:value="form.photo_url" :image="image"></Avatar>
                        <InputLabel for="">Photo de profil</InputLabel>
                    </div>
                </div>
                <div>
                    <div class="mt-3">
                        <InputLabel>Cycle</InputLabel>
                        <div class="w-72">
                            <Listbox v-model="form.cycle">
                                <div class="relative mt-1">
                                    <ListboxButton
                                        class="relative w-full cursor-default rounded-lg bg-white py-2 pl-3 pr-10 text-left shadow-md focus:outline-none focus-visible:border-indigo-500 focus-visible:ring-2 focus-visible:ring-white focus-visible:ring-opacity-75 focus-visible:ring-offset-2 focus-visible:ring-offset-orange-300 sm:text-sm"
                                    >
                                        <span class="block truncate">{{ cycles.filter((el)=>el.id==form.cycle)[0].nom }}</span>
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
                                            :value="cycle.id"
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
                    </div>
                    <div v-if="filieres.length > 0" class="mt-3">
                        <InputLabel>Filière</InputLabel>
                        <div class="w-72">
                            <Listbox v-model="form.filiere">
                                <div class="relative mt-1">
                                    <ListboxButton
                                    class="relative w-full cursor-default rounded-lg bg-white py-2 pl-3 pr-10 text-left shadow-md focus:outline-none focus-visible:border-indigo-500 focus-visible:ring-2 focus-visible:ring-white focus-visible:ring-opacity-75 focus-visible:ring-offset-2 focus-visible:ring-offset-orange-300 sm:text-sm"
                                    >
                                        <span class="block truncate">{{ filieres.filter((el)=>el.id==form.filiere)[0].nom }}</span>
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
                    </div>
                    <div v-if="annees.length > 0" class="mt-3">
                        <InputLabel>Année scolaire</InputLabel>
                        <div class="w-72">
                            <Listbox v-model="form.annee">
                                <div class="relative mt-1">
                                    <ListboxButton
                                    class="relative w-full cursor-default rounded-lg bg-white py-2 pl-3 pr-10 text-left shadow-md focus:outline-none focus-visible:border-indigo-500 focus-visible:ring-2 focus-visible:ring-white focus-visible:ring-opacity-75 focus-visible:ring-offset-2 focus-visible:ring-offset-orange-300 sm:text-sm"
                                    >
                                        <span class="block truncate" >{{ annees.filter((el)=>el.id==form.annee)[0].nom }}</span>
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
                    </div>
                </div>
                <div>
                    <div class="input">
                        <InputLabel for="date_naissance">Date de naissance</InputLabel>
                        <TextInput type="date" v-model="form.date_naissance"/>
                    </div>
                    <div class="input">
                        <InputLabel for="sex">Sex</InputLabel>
                        <base-select :options="options" placeholder="select" v-model:value="form.sex" @change="changeImg"></base-select>
                    </div>
                    <div>
                        <InputLabel for="tlf" value="Numero de téléphone" />

                        <TextInput
                            id="tel"
                            type="tel"
                            class="mt-1 block w-full"
                            v-model="form.tel"
                            required
                            autofocus
                            autocomplete="tel"
                        />

                        <InputError class="mt-2" :message="form.errors.tlf" />
                    </div>
                </div>
            </div>
            <div class="flex justify-center mt-3">
                <SubmitButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing" type="submit">
                    Modifier
                </SubmitButton>
            </div>
            
        </form>
    </div>
</template>

<script>
import TextInput from '@/Components/TextInput.vue';
import Avatar from '@/Components/Avatar.vue';
import BaseSelect from '@/Components/BaseSelect.vue';
import SubmitButton from '@/Components/SubmitButton.vue';
import InputLabel from '@/Components/InputLabel.vue';
import InputError from '@/Components/InputError.vue';
import {
    Listbox,
    ListboxLabel,
    ListboxButton,
    ListboxOptions,
    ListboxOption,
  } from '@headlessui/vue'
  import { CheckIcon, ChevronUpDownIcon } from '@heroicons/vue/20/solid'
    export default {
    components: { TextInput, Avatar, BaseSelect, SubmitButton, InputLabel, InputError, Listbox,
    ListboxLabel,
    ListboxButton,
    ListboxOptions,
    ListboxOption, CheckIcon, ChevronUpDownIcon },
    props:['student', 'cycles'],
    data() {
        return {
            form: this.$inertia.form({
                _method:'put',
                date_naissance: this.student.date_naissance,
                sex: this.student.sex,
                tel: this.student.tel,
                photo_url: null,
                cycle: this.student.cycle_id,
                annee: this.student.annee_id,
                filiere: this.student.filiere_id,
            }),
            filieres: this.cycles[0].filieres,
            annees: this.cycles[0].annees,
            options: ['Homme','Femme'],
            image: '/storage/'+this.student.photo_url
        };
    },
    mounted(){
        
        if (this.form.sex=="Homme" && this.image != "/images/girl.jpg" && !this.student.photo_url) {
            this.image="/images/boy.jpg"
               
            }
        else if(this.form.sex=="Femme" && this.image != "/images/boy.jpg" && !this.student.photo_url){
            this.image="/images/girl.jpg"
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
    methods:{
        changeImg(){
            if (this.form.sex=="Homme" && this.image != "/images/girl.jpg" && !this.student.photo_url) {
                this.image="/images/boy.jpg"
               
            }
            else if(this.form.sex=="Femme" && this.image != "/images/boy.jpg" && !this.student.photo_url){
                this.image="/images/girl.jpg"
                
            }
        },
        submit() {
            this.form.post(route('student.update', this.student.id),{
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
    }
    .avatar-input{
        display: flex;
        flex-direction: column;
        align-items: center;
        width: fit-content;
    }
</style>