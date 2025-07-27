import { createRouter, createWebHistory } from 'vue-router';
import Home from './components/ExampleComponent.vue';
import PostIndex from './components/posts/PostIndex.vue';
import CreatePost from './components/posts/CreatePost.vue';
import Registration from './components/Auth/Registration.vue';
import Login from './components/Auth/Login.vue';

const routes = [
    { path: '/', component: Home },
    { path: '/posts', component: PostIndex },
    { path: '/posts/create', component: CreatePost },
    { path: '/register', component: Registration },
    { path: '/login', component: Login },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;