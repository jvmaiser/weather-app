import './bootstrap';

import { createApp } from 'vue';
import MainLayout from './Layouts/MainLayout.vue';

const app = createApp({
    components: {
        MainLayout,
    },
});

app.mount('#app');
