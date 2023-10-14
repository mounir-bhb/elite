<template>
    <nav class="w-full" 
    :class="{'simple': (!isScrolling && !simple),
    'simple  ': (isScrolling || simple)}">
        <div class="container-nav ">
            <div class="logo ">
                <Link :href="route('acceuil')" class="flex items-center text-black px-2 font-bold text-xl relative">
                    <svg viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg" class="blob1">
                        <path fill="white" d="M69.3,-19.4C76.4,-0.6,59.5,29,35.2,46.2C10.9,63.3,-20.9,67.9,-43.5,53.1C-66.1,38.3,-79.4,4.1,-70.6,-17C-61.9,-38.1,-30.9,-46.1,0.1,-46.1C31.1,-46.2,62.2,-38.2,69.3,-19.4Z" transform="translate(100 100)" />
                    </svg>
                    <!-- <img src="" alt="logo" class="logo-img" v-if="(isScrolling && !simple) || simple">-->
                    <img src="/images/logo.png" alt="logo" class="logo-img"> 
                    ELITE CORNER
                </Link>
            </div>
            <div class="hidden links-nav lg:flex ">
                <Link :href="route('acceuil')" class="nav-link"
                >Acceuil</Link>
                <Link :href="route('formation.index')" class="nav-link">Formations</Link>
                <Link :href="route('quiz.index')" class="nav-link" v-if="!$page.props.canCreate">Exercices</Link>
                <Link :href="route('forum.index')" class=" nav-link">Forum</Link>
                <!-- <Link href="#" class="nav-link">A propos</Link>
                <Link href="#" class="nav-link">Help</Link> -->
                <Link :href="route('administration')" class="nav-link" v-if="$page.props.canAdministrate">Administration</Link>
                <Link :href="route('teacher.Formations')" class="nav-link" v-if="$page.props.canCreate">Mes Formations</Link>
                <Link :href="route('student.Formations')" class="nav-link" v-if="$page.props.canSurfe">Mes Formations</Link>
                <div class="ml-3 relative" v-if="$page.props.auth.user">
                        <Dropdown align="right" width="48">
                            <template #trigger>
                                <span class="inline-flex rounded-md">
                                    <button
                                        type="button"
                                        class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md  hover:text-white focus:outline-none transition ease-in-out duration-150"
                                    >
                                        <div v-if="!$page.props.auth.user.roleable_type || $page.props.auth.user.roleable_type=='App\\Models\\Admin'" class="text-white">{{ $page.props.auth.user.nom }} {{ $page.props.auth.user.prenom }}</div>

                                        <div v-else-if="$page.props.auth.user.roleable_type!='App\\Models\\Admin'">
                                        <!-- {{ $page.props.auth.user.nom }} {{ $page.props.auth.user.prenom }} -->
                                            <img :src="'/storage/'+$page.props.auth.user.roleable.photo_url" class="w-12 h-12 rounded-full object-cover" v-if="$page.props.auth.user.roleable.photo_url">
                                            <img src="/images/boy.jpg" class="w-12 rounded-full" v-else-if="$page.props.auth.user.roleable.sex=='Homme'">
                                            <img src="/images/girl.jpg" class="w-12 rounded-full" v-else-if="$page.props.auth.user.roleable.sex=='Femme'">
                                        </div>
                                        <svg
                                            class="ml-2 -mr-0.5 h-4 w-4"
                                            xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 20 20"
                                            fill="currentColor"
                                        >
                                            <path
                                                fill-rule="evenodd"
                                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                clip-rule="evenodd"
                                            />
                                        </svg>
                                    </button>
                                </span>
                            </template>

                            <template #content>
                                <DropdownLink :href="route('profile.edit')"> Profile </DropdownLink>
                                <DropdownLink :href="route('logout')" method="post" as="button">
                                    Log Out
                                </DropdownLink>
                            </template>
                        </Dropdown>
                    </div>
                <div v-else class="flex items-center gap-4 h-full ml-3 ">
                    <Link
                        v-if="$page.props.canLogin"
                        :href="route('login')"
                        class="flex items-center border p-2 hover:text-[#04049e] connexion transition duration-700 relative"
                        >Se connecter</Link>
                    <Link
                        v-if="$page.props.canRegister"
                        :href="route('register')"
                        class="flex items-center border p-2 hover:text-[#04049e] connexion transition duration-70 relative">Créer compte</Link>
                </div>
            </div>
            <!-- Hamburger -->
            <div class="-mr-2 flex items-center lg:hidden">
                            <button
                                @click="showingNavigationDropdown = !showingNavigationDropdown"
                                class="inline-flex items-center justify-center p-2 rounded-md text-white  transition duration-150 ease-in-out"
                            >
                                <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                    <path
                                        :class="{
                                            hidden: showingNavigationDropdown,
                                            'inline-flex': !showingNavigationDropdown,
                                        }"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M4 6h16M4 12h16M4 18h16"
                                    />
                                    <path
                                        :class="{
                                            hidden: !showingNavigationDropdown,
                                            'inline-flex': showingNavigationDropdown,
                                        }"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12"
                                    />
                                </svg>
                            </button>
                        </div>
        </div>
        <!-- responsive nav -->
        <div
            :class="{ block: showingNavigationDropdown, hidden: !showingNavigationDropdown }"
            class="lg:hidden resp-links-nav"
        >
            <div class="resp-links py-4">
                <Link href="" class="py-2 items-center gap-4 nav-link" v-if="$page.props.auth.user">
                    <div v-if="$page.props.auth.user.roleable_type">
                    <img :src="'/storage/'+$page.props.auth.user.roleable.photo_url" class="w-12 rounded-full" v-if="$page.props.auth.user.roleable.photo_url">
                    <img src="/images/boy.jpg" class="w-12 rounded-full" v-else-if="$page.props.auth.user.roleable.sex=='Homme'">
                    <img src="/images/girl.jpg" class="w-12 rounded-full" v-else-if="$page.props.auth.user.roleable.sex=='Femme'">
                    </div>                    
                    Profile
                </Link>
                <Link href="" class="nav-link">Acceuil</Link>
                <Link href="" class="nav-link" >Formations</Link>
                <Link href="" class=" nav-link">Enseignants</Link>
                <Link href="" class="nav-link">A propos</Link>
                <Link href="" class="nav-link" v-if="$page.props.canSeeMygroups">Mes groupes</Link>
                <Link href="" class="nav-link" v-if="$page.props.canAdministrate">Administration</Link>
                <div class="flex justify-center mt-4" v-if="$page.props.auth.user">
                    <Link :href="route('logout')" method="post" as="button" 
                    class="nav-link">
                        Déconnecter
                    </Link>
                </div>
                
                <div v-else class="">
                    <Link
                        v-if="$page.props.canLogin"
                        :href="route('login')"
                        class="nav-link"
                        :class="{'hover:text-[#fc4a1a]': (!isScrolling && !simple),
                        'hover:text-gray-800': (isScrolling || simple)}"
                        >Log in</Link>

                    <Link
                        v-if="$page.props.canRegister"
                        :href="route('register')"
                        class="nav-link"
                        :class="{'hover:text-[#fc4a1a]': (!isScrolling && !simple),
                        'hover:text-gray-800': (isScrolling || simple)}">Register</Link>
                </div>
            </div>
        </div>
    </nav>
