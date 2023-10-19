<template>
    <div class="p-10">
        <p v-if="v$.title.$error">{{ v$?.title.$errors[0].$message }}</p>
        <p v-if="v$.content.$error">{{ v$?.content.$errors[0].$message }}</p>
        <form @submit.prevent="handleSubmit">
            <input type="text" class="border-2 border-black p-2" placeholder="Title" v-model="title">
            <p></p>
            <editor v-model="content" api-key="e1qumxphhc5thabmjghru8dz8vqjfvcmdl9401y8td6uf0c2" />
            <button type="submit" class="bg-blue-400 p-2 rounded-md">Submit</button>
        </form>
    </div>
</template>
<script>
import Editor from '@tinymce/tinymce-vue';
import { useVuelidate } from "@vuelidate/core";
import { required } from "@vuelidate/validators";

export default {
    components: {
        'editor': Editor
    },
    validations() {
        return {
            title: { required },
            content: { required }
        }
    },
    data() {
        return {
            v$: useVuelidate(),
            title: null,
            content: null
        }
    },
    methods: {
        handleSubmit() {
            this.v$.$validate();
            if (this.v$.$error) {
                return;
            } else {
                axios.post("/api/admin/blog", {
                    title: this.title,
                    content: this.content
                }, {
                    headers: {
                        'Authorization': `Bearer ${localStorage.getItem('token')}`
                    }
                }).then((response) => {
                    this.$router.push({ name: 'adminDashboard' });
                }).catch((error) => console.log(error));
            }
        }
    },
}
</script>