import './bootstrap';
import { createApp } from 'vue/dist/vue.esm-bundler';
import { createRouter, createWebHashHistory } from 'vue-router';

import App from "./App.vue";
import Index from "./pages/Index.vue";
import BlogDetail from "./pages/BlogDetail.vue";
import SearchList from "./pages/SearchList.vue";

const routes = [
  { path: '/', component: Index, name: 'index' },
  { path: '/:id', component: BlogDetail, name: 'blogDetail' },
  { path: '/search', component: SearchList, name: 'searchList' },
]
const router = createRouter({
  history: createWebHashHistory(),
  routes
})

const app = createApp(App);
app.use(router)
app.mount('#app')
