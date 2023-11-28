import {createApp} from 'vue';

import App from './App.vue';
import router from '../opcen/router';
import VueGoogleMaps from '@fawmi/vue-google-maps';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'

createApp(App)
    .use(router)
    .use(VueGoogleMaps, {
      load: {
        key: import.meta.env.VITE_GOOGLE_API_KEY,
        libraries: "places"
      },
    })
    .component('font-awesome-icon', FontAwesomeIcon)
    .mount("#app")