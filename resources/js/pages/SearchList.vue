<template>
    <div>
        <div class="mb-[10px]">
            <h1>Keyword: {{ this.$route.query.search }}</h1>
        </div>
        <div class="grid grid-cols-1 gap-4">
            <div v-for="(blog, index) in blogs">
                <router-link :to="{ name: 'blogDetail', params: { id: blog.id } }">
                    <CardList :title="(blog.title)" :created_at="(blog.created_at)" :author="(blog.user.name)"
                        :liked_count="(blog.liked_count)" :content="(blog.content)" />
                </router-link>
            </div>
        </div>
    </div>
</template>
<script>

import axios from 'axios';
import CardList from '../components/CardList.vue';

export default {
    data: function () {
        return {
            currentQuery: '',
            blogs: [],
            page: 1,
        };
    },
    created() {
        this.getBlog();
    },
    methods: {
        getBlog() {
            axios.post(`/api/blog/search`, {
                search: this.$route.query.search
            }).then(response => {
                if (this.currentQuery != this.$route.query.search) {
                    this.blogs = [];
                    this.page = 1;
                }
                this.blogs = this.blogs.concat(response.data.data);
                this.page++;
            }).catch(error => {
                console.log(error);
            });
        },
        handleScroll() {
            const bottomOfPage = window.innerHeight + window.scrollY >= document.documentElement.offsetHeight;
            if (bottomOfPage) {
                this.getBlog();
            }
        },
    },
    mounted: function () {
        this.currentQuery = this.$route.query.search;
        window.addEventListener('scroll', this.handleScroll);
    },
    beforeDestroy: function () {
        window.removeEventListener('scroll', this.handleScroll);
    },
    components: { CardList }
}

</script>