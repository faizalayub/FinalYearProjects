import { createApp } from "vue";
import dashboard from '/src/dashboard.vue';
import PrimeVue from 'primevue/config';

let mountInstance = createApp(dashboard);

mountInstance.use(PrimeVue);

mountInstance.mount('#app');