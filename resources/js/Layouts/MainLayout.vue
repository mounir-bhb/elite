<template>
    <div>
        <div>
            <NavBar :simple="simple"></NavBar>

            <!-- <HeaderSlide v-if="$slots.header"></HeaderSlide> -->
            <ToTop v-if="$slots.top"></ToTop>
            <div class="content">
                <slot/>
            </div>
        </div>
    </div>
</template>

<script>

    import NavBar from '@/Components/NavBar.vue';
    import ToTop from '@/Components/ToTop.vue';
    import AOS from 'aos';
    import 'aos/dist/aos.css';
    export default {
        components: { NavBar, ToTop },
        props: ['simple'],
        created(){
            AOS.init()
        },
    }
</script>

<style lang="scss">
    *{
        box-sizing: border-box;
        font-family: 'Roboto', sans-serif;
        font-size: medium;
        
        
    }
    html{
        scroll-behavior: smooth;
    }
    body{
        color: rgb(20, 20, 20);
        background: white;
        /* background: #fc4a1a;
        background: -webkit-linear-gradient(to left, #fc4a1a, #f7b733);
        background: linear-gradient(to left, #fc4a1a, #f7b733); */
    }
    h1{
        font-size: xx-large;
        font-weight: bold;
    }
    h2{
        font-size: x-large;
        font-weight: bold;
    }
    h3{
        font-size: larger;
        font-weight: bold;
    }
    h4{
        font-size: large;
        font-weight: bold;
    }

    .contain{
        margin-left: 50px;
        margin-right: 50px;
    }
    @media (max-width: 648px) {
        .contain{
            margin-left: 10px;
            margin-right: 10px;
        }
    }
    @media (max-width: 768pc) {
        .contain{
            margin-left: 20px;
            margin-right: 20px;
        }
    }
    .main-title{
        display: flex;
        justify-content: center;
        gap: 8px;
        svg{
            width: 30px;
            
            cursor: pointer;
        }
    }
    textarea{
        border-radius: 10px;
        border-color: #d1d5db;
    }
    .reset{
        border-radius: 10px;
        border-width: 2px;
        font-size: larger;
        font-weight: bold;
        width: fit-content;
        margin: 5px 10px;
        padding: 5px 10px;
    }
    .submit{
        border-radius: 10px;
        background-color: #1423fc;
        color: white;
        font-size: larger;
        font-weight: bold;
        width: fit-content;
        margin: 5px 10px;
        padding: 5px 10px;
    }
    .del{
        display: flex;
        justify-content: center;
    }
    .del-comp{
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        margin: 20px;
    }
</style>