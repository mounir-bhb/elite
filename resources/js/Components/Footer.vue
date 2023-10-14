<template>
    <div class="contact mt-20"
        data-aos="flip-down"
        data-aos-offset="0"
        data-aos-delay="500"
        data-aos-duration="700"
        data-aos-easing="ease-in-out"
        data-aos-mirror="false"
        data-aos-once="false"
    >
                <h2 class="main-title">contacte</h2>
                <div class=" grid place-items-center"><div class="border border-blue-600 w-3/4 lg:w-1/4"></div></div>
                <div class="content-contact mt-5 ">
                    
                        
                    
                    <div class="contact-logo flex flex-col items-center relative">
                        <svg viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg" class="blob1">
                            <path fill="white" d="M69.3,-19.4C76.4,-0.6,59.5,29,35.2,46.2C10.9,63.3,-20.9,67.9,-43.5,53.1C-66.1,38.3,-79.4,4.1,-70.6,-17C-61.9,-38.1,-30.9,-46.1,0.1,-46.1C31.1,-46.2,62.2,-38.2,69.3,-19.4Z" transform="translate(100 100)" />
                        </svg>
                        <img src="/images/logo.png" alt="" class="logo-img">
                        <h1 class="text-gray-900 z-10">ELITE CORNER</h1>
                    </div>
                    <!-- <div class="details-contact"> -->
                    <div>
                        <div class="flex gap-2 items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="icon icon-tlf"><!--! Font Awesome Free 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M164.9 24.6c-7.7-18.6-28-28.5-47.4-23.2l-88 24C12.1 30.2 0 46 0 64C0 311.4 200.6 512 448 512c18 0 33.8-12.1 38.6-29.5l24-88c5.3-19.4-4.6-39.7-23.2-47.4l-96-40c-16.3-6.8-35.2-2.1-46.3 11.6L304.7 368C234.3 334.7 177.3 277.7 144 207.3L193.3 167c13.7-11.2 18.4-30 11.6-46.3l-40-96z"/></svg>
                            <span>+213 558 05 58 78</span>
                        </div>
                        <a href="mailto:ejeyd@example.com" target="_blank" class="flex gap-2 items-center">
                            <img src="/images/message-icon.png" alt="" class="icon">
                            <span>contact@elite-corner.dz</span>
                        </a>
                        <a href="https://www.google.com/maps/place/IMC+INSTITUT+MULTI+COACHING/@34.8834286,-1.31564,17z/data=!3m1!4b1!4m6!3m5!1s0xd78c9067e4063ff:0x1dc1b5f27b317f61!8m2!3d34.8834286!4d-1.31564!16s%2Fg%2F11p5jf0_sg?entry=ttu" target="_blank" class="flex gap-2 items-center">
                            <img src="/images/map.png" alt="" class="icon">
                            <span>Localistation</span>
                        </a>
                    </div>
                    <div>
                        <a href="https://web.facebook.com/profile.php?id=100076418910955" target="_blank" class="flex gap-2 items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="icon face"><!--! Font Awesome Free 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M504 256C504 119 393 8 256 8S8 119 8 256c0 123.78 90.69 226.38 209.25 245V327.69h-63V256h63v-54.64c0-62.15 37-96.48 93.67-96.48 27.14 0 55.52 4.84 55.52 4.84v61h-31.28c-30.8 0-40.41 19.12-40.41 38.73V256h68.78l-11 71.69h-57.78V501C413.31 482.38 504 379.78 504 256z"/></svg>
                            <span>facebook</span>
                        </a>
                        <a href="https://www.instagram.com/institut.multi.coaching/" target="_blank" class="flex gap-2 items-center">
                            <img src="/images/insta-icon2.png" alt="" class="icon">
                            <span>instagram</span>
                        </a>
                        <a href="https://api.whatsapp.com/send?phone=549517976" target="_blank" class="flex gap-2 items-center">
                            <img src="/images/whatsapp.png" alt="" class="icon">
                            <span>WhatsApp</span>
                        </a>
                        
                        
                        
                    </div>
                    
                <!-- </div> -->
                </div>
                
            </div>

</template>

<script>
    
    export default {
        
    }
</script>

<style lang="scss" scoped>
    .contact{
        font-size: larger;
        background-color: rgb(14, 13, 13);
        color: white;
        padding: 20px;
        overflow: hidden;
    }
    .content-contact{
        display: flex;
        justify-content: space-around;
        align-items: center;
        width: 100%;
        flex-wrap: wrap;
        /* gap: 50px; */
    }
    @media (max-width: 500px){
        .contact-logo{
            width: 100%;
            display: flex;
            justify-content: center;
        }
    }
    @media (max-width: 500px){
        /* .content-contact{
            flex-direction: column;
        } */
        /* .details-contact{
            display: flex;
            justify-content: space-around;
            width: 100%;
            padding-top: 10px;
            padding-bottom: 20px;
        } */
    }
    .face{
        fill: #1877f2;
    }
    .icon{
        width: 20px;
    }
    .icon-tlf{
        fill: white;
    }
    .contact span{
        font-size: large;
    }
    .logo-img{
        width: 120px;
        z-index: 2;
    }
    
    .blob1{
      position: absolute;
      
      width: 350px;
      /* opacity: 0.9; */
      top: -50%;
      left: -25%;
    }
</style>