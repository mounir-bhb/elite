<template>
    <div>
        <div class="flex gap-1 items-center cursor-pointer py-2 hover:bg-[#eee]" @click="open=!open">
            <span >
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-5 transform duration-700" :class=" open ? 'rotate-90 ': ''">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                </svg>

            </span>
            <!-- <span>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                </svg>
            </span> --> 
            <div class="text-xl">
                {{ chapitre.titre }}
            </div>
        </div>
        <div v-if="open"
            data-aos="fade-right"
            data-aos-offset="0"
            data-aos-delay="50"
            data-aos-duration="700"
            data-aos-easing="ease-in-out"
            data-aos-mirror="false"
            data-aos-once="false"
        >
            <div v-for="(cour, cindex) in chapitre.cours" class="" >
                <div  class="flex items-center gap-2 pl-10 text-lg  hover:bg-[#eee]">
                    <div class="" v-if="canUpdate">
                        <Menu as="div" class="relative inline-block text-left cursor-pointer">
                        <div>
                            <MenuButton
                                class="inline-flex w-full justify-center  bg-opacity-20  py-2 text-sm font-medium  hover:bg-opacity-30 focus:outline-none focus-visible:ring-2 focus-visible:ring-white focus-visible:ring-opacity-75"
                            >
                            <div >
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-5" viewBox="0 0 128 512" ><!--! Font Awesome Pro 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M64 360a56 56 0 1 0 0 112 56 56 0 1 0 0-112zm0-160a56 56 0 1 0 0 112 56 56 0 1 0 0-112zM120 96A56 56 0 1 0 8 96a56 56 0 1 0 112 0z"/></svg>
                            </div>
                            <!-- <ChevronDownIcon
                                class="ml-2 -mr-1 h-5 w-5 text-violet-200 hover:text-violet-100"
                                aria-hidden="true"
                            /> -->
                            </MenuButton>
                        </div>

                        <transition
                            enter-active-class="transition duration-100 ease-out"
                            enter-from-class="transform scale-95 opacity-0"
                            enter-to-class="transform scale-100 opacity-100"
                            leave-active-class="transition duration-75 ease-in"
                            leave-from-class="transform scale-100 opacity-100"
                            leave-to-class="transform scale-95 opacity-0"
                        >
                            <MenuItems
                            class="absolute top-0 left-10 mt-2 w-56  divide-y divide-gray-100 rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
                            >
                            <div class="px-1 py-1">
                                <MenuItem v-slot="{ active }">
                                <button
                                    :class="[
                                    active ? 'bg-violet-500 text-white' : 'text-gray-900',
                                    'group flex w-full items-center rounded-md px-2 py-2 text-sm',
                                    ]"
                                    @click="openCour(cour)"
                                >
                                    <!-- <EditIcon
                                    :active="active"
                                    class="mr-2 h-5 w-5 text-violet-400"
                                    aria-hidden="true"
                                    /> -->
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mr-2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                    </svg>

                                    Edit
                                </button>
                                </MenuItem>
                                
                            </div>
                            
                            

                            <!-- <div class="px-1 py-1">
                                <MenuItem v-slot="{ active }">
                                <button
                                    :class="[
                                    active ? 'bg-violet-500 text-white' : 'text-gray-900',
                                    'group flex w-full items-center rounded-md px-2 py-2 text-sm',
                                    ]"
                                >
                                    
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mr-2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                    </svg>

                                    Delete
                                </button>
                                </MenuItem>
                            </div> -->
                            </MenuItems>
                        </transition>
                        </Menu>
                    </div>
                    <div v-else-if="!canInteract && !cour.gratuit">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 fill-blue-600" viewBox="0 0 24 24"><path d="M19 10H20C20.5523 10 21 10.4477 21 11V21C21 21.5523 20.5523 22 20 22H4C3.44772 22 3 21.5523 3 21V11C3 10.4477 3.44772 10 4 10H5V9C5 5.13401 8.13401 2 12 2C15.866 2 19 5.13401 19 9V10ZM17 10V9C17 6.23858 14.7614 4 12 4C9.23858 4 7 6.23858 7 9V10H17ZM11 14V18H13V14H11Z"></path></svg>
                    </div>
                    <div @click="selectCour(cour)" :class="(canUpdate || canInteract || cour.gratuit) ? 'cursor-pointer': ''">{{ cour.titre }}</div>
                </div>
                <div v-for="(ressource, rindex) in cour.ressources" v-if="canUpdate || canInteract || cour.gratuit" class="flex items-center gap-2 ml-10 pl-4  hover:bg-[#eee]">
                    <!-- ressource {{ rindex+1 }} -->
                    <div class="cursor-pointer text-red-600" v-if="canUpdate" @click="deleteRessource(ressource.id)">X</div>
                    <div class="text-lg" :class="(canUpdate || canInteract || cour.gratuit) ? 'cursor-pointer': ''" @click="selectPdf(ressource)">{{ ressource.nom }}</div>
                </div>
                <div class="pl-14 text-lg cursor-pointer hover:bg-[#eee]" @click="addRessource(cour.id)" v-if="canUpdate">
                    Ajouter une ressource
                </div>
            </div>
            <div class="pl-10 text-lg cursor-pointer hover:bg-[#eee]" @click="open_cour=true" v-if="canUpdate">
                Ajouter un cour
            </div>
        </div>
        <Modal :show="open_edit_cour && canUpdate" @close="open_edit_cour=false">
            <EditCour :cour="cour_to_edit" @close="open_edit_cour=false"></EditCour>
        </Modal>
        <Modal :show="open_cour && canUpdate" @close="open_cour=false">
            <CreateCour @close="open_cour=false" :chapitre="chapitre.id"></CreateCour>
        </Modal>
        <Modal :show="open_ressource && canUpdate" @close="open_ressource=false">
            <CreateRessource @close="open_ressource=false" :cour_id="cour_id"></CreateRessource>
        </Modal>
    </div>
