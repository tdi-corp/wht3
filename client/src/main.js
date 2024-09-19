import './assets/main.css'

import { createApp } from 'vue'
import App from './App.vue'
import PrimeVue from 'primevue/config';
import Lara from '@primevue/themes/lara';

import Button from "primevue/button"


const app = createApp(App)
app.use(PrimeVue, {
    theme: {
        preset: Lara
    }
});
app.component('Button', Button);
app.mount('#app')
