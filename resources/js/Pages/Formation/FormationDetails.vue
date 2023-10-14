<template>
    <MainLayout>
        <div>
            <div class="">
                <div class="" :class="canInscrire? 'w-3/4': 'flex flex-col items-center'">
                    <div class="w-full" :class="!canInscrire?'flex justify-center' : ''">
                        <div class="card-details p-4 mt-20 mx-20 flex justify-around gap-2 shadow-lg rounded-lg" :class="!canInscrire? 'w-3/4': ''">
                            <div class="flex flex-col items-center justify-center"
                                data-aos="fade-up"
                                data-aos-offset="0"
                                data-aos-delay="500"
                                data-aos-duration="700"
                                data-aos-easing="ease-in-out"
                                data-aos-mirror="false"
                                data-aos-once="false"
                            >
                                <h1 class="mt-2 ">{{ formation.title }}</h1 >
                                <div class="w-3/4 mb-4"><div class="border border-white"></div></div>
                                <p class='description text-xl'>{{ formation.description }}</p>
                                <div class="text-lg underline">
                                    Matière: {{ formation.matiere.nom }}
                                </div>
                                                        
                                
                                <div class="flex gap-2 text-lg mt-2">
                                    <div class="text-lg underline">{{ formation.annee.nom }} année</div>
                                    <div class="text-lg underline">{{ formation.cycle.nom }}</div>
                                    <div class="text-lg underline">{{ formation.filiere.nom }}</div>
                                </div>
                                <div v-if="formation.teacher" class="mt-2 flex gap-2 items-center">
                                    <img :src="'/storage/'+formation.teacher.photo_url" alt="" v-if="formation.teacher.photo_url" class="w-8 h-8 rounded-full">
                                    <img src="/images/boy.jpg" class="w-10 rounded-full" v-else-if="formation.teacher.sex=='Homme'">
                                    <img src="/images/girl.jpg" class="w-10 rounded-full" v-else-if="formation.teacher.sex=='Femme'">
                                    <div class="text-xl">
                                        {{ formation.teacher.user.nom }} {{ formation.teacher.user.prenom }}
                                    </div>
                                    
                                </div>
                                <div class="mt-3">
                                    <div class="flex gap-2" v-if="note">
                                        <div >{{ note.toFixed(1)  }}</div>
                                        <div class="flex">
                                            <div v-for="i in stars">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke-width="1.5" stroke="#eab308" class="w-6 h-6 transition duration-700" v-if="i - note >0 && i - note < 1">
                                                    <defs>
                                                        <linearGradient id="grad">
                                                            <stop offset="0%" stop-color="#eab308"/>
                                                            <stop :offset="(note - (i-1)) * 100 +'%'" stop-color="#eab308"/>
                                                            <stop :offset="(note - (i-1)) * 100 +'%'" stop-color="transparent"/>
                                                            <stop offset="100%" stop-color="transparent"/>
                                                        </linearGradient>
                                                    </defs>
                                                    <path fill="url(#grad)" stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.563.563 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.563.563 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z" />
                                                </svg>
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke-width="1.5" stroke="#eab308" class="w-6 h-6 fill-none transition duration-700" :class="i<= note ? 'fill-yellow-500 stroke-none': '' " v-else>
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.563.563 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.563.563 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z" />
                                                </svg>
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                            <img :src="'/storage/'+formation.photo_url" alt="" class="w-96 rounded-lg"
                                data-aos="fade-left"
                                data-aos-offset="0"
                                data-aos-delay="500"
                                data-aos-duration="700"
                                data-aos-easing="ease-in-out"
                                data-aos-mirror="false"
                                data-aos-once="false"
                            >
                        </div>
                    </div>

                    <div class="flex justify-center" v-if="canUpdate">
                        <Link :href="route('formation.edit', formation.id)" class="p-2 bg-blue-600 text-white rounded-lg mt-4">
                            Modifier
                        </Link>
                    </div>
                    <div class="flex justify-center" v-if="$page.props.canAdministrate && enabled">
                        <div class="p-2 bg-blue-600 text-white rounded-lg mt-4 cursor-pointer" @click="disable">
                            Désactiver
                        </div>
                    </div>
                    <div class="flex justify-center" v-if="$page.props.canAdministrate && !enabled">
                        <div class="p-2 bg-blue-600 text-white rounded-lg mt-4 cursor-pointer" @click="enable">
                            Activer
                        </div>
                    </div>
                    
                    <div class="section-formation shadow-md w-3/5"
                        data-aos="fade-right"
                        data-aos-offset="0"
                        data-aos-delay="500"
                        data-aos-duration="700"
                        data-aos-easing="ease-in-out"
                        data-aos-mirror="false"
                        data-aos-once="false"
                        v-if="formation.chapitres.length || canUpdate"
                    >
                        <h3>
                            <Link :href="route('formation.show', formation.id)" >Contenu de la formation</Link>
                        </h3>
                        <div v-for="(chapitre, index) in formation.chapitres" :key="index" class="ml-2">
                            <ChapitreShow :chapitre="chapitre"></ChapitreShow>
                            <!-- <div>{{ chapitre.titre }}</div>
                            <div v-for="(cour, index) in chapitre.cours" class="ml-4">{{ cour.titre }}</div> -->
                        </div>
                    </div>
                    <div class="section-formation shadow-md " v-if="formation.a_apprendre">
                        <h2 class="mb-4"
                            data-aos="flip-down"
                            data-aos-offset="0"
                            data-aos-delay="500"
                            data-aos-duration="700"
                            data-aos-easing="ease-in-out"
                            data-aos-mirror="false"
                            data-aos-once="false"
                        >Ce que vous apprendrez</h2>
                        <div v-html="formation.a_apprendre"
                            data-aos="fade-up"
                            data-aos-offset="0"
                            data-aos-delay="500"
                            data-aos-duration="700"
                            data-aos-easing="ease-in-out"
                            data-aos-mirror="false"
                            data-aos-once="false"
                        ></div>
                    </div>
                    <div class="section-formation shadow-md w-1/3" v-if="formation.prerequis">
                        <h2 class="mb-4"
                            data-aos="flip-down"
                            data-aos-offset="0"
                            data-aos-delay="500"
                            data-aos-duration="700"
                            data-aos-easing="ease-in-out"
                            data-aos-mirror="false"
                            data-aos-once="false"
                        >Prerequis</h2>
                        <div v-html="formation.prerequis"
                            data-aos="fade-up"
                            data-aos-offset="0"
                            data-aos-delay="500"
                            data-aos-duration="700"
                            data-aos-easing="ease-in-out"
                            data-aos-mirror="false"
                            data-aos-once="false"
                        ></div>
                    </div>
                    <div class="section-formation shadow-md" v-if="formation.a_propos">
                        <h2  class="mb-4"
                            data-aos="flip-down"
                            data-aos-offset="0"
                            data-aos-delay="500"
                            data-aos-duration="700"
                            data-aos-easing="ease-in-out"
                            data-aos-mirror="false"
                            data-aos-once="false"
                        >A propos de la formation</h2>
                        <div v-html="formation.a_propos" class="ml-4"
                            data-aos="fade-up"
                            data-aos-offset="0"
                            data-aos-delay="500"
                            data-aos-duration="700"
                            data-aos-easing="ease-in-out"
                            data-aos-mirror="false"
                            data-aos-once="false"
                        ></div>
                    </div>

                    <div v-if="stars1.length>0 || stars2.length>0 || stars3.length>0 || stars4.length>0 || stars5.length>0">
                        <h2>Avis sur la formation</h2>
                        <Ratings :stars1="stars1" :stars2="stars2" :stars3="stars3" :stars4="stars4" :stars5="stars5"></Ratings>
                    </div>
                </div>
                <form @submit.prevent="submit" v-if="canInscrire"
                >
                    <div class="inscription rounded-lg shadow-md">
                        <div
                            data-aos="fade-left"
                            data-aos-offset="0"
                            data-aos-delay="500"
                            data-aos-duration="700"
                            data-aos-easing="ease-in-out"
                            data-aos-mirror="false"
                            data-aos-once="false"
                        >
                            <div class="text-2xl text-center font-bold pb-2 border-b">
                                Abonnement
                            </div>
                            <div class="w-full px-4 pt-6">
                                <div class="mx-auto w-full max-w-md">
                                    <RadioGroup v-model="form.price">
                                        
                                        <div class="space-y-2 space-x-2 flex justify-around flex-wrap">
                                            <RadioGroupOption
                                                as="template"
                                                v-for="price in formation.prices"
                                                
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
                        
                        
                        
                        
                    </div>
                </form>
                
            </div>
            <Footer></Footer>
            <Modal>

            </Modal>
            
            
            
        </div>
    </MainLayout>
    
