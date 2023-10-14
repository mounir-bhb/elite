<template>
    <div>
        <input type="file" @change="handleFileChange" />
    <!-- <div @click="uploadFile">Upload</div> -->
        <p v-if="progress > 0">Téléchargement: {{ progress }}%</p>
    </div>
</template>

<script>
import axios from 'axios';

    export default {
        props: {
            value: { // Value prop for v-model
                type: Number,
                default: null,
            },
        },
        data() {
            return {
                file: null,
                totalChunks: 0,
                currentChunk: 0,
                progress: 0,
                /* videoId: '' */
            };
        },
        methods:{
            handleFileChange(event) {
                this.file = event.target.files[0];
                this.totalChunks = Math.ceil(this.file.size / (1 * 1024 * 1024)); // 1MB chunk size
                this.uploadFile()
            },
            async uploadChunk(chunkNumber) {
                const start = (chunkNumber - 1) * 1024 * 1024;
                const end = chunkNumber * 1024 * 1024 >= this.file.size ? this.file.size : chunkNumber * 1024 * 1024;
                const formData = new FormData();
                formData.append('file', this.file.slice(start, end));
                formData.append('chunkNumber', chunkNumber);
                formData.append('totalChunks', this.totalChunks);
                formData.append('fileName', this.file.name);

                return axios.post('/upload-chunk', formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data',
                    },
                    onUploadProgress: (progressEvent) => {
                        this.progress = Math.round((100 * (this.currentChunk - 1 + progressEvent.loaded / progressEvent.total)) / this.totalChunks);
                    },
                });
            },
            async uploadFile(){
                try{
                    for (let i = 1; i <= this.totalChunks; i++) {
                        await this.uploadChunk(i);
                        this.currentChunk = i;
                        //console.log(i);
                    }
                    const response = await axios.post('/merge-file', {
                        fileName: this.file.name,
                        totalChunks: this.totalChunks,
                    });
                    this.$emit('update:value', response.data.id);
                    /* alert('File uploaded successfully!'); */
                } catch (error) {
                    // Handle errors
                    console.error(error);
                    alert('Error uploading the file. Please try again later.');
                } finally {
                    // Reset progress and current chunk
                    this.progress = 0;
                    this.currentChunk = 0;
                }
            }
        } 
    }
    
</script>

<style lang="scss" scoped>

</style>