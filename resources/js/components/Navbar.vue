<template>
    <nav class="bg-black w-full text-white justify-between items-center">
        <!-- AUTH REUQIRED -->
        <div v-if="isAuthRequired">
            <div class="flex flex-wrap justify-end">
                <button type="button" class="p-[10px] bg-green-400 text-black" @click="logout">
                    LOGOUT
                </button>
            </div>
        </div>
        <!-- END AUTH REQUIRED -->

        <div v-else>
            <div class="flex flex-wrap justify-between">
                <div class="xs:order-1 p-[10px]">
                    <router-link :to="{ name: 'index' }">MyBlog</router-link>
                </div>
                <div class="xs:order-3 p-[10px] xs:p-0">
                    <input type="text"
                        class="p-[5px] xs:w-screen text-black text-[15px] h-full flex items-center xs:border-b-[1px] xs:border-black"
                        placeholder="My Blog..." @keyup.enter="search">
                </div>
                <div class="xs:order-2 p-[10px]">
                    <router-link :to="{ name: 'login' }">Login</router-link>
                </div>
            </div>
        </div>
    </nav>
</template>
<script>

export default {
    data() {
        return {}
    },
    computed: {
        isAuthRequired() {
            return this.$route.meta.authRequired;
        }
    },
    methods: {
        search(event) {
            this.$router.push({ name: 'searchList', query: { search: event.target.value } });
        },
        logout() {
            axios.post("/api/logout", {
                email: this.email,
                password: this.password
            }, {
                headers: {
                    'Authorization': `Bearer ${localStorage.getItem("token")}`
                }
            }).then(() => {
                localStorage.removeItem("token");
                localStorage.removeItem("user");
                this.$router.push({ name: 'login' })
            })
        }
    },
}
</script>