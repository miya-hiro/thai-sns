<template>
    <div>
        <ckeditor
            :editor="editor"
            v-model="editorData"
            :config="editorConfig"
        ></ckeditor>
    </div>
</template>

<script>
    import ClassicEditor from '@ckeditor/ckeditor5-build-classic';

    export default {
        name: 'ckeditor-component',
        data() {
            return {
                editor: ClassicEditor,
                editorData: '',
                editorConfig: {
                    language: 'ja'
                }
            };
        }
    }
</script>