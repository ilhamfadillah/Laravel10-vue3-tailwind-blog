<template>
    <div class="w-full xs:w-full sm:w-full md:w-3/4 lg:w-full border-[1px] p-[20px]">
        <div class="border-b-2 mb-[10px]">
            <h1 class="text-[40px] xs:text-[20px] sm:text-[20px]">{{ this.blog?.title }}</h1>
            <p class="italic">Created At: {{ this.blog?.created_at }}</p>
            <p class="italic">Created By: {{ this.blog?.user.name }}</p>
        </div>
        <span class="text-justify" v-html="(this.blog?.content)"></span>
    </div>
</template>
<script>
import axios from 'axios';

export default {
    data() {
        return {
            id: this.$route.params.id,
            blog: null
        }
    },
    mounted() {
        axios.get(`http://localhost:8000/api/blog/${this.id}`).then(response => {
            this.blog = response.data;
        }).catch(error => {
            console.log(error);
        });
    },
}
</script>