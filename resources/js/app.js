import './bootstrap';
import { createApp } from 'vue/dist/vue.esm-bundler';
import { createRouter, createWebHashHistory } from 'vue-router';

import App from "./App.vue";

const Home = { template: '<div>Home</div>' }
const About = { template: '<div>About</div>' }

const routes = [
  { path: '/', component: Home },
  { path: '/about', component: About },
]
const router = createRouter({
  history: createWebHashHistory(),
  routes, // short for `routes: routes`
})

const app = createApp(App);
app.use(router)
app.mount('#app')
