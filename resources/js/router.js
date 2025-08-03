import { createRouter, createWebHistory } from "vue-router";
import Home from "./components/ExampleComponent.vue";
import PostsIndex from "./components/posts/PostsIndex.vue";
import Post from "./components/posts/Post.vue";
import CreatePost from "./components/posts/CreatePost.vue";
import Registration from "./components/Auth/Registration.vue";
import Login from "./components/Auth/Login.vue";
import Profile from "./components/Auth/Profile.vue";

const routes = [
  { path: "/", component: Home },
  { path: "/posts", component: PostsIndex },
  { path: "/posts/:id", component: Post },
  { path: "/posts/create", component: CreatePost },
  { path: "/register", component: Registration },
  { path: "/login", component: Login },
  { path: "/profile", component: Profile },
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

export default router;