</template>

<script>
    import Modal from '@/Components/Modal.vue';
    import axios from 'axios';
    import CreateCour from '../Cour/CreateCour.vue';
    import CreateRessource from '../Cour/CreateRessource.vue';
    import { Link } from '@inertiajs/vue3';
    import EditCour from '../Cour/EditCour.vue';
    import { Menu, MenuButton, MenuItems, MenuItem } from '@headlessui/vue'

    export default {
    props: ['chapitre', 'formation_id', 'canUpdate','canInteract'],
    emits: ['selectedCour', 'selectedPdf', 'type'],
    data() {
        return {
            open: false,
            open_cour: false,
            open_ressource: false,
            open_edit_cour: false,
            cour_to_edit: null,
            cour_id: null,
            display: 'none',
            form: {
                ressource_id: null
            }
            /* form: this.$inertia.form({
                ressource_id: null
            }) */
        };
    },
    beforeUnmount() {
            document.removeEventListener('click', this.handleClickOutside);
        },
    methods: {
        handleClickOutside(event) {
            
                if (this.$refs.update.includes(event.target)) {
                    this.noneDisplay();
                }
            },
            displayHandle(){
                this.display='block'
                document.addEventListener('click', this.handleClickOutside);
                
            },
            noneDisplay(){
                this.display='none'
                document.removeEventListener('click', this.handleClickOutside);
            },
        selectCour(cour) {
            if(this.canUpdate || this.canInteract || cour.gratuit){
                this.$emit('selectedCour', cour);
                this.$emit('type', 'cour');
            }
            
        },
        selectPdf(ressource) {
            this.ressourceSoumission(ressource);
            this.$emit('selectedPdf', ressource);
            this.$emit('type', 'pdf');
        },
        async ressourceSoumission(ressource) {
            if(this.canInteract){
                this.form.ressource_id = ressource.id;
                
                try {
                    const response = await axios.post(route('ressource.soumission'), this.form);
                    /* console.log(response); */
                }
                catch (error) {
                    console.log(error);
                }
            }
            
        },
        addRessource(id){
            this.cour_id=id
            this.open_ressource=true
        },
        openCour(cour){
            this.cour_to_edit= cour
            this.open_edit_cour= true
            
        },
        deleteRessource(ressource_id){
            this.$inertia.delete(route('ressource.destroy', ressource_id), {
                preserveScroll:true
            })
        }
    },
    components: { Modal, CreateCour, CreateRessource, Link, EditCour, Menu, MenuButton, MenuItems, MenuItem }
}
</script>

<style lang="scss" scoped>
    /* svg{
        height: 25px;
    } */
    .update{
        position: relative;
        /* position: absolute;
        display: flex;
        gap: 5px;
        top: 15px;
        left: 15px; */
        svg{
            cursor: pointer;
        }
    }
    .options {
        position: absolute;
        top:0;
        left: 10px;
        color: white;
        border-radius: 10px;
        overflow: hidden;
        text-align: center;
    }
    .option{
        
        background-color: rgb(73, 124, 235);
        padding: 5px;
        cursor: pointer;
        transition-duration: 0.7s;
    }
    .option:hover{
        background-color: beige;
        color: black;
    }
</style>