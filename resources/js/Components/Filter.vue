<template>
    <div >
        <div class="flex justify-around flex-wrap">
            <div class="mt-3">
                <InputLabel>Cycle</InputLabel>
                <div class="w-72">

                    <Listbox v-model="cycle">
                        <div class="relative mt-1">
                            <ListboxButton
                                class="relative w-full cursor-default rounded-lg bg-white py-2 pl-3 pr-10 text-left shadow-md focus:outline-none focus-visible:border-indigo-500 focus-visible:ring-2 focus-visible:ring-white focus-visible:ring-opacity-75 focus-visible:ring-offset-2 focus-visible:ring-offset-orange-300 sm:text-sm"
                            >
                                <span class="block truncate">{{ cycle.nom }}</span>
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
                                    v-for="c in cycles"
                                    :key="c.id"
                                    :value="c"
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
                                            >{{ c.nom }}</span
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
            <div v-if="cycle.filieres.length > 0" class="mt-3">
                <InputLabel>Filière</InputLabel>
                <div class="w-72">
                    <Listbox v-model="filiere">
                        <div class="relative mt-1">
                            <ListboxButton
                            class="relative w-full cursor-default rounded-lg bg-white py-2 pl-3 pr-10 text-left shadow-md focus:outline-none focus-visible:border-indigo-500 focus-visible:ring-2 focus-visible:ring-white focus-visible:ring-opacity-75 focus-visible:ring-offset-2 focus-visible:ring-offset-orange-300 sm:text-sm"
                            >
                                <span class="block truncate">{{ filiere.nom }}</span>
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
                                    v-for="f in cycle.filieres"
                                    :key="f.id"
                                    :value="f"
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
                                            >{{ f.nom }}</span
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
            <div v-if="cycle.annees.length > 0" class="mt-3">
                <InputLabel>Année scolaire</InputLabel>
                <div class="w-72">
                    <Listbox v-model="annee">
                        <div class="relative mt-1">
                            <ListboxButton
                            class="relative w-full cursor-default rounded-lg bg-white py-2 pl-3 pr-10 text-left shadow-md focus:outline-none focus-visible:border-indigo-500 focus-visible:ring-2 focus-visible:ring-white focus-visible:ring-opacity-75 focus-visible:ring-offset-2 focus-visible:ring-offset-orange-300 sm:text-sm"
                            >
                                <span class="block truncate">{{annee.nom }}</span>
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
                                    v-for="a in cycle.annees"
                                    :key="a.id"
                                    :value="a"
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
                                            >{{ a.nom }}</span
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
            <div v-if="matieres.length > 0" class="mt-3">
                <InputLabel>Matiere</InputLabel>
                <div class="w-72">
                    <Listbox v-model="matiere">
                        <div class="relative mt-1">
                            <ListboxButton
                            class="relative w-full cursor-default rounded-lg bg-white py-2 pl-3 pr-10 text-left shadow-md focus:outline-none focus-visible:border-indigo-500 focus-visible:ring-2 focus-visible:ring-white focus-visible:ring-opacity-75 focus-visible:ring-offset-2 focus-visible:ring-offset-orange-300 sm:text-sm"
                            >
                                <span class="block truncate" v-if="matiere">{{ matiere.nom }}</span>
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
                                    :value="{nom: 'Tout'}"
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
                                            >Tout</span
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
                                    v-for="m in matieres"
                                    :key="m.id"
                                    :value="m"
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
                                            >{{ m.nom }}</span
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
    </div>
</template>

<script>
    import {
        Listbox,
        ListboxLabel,
        ListboxButton,
        ListboxOptions,
        ListboxOption,
    } from '@headlessui/vue'
    import { CheckIcon, ChevronUpDownIcon } from '@heroicons/vue/20/solid'
    import InputLabel from './InputLabel.vue';
    export default {
        components: { Listbox, ListboxLabel, ListboxButton, ListboxOptions, ListboxOption, CheckIcon, ChevronUpDownIcon, InputLabel },
        props:['cycles', 'matieres', 'items'],
        emits: ['items'],
        data(){
            return {
                cycle: this.cycles[0],
                annee: this.cycles[0].annees[0],
                filiere: this.cycles[0].filieres[0],
                matiere: {
                    nom: 'Tout'
                },
                selectedItems: this.items
            }
        },
        mounted(){
            this.filter()
        },
        watch: {
            cycle(newValue){
                //this.filieres= newValue.filieres
                this.filiere= newValue.filieres[0]
                //this.annees= newValue.annees
                this.annee= newValue.annees[0]
                this.filter()
            },
            annee(newValue){
                this.filter()
            },
            filiere (newValue){
                this.filter()
            },
            matiere(newValue){
                console.log(this.matiere.nom)
                this.filter()
            }
        },
        methods:{

            filter(){
                var self = this;
                if(this.matiere.nom!= 'Tout'){
                    this.selectedItems= this.items.filter(function(e){
                        return e.cycle_id == self.cycle.id && 
                        e.filiere_id== self.filiere.id && 
                        e.annee_id==self.annee.id && 
                        e.matiere_id == self.matiere.id
                    })
                }
                else {
                    this.selectedItems= this.items.filter(function(e){
                        return e.cycle_id == self.cycle.id && 
                        e.filiere_id== self.filiere.id && 
                        e.annee_id==self.annee.id
                        
                    })
                }
                this.$emit('items', this.selectedItems)
            }
        }
    }
</script>

<style lang="scss" scoped>

</style>