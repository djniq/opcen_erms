import {createApp} from 'vue';
import App from './App.vue';
import router from '../opcen/router';
import VueGoogleMaps from '@fawmi/vue-google-maps';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';
import Notifications from '@kyvg/vue3-notification';
import pinia from '@/middleware/pinia';
import acl from '@/middleware/acl';
import * as ConfirmDialog from 'vuejs-confirm-dialog'

createApp(App)
    .use(router)
    .use(pinia)
    .use(acl)
    .use(ConfirmDialog)
    .use(VueGoogleMaps, {
      load: {
        key: import.meta.env.VITE_GOOGLE_API_KEY,
        libraries: "places",
      },
    })
    .use(Notifications)
    .component('font-awesome-icon', FontAwesomeIcon)
    .mount("#app")