import './bootstrap';
import '../css/app.css';
import { createApp } from 'vue/dist/vue.esm-bundler';
import IndexPage from './Components/IndexPage.vue';
import Modal from './Components/Modal.vue';

createApp({
    components: {
        IndexPage,
        Modal,
    }
})
    .component('page-index', IndexPage)
    .component('modal', Modal)
    .mount('#app');