</template>

<script>
    import SubmitButton from '@/Components/SubmitButton.vue';
    import MainLayout from '@/Layouts/MainLayout.vue';
    import ChapitreShow from '../Chapitre/ChapitreShow.vue';
    import Ratings from '../Rating/Ratings.vue';
    import NewCcp from '@/Components/NewCcp.vue';
    import { Link } from '@inertiajs/vue3';
    import {
        RadioGroup,
        RadioGroupLabel,
        RadioGroupDescription,
        RadioGroupOption,
    } from '@headlessui/vue'
import Modal from '@/Components/Modal.vue';
import Footer from '@/Components/Footer.vue';
    export default {
        components: {
    SubmitButton,
    MainLayout,
    ChapitreShow,
    Ratings,
    Link,
    RadioGroup,
    RadioGroupLabel,
    RadioGroupDescription,
    RadioGroupOption,
    Modal,
    NewCcp,
    Footer
},
        props: ['formation', 'canUpdate', 'canInscrire', 'stars5', 'stars4', 'stars3', 'stars2', 'stars1'],
        data(){
            return {
                stars: [1, 2, 3, 4, 5],
                form: this.$inertia.form({
                    image_ccp: null,
                    formation_id: this.formation.id,
                    price: null
                }),
                note: null,
                enabled: this.formation.is_valide
            }
        },
        created(){
            this.len_stars= this.stars1.length + this.stars2.length + this.stars3.length + this.stars4.length + this.stars5.length
            this.note= (this.stars1.length + this.stars2.length * 2 + this.stars3.length * 3 + this.stars4.length * 4 + this.stars5.length * 5) / this.len_stars
        },
        computed: {
            can_submit(){
                return this.form.image_ccp && this.form.price;
            }
        },
        methods: {
            async enable(){
                try{
                    this.enabled= true
                    //this.montant= montant
                    const response= await axios.put('/enable-formation', {formation_id: this.form.formation_id})
                    
                } catch (error) {
                    console.log(error);
                }
            },
            async disable(){
                try{
                    //this.montant= montant
                    this.enabled= false
                    const response= await axios.put('/disable-formation', {formation_id: this.form.formation_id})
                    //console.log(response);
                    
                } catch (error) {
                    console.log(error);
                }
            },
            submit() {
                this.form.post(route('inscription'),{
                    preserveScroll: true
                })
            }
        }
    }
</script>

<style lang="scss" >
    /* ul{
        margin-left: 10px;
    } */
    .card-details{
        background: rgb(4, 14, 158); /* fallback for old browsers */
        background: -webkit-linear-gradient(to left, rgb(4, 14, 158), rgb(0, 132, 255)); /* Chrome 10-25, Safari 5.1-6 */
        background: linear-gradient(to left, rgb(4, 14, 158), rgb(0, 132, 255));
        color: white;
    }
    li{
        margin-left: 10px;
    }
    .section-formation{
        margin: 30px 100px;
        padding: 20px 20px;
    }
    .inscription{
        position: fixed;
        top: 100px;
        right: 50px;
        padding: 20px;
        width: 350px;
    }
</style>