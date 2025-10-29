import "./bootstrap";
import "bootstrap/dist/js/bootstrap.min.js";
import "./library/smoothscroll.min.js";
import "animate.css";
import "/resources/style/app.scss";
import "/resources/style/responsive.css";

import VueAwesomePaginate from "vue-awesome-paginate";
import { createApp } from "vue";
import App from "./App.vue";
import localization from "./localization.js";
import router from "./router";
import { createPinia } from "pinia";
import piniaPersist from "pinia-plugin-persistedstate";

const app = createApp(App);
const pinia = createPinia();
app.use(pinia);

localization.fetchLocalizationData();

app.use(localization.i18n);
app.use(router);
pinia.use(piniaPersist);
app.use(VueAwesomePaginate);

// axios.interceptors.response.use(
//     (response) => response,
//     (error) => {
//         if (
//             error.response &&
//             (error.response.status === 403 || error.response.status === 404)
//         ) {
//             window.location.href = "/404";
//         }
//         return Promise.reject(error);
//     }
// );

app.mount("#app");

// SmoothScroll({
//     animationTime: 800,
//     stepSize: 75,
//     accelerationDelta: 30,
//     accelerationMax: 2,
//     keyboardSupport: true,
//     arrowScroll: 50,
//     pulseAlgorithm: true,
//     pulseScale: 4,
//     pulseNormalize: 1,
//     touchpadSupport: true,
//     fixedBackground: true,
// });
