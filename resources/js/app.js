import './bootstrap';
import { createApp } from 'vue';
import App from './App.vue';
import ExampleComponent from './components/ExampleComponent.vue';
import router from './router';

const app = createApp(App);
app.component('example-component', ExampleComponent);
app.use(router);
app.mount('#app');