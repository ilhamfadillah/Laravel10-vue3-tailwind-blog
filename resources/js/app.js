import "./bootstrap";
import { createApp } from "vue/dist/vue.esm-bundler";
import { createRouter, createWebHashHistory } from "vue-router";

import App from "./App.vue";
import Index from "./pages/Index.vue";
import BlogDetail from "./pages/BlogDetail.vue";
import SearchList from "./pages/SearchList.vue";
import Login from "./pages/Login.vue";
import AdminDashboard from "./pages/admin/AdminDashboard.vue";
import AdminBlogCreate from "./pages/admin/AdminBlogCreate.vue";
import AdminBlogEdit from "./pages/admin/AdminBlogEdit.vue";

const routes = [
  { path: "/", component: Index, name: "index" },
  { path: "/:id", component: BlogDetail, name: "blogDetail" },
  { path: "/search", component: SearchList, name: "searchList" },
  { path: "/login", component: Login, name: "login" },
  { 
    path: "/admin/dashboard",
    component: AdminDashboard,
    name: "adminDashboard",
    meta: {
      authRequired: true
    }
  },
  { 
    path: "/admin/blog/create",
    component: AdminBlogCreate,
    name: "adminBlogCreate",
    meta: {
      authRequired: true
    }
  },
  { 
    path: "/admin/blog/:id",
    component: AdminBlogEdit,
    name: "adminBlogEdit",
    meta: {
      authRequired: true
    }
  }
];
const router = createRouter({
  history: createWebHashHistory(),
  routes,
});

router.beforeEach((to, from, next) => {
  if (!to.meta.authRequired) {
    next();
  }

  const token = localStorage.getItem('token');
  if (!token) {
    next("/login");
  }

  next();
});

const app = createApp(App);
app.use(router);
app.mount("#app");
