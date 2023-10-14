<template>
    <div >
        <input type="file" accept=".pdf" ref="pdf" @change="addPdf">
        <!-- <div v-if="!file" @click="browsePdf">
            <div class="input-image" >
            <svg xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 24 24" style="transform: ;msFilter:;"><path d="M18.944 11.112C18.507 7.67 15.56 5 12 5 9.244 5 6.85 6.61 5.757 9.149 3.609 9.792 2 11.82 2 14c0 2.657 2.089 4.815 4.708 4.971V19H17.99v-.003L18 19c2.206 0 4-1.794 4-4a4.008 4.008 0 0 0-3.056-3.888zM8 12h3V9h2v3h3l-4 5-4-5z"></path></svg>
            <div class="lab">Upload</div>
            </div>
        </div> -->
        
    </div>
</template>

<script>
    export default {
        props:['value'],
        emits:['update:value'],
        data(){
            return {
                src:this.value,
                file: null
            }
        },
        methods:{
            browsePdf(){
                this.$refs.pdf.click()
            },
            addPdf(e){
                this.file = e.target.files[0];

                // Convert FileList to a regular array
                /* const filesArray = Array.from(fileList);
                
                this.files= this.files.concat(filesArray) */
                this.$emit('update:value', this.file)
            },
            /* delFile(index){
                this.files.splice(index,1)
            }, */
        }
    }
</script>

<style lang="scss" scoped>

</style>