</template>

<script>
    import { Link } from '@inertiajs/vue3'
    import Dropdown from './Dropdown.vue'
    import DropdownLink from './DropdownLink.vue'
    export default {
        components:{
            Link,
            Dropdown,
            DropdownLink
        },
        props: ['simple'],
        data() {
            return {
                isScrolling: false,
                showingNavigationDropdown:false
                /* shadow: '0px -2px 10px 1px #22c55e' */
            }
        },
        mounted() {
            window.addEventListener('scroll', this.handleScroll)
        },
        beforeDestroy() {
            window.removeEventListener('scroll', this.handleScroll)
        },
        methods: {
            test(){
                console.log(this.canLogin);
            },
            handleScroll() {
                if (window.scrollY > 0) {
                  this.isScrolling = true
                  
                } else {
                  this.isScrolling = false
                }
            }
        },
        
    }
</script>

<style lang="scss" scoped>
    
    nav{
        height: 60px;
        z-index: 1200;
        /* bottom: 0px; */
        position: fixed;
        top: 0;
        margin-bottom: 10px;
        font-weight: bold;
        
    }
    .logo{
        height: 60px;
        display: flex;
        justify-content: center;
        align-items: center;
        overflow: hidden;
    }
    .logo-img{
        height: 50px; 
    }
    .logo-div {
        height: 50px;
        display: flex;
        justify-content: center;
        align-items: center;
    }
    .container-nav{
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-left: 5%;
        margin-right: 5%;
    }
    .links-nav{
        
        height: 60px;
        /* display: flex; */
        justify-content: center;
        align-items: center;
    }
    .nav-link{
        position: relative;
        display: flex;
        align-items: center;
        justify-content: center;
        padding-left: 10px;
        padding-right: 10px;
        overflow: hidden;
        height: 100%;
        font-size: large;
        font-family: cursive;
        font-style: italic;
        transition-duration: 1s;
        transition-delay: 0.2s;
    }
    .nav-link:hover{
        color: rgb(4, 14, 158);
    }
    @media (max-width: 767px){
        .nav-link:hover{
            color: black;
        }
    }
    .nav-link::after, .connexion::after{
        
        position: absolute;
        content: "";
        width: 0;
        height: 0;
        top: 50%;
        left: 0;
        transform: translateY(-50%);
        border-radius: 2px;
        background-color: white;
        transition-duration: 1s;
        z-index: -1;
    }
    @media (max-width: 767px){
        .nav-link::after, .connexion::after{display: none;}
    }
    
    .nav-link:hover::after, .connexion:hover::after{
        width: 100%;
        height: 40px;
        
    }
    .simple{
        /* color: white; */
        background: rgb(4, 14, 158); /* fallback for old browsers */
        background: -webkit-linear-gradient(to left, rgb(4, 14, 158), rgb(0, 132, 255)); /* Chrome 10-25, Safari 5.1-6 */
        background: linear-gradient(to left, rgb(4, 14, 158), rgb(0, 132, 255));
        color: white;
       
        filter: drop-shadow(0 1px 3px #13121271) drop-shadow(0 2px 2px #13121271);
    }
    .resp-links-nav{
        background: rgb(4, 14, 158); /* fallback for old browsers */
        background: -webkit-linear-gradient(to left, rgb(4, 14, 158), rgb(0, 132, 255)); /* Chrome 10-25, Safari 5.1-6 */
        background: linear-gradient(to left, rgb(4, 14, 158), rgb(0, 132, 255));
        
        .resp-links{
            
            .nav-link{
                font-size: x-large;
            }
        }
    }
    .blob1{
      position: absolute;
      
      width: 247px;
      /* opacity: 0.9; */
      top: -150%;
      left: 1%;
      z-index: -1;
    }
    
</style>