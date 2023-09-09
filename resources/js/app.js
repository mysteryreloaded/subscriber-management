import './bootstrap';
import '../css/app.css';
import { createApp } from 'vue/dist/vue.esm-bundler';
import IndexPage from './Components/IndexPage.vue';
import Modal from './Components/Modal.vue';

const app = createApp({
    components: {
        IndexPage,
        Modal,
    }
});

app.component('page-index', IndexPage)
app.component('modal', Modal)
app.mount('#app');

window.app = app;
