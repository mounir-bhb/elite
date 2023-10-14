<template>
    <!-- <EdidorNavbar class="editor__header" :editor="editor"></EdidorNavbar> -->
    <div class="shadow-md bg-white p-2">
    <div class="flex justify-center gap-3 mb-1">
        
    <!-- <div @click="editor.chain().focus().toggleCode().run()" :disabled="!editor.can().chain().focus().toggleCode().run()" :class="{ 'is-active': editor.isActive('code') }">
      code
    </div> 
    <div @click="editor.chain().focus().unsetAllMarks().run()">
      clear marks
    </div>
    <div @click="editor.chain().focus().clearNodes().run()">
      clear nodes
    </div>-->
      <div @click="editor.chain().focus().setParagraph().run()" :class="{ 'bg-[#eee]': editor.isActive('paragraph') }" class="p-1 cursor-pointer">
        <svg xmlns="http://www.w3.org/2000/svg" width="20px" height="20px" viewBox="0 0 24 24"><path d="M12 6V21H10V16C6.68629 16 4 13.3137 4 10C4 6.68629 6.68629 4 10 4H20V6H17V21H15V6H12ZM10 6C7.79086 6 6 7.79086 6 10C6 12.2091 7.79086 14 10 14V6Z"></path></svg>
      </div>
      
      <div @click="editor.chain().focus().toggleBulletList().run()" :class="{ 'bg-[#eee]': editor.isActive('bulletList') }" class="p-1 cursor-pointer">
        <svg xmlns="http://www.w3.org/2000/svg" width="20px" height="20px" viewBox="0 0 24 24"><path d="M8 4H21V6H8V4ZM4.5 6.5C3.67157 6.5 3 5.82843 3 5C3 4.17157 3.67157 3.5 4.5 3.5C5.32843 3.5 6 4.17157 6 5C6 5.82843 5.32843 6.5 4.5 6.5ZM4.5 13.5C3.67157 13.5 3 12.8284 3 12C3 11.1716 3.67157 10.5 4.5 10.5C5.32843 10.5 6 11.1716 6 12C6 12.8284 5.32843 13.5 4.5 13.5ZM4.5 20.4C3.67157 20.4 3 19.7284 3 18.9C3 18.0716 3.67157 17.4 4.5 17.4C5.32843 17.4 6 18.0716 6 18.9C6 19.7284 5.32843 20.4 4.5 20.4ZM8 11H21V13H8V11ZM8 18H21V20H8V18Z"></path></svg>
      </div>
      <div @click="editor.chain().focus().toggleOrderedList().run()" :class="{ 'bg-[#eee]': editor.isActive('orderedList') }" class="p-1 cursor-pointer">
        <svg xmlns="http://www.w3.org/2000/svg" width="20px" height="20px" viewBox="0 0 24 24"><path d="M8 4H21V6H8V4ZM5 3V6H6V7H3V6H4V4H3V3H5ZM3 14V11.5H5V11H3V10H6V12.5H4V13H6V14H3ZM5 19.5H3V18.5H5V18H3V17H6V21H3V20H5V19.5ZM8 11H21V13H8V11ZM8 18H21V20H8V18Z"></path></svg>
      </div>
    <!-- <div @click="editor.chain().focus().toggleCodeBlock().run()" :class="{ 'is-active': editor.isActive('codeBlock') }">
      code block
    </div>
    <div @click="editor.chain().focus().toggleBlockquote().run()" :class="{ 'is-active': editor.isActive('blockquote') }">
      blockquote
    </div>
    <div @click="editor.chain().focus().setHorizontalRule().run()">
      horizontal rule
    </div>
    <div @click="editor.chain().focus().setHardBreak().run()">
      hard break
    </div> -->
      <div @click="editor.chain().focus().setTextAlign('left').run()" :class="{ 'bg-[#eee]': editor.isActive({ textAlign: 'left' }) }" class="p-1 cursor-pointer">
        <svg xmlns="http://www.w3.org/2000/svg" width="20px" height="20px" viewBox="0 0 24 24"><path d="M3 4H21V6H3V4ZM3 19H17V21H3V19ZM3 14H21V16H3V14ZM3 9H17V11H3V9Z"></path></svg>
      </div>
      <div @click="editor.chain().focus().setTextAlign('center').run()" :class="{ 'bg-[#eee]': editor.isActive({ textAlign: 'center' }) }" class="p-1 cursor-pointer">
        <svg xmlns="http://www.w3.org/2000/svg" width="20px" height="20px" viewBox="0 0 24 24"><path d="M3 4H21V6H3V4ZM5 19H19V21H5V19ZM3 14H21V16H3V14ZM5 9H19V11H5V9Z"></path></svg>
      </div>
      <div @click="editor.chain().focus().setTextAlign('right').run()" :class="{ 'bg-[#eee]': editor.isActive({ textAlign: 'right' }) }" class="p-1 cursor-pointer">
        <svg xmlns="http://www.w3.org/2000/svg" width="20px" height="20px" viewBox="0 0 24 24"><path d="M3 4H21V6H3V4ZM7 19H21V21H7V19ZM3 14H21V16H3V14ZM7 9H21V11H7V9Z"></path></svg>
      </div>
      
    </div>
    <div>
      <editor-content :editor="editor" class="prose" :placeholder="placeholder" />
    </div>
  </div>
  </template>
  
  <script>
  import StarterKit from '@tiptap/starter-kit'
  import { Editor, EditorContent } from '@tiptap/vue-3'
  import EdidorNavbar from '@/Components/EditorNavbar.vue'
  //import Text from '@tiptap/extension-text'
