<template>
    <Navbar></Navbar>
    <main>
        <div class="p-[20px]">
            <router-view :key="this.$route.fullPath"></router-view>
        </div>
    </main>
</template>

<script lang="js">
import Navbar from './components/Navbar.vue';

export default {
    components: {
        Navbar
    }
}
</script>