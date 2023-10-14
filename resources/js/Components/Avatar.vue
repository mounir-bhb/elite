<template>
    <div>
        <input type="file" accept="image/*" ref="avatar" class="hidden" @change="addAvatar">
        <div @click="browseAvatar" class="avatar">
            <img :src="image" alt="" v-if="!src">
            <img :src="src" alt="" v-if="src">
            <div class="new-avatar">
                modifier
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props:['value','image'],
        emits:['update:value'],
        /* mounted(){
        if (this.sex=="homme") {
            this.src="/images/boy.jpg"
            this.file="/images/boy.jpg"
        }
        else if(this.sex=="femme"){
            this.src="/images/girl.jpg"
            this.file="/images/girl.jpg"
        } 
        },*/
        data(){
            return {
                src:null,
                file: this.image,
                
            }
            
        },
        methods:{
            browseAvatar(){
                this.$refs.avatar.click()
            },
            addAvatar(e){
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
    .avatar{
        position: relative;
        
        overflow: hidden;
        display: flex;
        justify-content: center;
        width: 150px;
        height: 200px;
    }
    .new-avatar{
        position: absolute;
        background-color: rgba(0, 0, 0, 0.7);
        color: white;
        display: none;
        justify-content: center;
        align-items: flex-end;
        width: 100%;
        height: 100%;
        /* overflow: hidden; */
    }
    .avatar:hover > .new-avatar{
        display: flex;
    }
</style>