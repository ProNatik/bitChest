import './style.css'
import { createApp } from 'vue'
import App from './App.vue'

// Vuetify
import 'vuetify/styles'
import { createVuetify } from 'vuetify'
import * as components from 'vuetify/components'
import * as directives from 'vuetify/directives'
import * as labsComponents from 'vuetify/labs/components' // Contains <v-skeleton loader/>

// Pinia
import { createPinia } from 'pinia'

import router from './router'
import axios from 'axios'

axios.defaults.baseURL = 'http://localhost:8000/api/';

const app = createApp(App)
const pinia = createPinia()

app.use(pinia)
app.use(
  createVuetify({
    components: { ...components, ...labsComponents },
    directives,
    icons: { defaultSet: 'mdi' }
  })
)
app.use(router);

app.mount('#app')
