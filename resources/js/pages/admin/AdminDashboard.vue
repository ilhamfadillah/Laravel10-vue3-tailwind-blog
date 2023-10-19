<template>
    <div class="w-full">
        <div class="flex flex-col mt-[50px] p-2 w-2/3 mx-auto">
            <router-link :to="{ name: 'adminBlogCreate' }">
                <div class="bg-yellow-400 w-fit p-2 rounded-md">Create</div>
            </router-link>
            <div class="mt-2">
                <table id="table-blog" class="w-full">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Status</th>
                            <th>Created at</th>
                            <th>Total Like</th>
                            <th>Total Dislike</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(value, index) in data">
                            <td>{{ value.title }}</td>
                            <td>{{ value.status }}</td>
                            <td>{{ formatDate(value.created_at) }}</td>
                            <td class="text-right">{{ value.liked_count }}</td>
                            <td class="text-right">{{ value.dislike_count }}</td>
                            <td class="space-x-2">
                                <router-link :to="{ name: 'adminBlogEdit', params: { id: value.id } }">
                                    <button type="button"
                                        class="bg-blue-400 p-2 border-[1px] border-blue-400 rounded-md font-semibold">Edit</button>
                                </router-link>
                                <button v-if="value.status != 'published'" type="button"
                                    class="bg-green-400 p-2 border-[1px] border-green-400 rounded-md font-semibold"
                                    @click="publish(value.id, 'published')">Published</button>
                                <button v-if="value.status == 'published'" type="button"
                                    class="bg-cyan-400 p-2 border-[1px] border-cyan-400 rounded-md font-semibold"
                                    @click="publish(value.id, 'unpublished')">Unpublish</button>
                                <button type="button"
                                    class="bg-red-400 p-2 border-[1px] border-red-400 rounded-md font-semibold"
                                    @click="remove(value.id)">Delete</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="flex justify-center mt-3">
                <button v-for="index in totalPage" :key="index" class="border-[1px] border-black py-1 px-3"
                    @click="changePage(index)">{{ index }}</button>
            </div>
        </div>
    </div>
</template>
<script>
import axios from 'axios';

export default {
    data() {
        return {
            data: null,
            page: 1,
            totalPage: 0
        }
    },
    beforeMount() {
        this.loadData();
    },
    methods: {
        formatDate(createdAt) {
            const date = new Date(createdAt);
            return date.toLocaleDateString();
        },
        changePage(page) {
            this.page = page;
            this.loadData();
        },
        loadData() {
            axios.get(`/api/admin/blog?page=${this.page}`, {
                headers: {
                    'Authorization': `Bearer ${localStorage.getItem('token')}`
                }
            }).then((response) => {
                this.data = response.data.data;
                this.totalPage = response.data.last_page;
            })
        },
        publish(id, status) {
            axios.put(`/api/admin/blog/${id}/publish`, { status: status }, {
                headers: {
                    'Authorization': `Bearer ${localStorage.getItem('token')}`
                }
            }).then((response) => {
                this.loadData();
            })
        },
        remove(id) {
            axios.delete(`/api/admin/blog/${id}`, {
                headers: {
                    'Authorization': `Bearer ${localStorage.getItem('token')}`
                }
            }).then((response) => {
                this.loadData();
            })
        }
    }
}
</script>
<style>
#table-blog,
#table-blog tr,
#table-blog th,
#table-blog td {
    border: 1px solid black;
}

#table-blog th,
#table-blog td {
    padding: 10px;
}
</style>