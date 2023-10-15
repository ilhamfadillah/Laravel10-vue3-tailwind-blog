<template>
    <div>
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
            blogs: [],
            page: 1,
        };
    },
    created() {
        this.getBlog();
    },
    methods: {
        getBlog() {
            axios.get(`/api/blog?page=${this.page}`).then(response => {
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
        window.addEventListener('scroll', this.handleScroll);
    },
    beforeDestroy: function () {
        window.removeEventListener('scroll', this.handleScroll);
    },
    components: { CardList }
}

</script>