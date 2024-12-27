import './bootstrap';
import 'bootstrap/dist/css/bootstrap.min.css'
import '../css/app.css';
import { createApp, h } from 'vue'
import { createInertiaApp } from '@inertiajs/vue3'
import Toast from "vue-toastification";
import "vue-toastification/dist/index.css";
import axios from 'axios';
import { Link } from '@inertiajs/vue3';
import { route } from 'ziggy-js';

// Vuetify
import 'vuetify/styles'
import { createVuetify } from 'vuetify'
import * as components from 'vuetify/components'
import * as directives from 'vuetify/directives'

const vuetify = createVuetify({
    components,
    directives,
  })

//fontawesome
import { library } from "@fortawesome/fontawesome-svg-core";
import { FontAwesomeIcon } from "@fortawesome/vue-fontawesome";

import {faMagnifyingGlass,faPhone,faLock,faWrench,faCircleCheck,faClock,faBullhorn,faMinusCircle,faCaretDown,faFilePen} from "@fortawesome/free-solid-svg-icons";
import { faEye,faComment} from '@fortawesome/free-regular-svg-icons';
library.add(faMagnifyingGlass,faPhone,faLock,faWrench,faCircleCheck,faClock,faComment,faEye,faBullhorn,faMinusCircle,faCaretDown,faFilePen);

const getThemeColor = async () => {
    const response = await axios.get('/api/settings?key=theme_color');

    if(response.data.status != 200){
        console.log(response.data.message);
    }

    localStorage.setItem('themeColor',response.data.data[0].value);
    return themeColor;
}

//theme color
const themeColor = localStorage.getItem('themeColor') ?? getThemeColor();


createInertiaApp({
  resolve: name => {
    const pages = import.meta.glob('./Pages/**/*.vue', { eager: true })
    return pages[`./Pages/${name}.vue`]
  },
  setup({ el, App, props, plugin }) {
    const app = createApp({ render: () => h(App, props) });
      app.use(plugin);
      app.component('Link', Link)
      app.config.globalProperties.$themeColor = "#980E0E";
      app.provide('baseUrl','https://lovecar.autos/api');
      app.component("font-awesome-icon", FontAwesomeIcon);
      app.use(vuetify);
      app.use(Toast);
      app.mount(el);
  },
})
