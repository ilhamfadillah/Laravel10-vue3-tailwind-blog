<template>
    <div>
        <header>
            <div class="bg-black max-w-full">
                <div class="p-[20px] text-white">
                    <div class="flex justify-between">
                        <div class="block xs:hidden sm:hidden">
                            <router-link :to="{ name: 'index' }">MyBlog</router-link>
                        </div>
                        <div>
                            <input type="text" class="rounded-3xl px-[13px] text-black text-[15px] h-full flex items-center"
                                placeholder="My Blog..." @keyup.enter="search">
                        </div>
                        <div>Login</div>
                    </div>
                </div>
            </div>
        </header>
    </div>
</template>
<script>

export default {
    methods: {
        search(event) {
            this.$router.push({ name: 'searchList', query: { search: event.target.value } });
        }
    },
}
</script>