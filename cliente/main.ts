import { createApp } from 'vue';

import App from './App.vue';
import { plugin as routePlugin } from './rutas';

createApp(App).use(routePlugin).mount('#app');
