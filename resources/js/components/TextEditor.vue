<template>
    <div>
        <editor 
            :value="modelValue"
            @input="$emit('update:modelValue', $event.target.value)"
            :api-key="apiKey" 
            :init="{
                height: 500,
                menubar: false,
                plugins: [
                    'advlist autolink lists link image charmap print preview anchor',
                    'searchreplace visualblocks code fullscreen',
                    'insertdatetime media table paste code help wordcount',
                ],
                toolbar:
                    'undo redo | formatselect | bold italic backcolor | \
                        alignleft aligncenter alignright alignjustify | \
                        bullist numlist outdent indent | removeformat | help',
            }"
        />
    </div>
</template>
<script>
import Editor from '@tinymce/tinymce-vue';

export default {
    props: ['modelValue'],
    emits: ['update:modelvalue'],
    data() {
        return {
            apiKey: "e1qumxphhc5thabmjghru8dz8vqjfvcmdl9401y8td6uf0c2"
        }
    },
    components: {
        'editor': Editor
    }
}
</script>
