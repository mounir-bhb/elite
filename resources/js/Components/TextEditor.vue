<template>
    <div>
        <ckeditor :editor="editor" v-model="editorContent" :config="editorConfig"/>
    </div>
</template>

<script>
    import ClassicEditor from '@ckeditor/ckeditor5-build-classic';
    import CKEditor from '@ckeditor/ckeditor5-vue';
    //import  {Alignment}  from '@ckeditor/ckeditor5-alignment';
    //import '@ckeditor/ckeditor5-editor-classic/src/classiceditor.css';
    export default {
        components:{
            ckeditor: CKEditor.component,
        },
        props:{
            modelValue: {
                type: String,
                required: true,
            },
            language: {
                type: String,
                default: 'ar', // Default language is Arabic
            },
        },
        emits: ['update:modelValue'],
        data() {
            return {
                editor: ClassicEditor,
                editorContent: this.modelValue,
                editorConfig: {
                    plugins:[
                        Alignment
                    ],
                    toolbar: [ 'undo', 'redo', 'bold', 'italic', 'numberedList', 'bulletedList', 'alignement' ]
                    
                },
            };
        },
        watch: {
            modelValue(newVal) {
                this.editorContent = newVal;
            },
            language(newVal) {
                this.editorConfig.language = newVal;
                this.initializeEditor();
            },
        },
        mounted() {
            this.initializeEditor();
        },
        methods:{
            initializeEditor() {
                this.editorConfig = {
                    // Add any CKEditor 5 configuration options here
                    language: this.language,
                };
            },
        }
    }
</script>

<style lang="scss" scoped>

</style>