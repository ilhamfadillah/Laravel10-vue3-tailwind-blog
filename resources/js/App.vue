<template>
    <div class="flex flex-col h-screen">
        <header class="flex">
            <Navbar />
        </header>
        <main class="flex flex-grow">
            <router-view :key="this.$route.fullPath"></router-view>
        </main>
    </div>
</template>

<script lang="js">
import Navbar from './components/Navbar.vue';

export default {
    data() {
        return {}
    },
    components: {
        Navbar,
    }
}
</script>