<template>
    <div class="image" @click="browseImage">
        <div class="new-image" :style="{display:file ?'none':'flex'}">
            <input type="file" accept="image/*" ref="image" class="hidden" @change="addImage">
            <div class="input-image" v-if="!src">
                <svg xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 24 24" style="transform: ;msFilter:;"><path d="M18.944 11.112C18.507 7.67 15.56 5 12 5 9.244 5 6.85 6.61 5.757 9.149 3.609 9.792 2 11.82 2 14c0 2.657 2.089 4.815 4.708 4.971V19H17.99v-.003L18 19c2.206 0 4-1.794 4-4a4.008 4.008 0 0 0-3.056-3.888zM8 12h3V9h2v3h3l-4 5-4-5z"></path></svg>
                <div class="lab">Upload</div>
            </div>
        </div>
        
        <img :src="src" alt="">
        

    </div>
</template>

<script>
    export default {
        props:['value'],
        emits:['update:value'],
        data(){
            return {
                src:this.value,
                file: null,
            }
        },
        methods:{
            browseImage(){
                this.$refs.image.click()
            },
            addImage(e){
                this.file= e.target.files[0]
                this.$emit('update:value', this.file)
                const reader= new FileReader()
                reader.onload = (e)=>{
                    this.src=e.target.result
                }
                reader.readAsDataURL(this.file)
            }
        }
    }
</script>

<style lang="css" scoped>
    .image{
        position: relative;
        cursor: pointer;
        overflow: hidden;
        display: flex;
        justify-content: center;
        align-items: center;
        width: 150px;
        height: 200px;
        border-width: 1px;
        border-radius: 10px;
    }
    .new-image{
        position: absolute;
        justify-content: center;
        align-items: center;
        width: 100%;
        height: 100%;
        /* overflow: hidden; */
    }
    .input-image{
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
    }
    svg{
        /* width: 100%; */
        height: 150px;
        width: 150px;
        display: flex;
        justify-content: center;
        fill: #074f74;
        transition: 0.7s;
    }

    image:hover > svg{
        fill: #0984c2;
    }
</style>