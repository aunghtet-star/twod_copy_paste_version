import './bootstrap';

import {createApp} from "vue";
import App from "./App.vue";

// import 'bootstrap/dist/js/bootstrap.min'
import 'bootstrap/dist/js/bootstrap.bundle'



import router from "./router";

import Swal from 'sweetalert2/dist/sweetalert2'

import 'sweetalert2/dist/sweetalert2.css'

const toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,

})

window.Swal = Swal

window.toast = toast

createApp(App).use(router).mount('#app');