import TextAlign from '@tiptap/extension-text-align'
  
  export default {
    components: {
        EditorContent,
        EdidorNavbar
    },
    props: {
    modelValue: {
        type: String,
        default: '',
    },
    placeholder: {
      type: String,
      default: undefined
    }
  },
  emits: ['update:modelValue'],
  data() {
    return {
      editor: new Editor({
      extensions: [
        StarterKit,
        TextAlign.configure({
          types: ['heading', 'paragraph'],
        }),
      ],
      content: this.modelValue,
      onUpdate: () => {
        // HTML
        this.$emit('update:modelValue', this.editor.getHTML())

        // JSON
        // this.$emit('update:modelValue', this.editor.getJSON())
      },
    }),
    }
  },
  watch: {
    modelValue(value) {
      // HTML
      const isSame = this.editor.getHTML() === value

      // JSON
      // const isSame = JSON.stringify(this.editor.getJSON()) === JSON.stringify(value)

      if (isSame) {
        return
      }

      this.editor.commands.setContent(value, false)
    },
  },
  /* mounted() {
    this.editor = new Editor({
      extensions: [
        StarterKit,
      ],
      content: this.modelValue,
      onUpdate: () => {
        
        this.$emit('update:modelValue', this.editor.getHTML())

        
      },
    })
  }, */
  beforeUnmount() {
    this.editor.destroy()
  },
  
    /* setup() {
      const editor = useEditor({
        content: '<p>I’m running Tiptap with Vue.js. 🎉</p>',
        extensions: [
          StarterKit,
        ],
      })
  
      return { editor }
    }, */
  }
  </script>
  <style lang="scss">
  /* Basic editor styles */
  .ProseMirror {
    width: 450px;
    /* display: block; */
    border-width: 1px;
    min-height: 100px;
    border-radius: 10px;
    > * + * {
      margin-top: 0.75em;
    }

    ul,
    ol {
      padding: 0 2rem;
    }
  
    h1,
    h2,
    h3,
    h4,
    h5,
    h6 {
      line-height: 1.1;
    }
  
    code {
      background-color: rgba(#616161, 0.1);
      color: #616161;
    }
  
    pre {
      background: #0D0D0D;
      color: #FFF;
      font-family: 'JetBrainsMono', monospace;
      padding: 0.75rem 1rem;
      border-radius: 0.5rem;
  
      code {
        color: inherit;
        padding: 0;
        background: none;
        font-size: 0.8rem;
      }
    }
  
    img {
      max-width: 100%;
      height: auto;
    }
  
    blockquote {
      padding-left: 1rem;
      border-left: 2px solid rgba(#0D0D0D, 0.1);
    }
  
    hr {
      border: none;
      border-top: 2px solid rgba(#0D0D0D, 0.1);
      margin: 2rem 0;
    }
  }
  </style>
  