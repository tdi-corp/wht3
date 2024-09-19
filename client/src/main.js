import './assets/main.css'

import { createApp } from 'vue'
import App from './App.vue'

import PrimeVue from 'primevue/config';
import Noir from './presets/Noir.js';
import DialogService from 'primevue/dialogservice';
import Button from "primevue/button"


const app = createApp(App)
app.use(PrimeVue, {
    theme: {
        preset: Noir
    }
});
app.component('Button', Button);
app.use(DialogService);
app.mount('#app')
