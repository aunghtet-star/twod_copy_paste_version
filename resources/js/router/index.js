import {createRouter,createWebHistory} from "vue-router";
import NormalTwo from "../component/NormalTwo.vue";
import BrakeNumber from "../component/BrakeAmount.vue";

//pages


const routes = [
    //pages
    {
        path : '/',
        component : NormalTwo,
        name : 'home'
    },

    {
        path : '/brake',
        component : BrakeNumber,
        name : 'brake_number'
    },

    //not found

    // {
    //     path : '/:pathMatch(.*)*',
    //     component : notFound,
    //     name : 'notFound'
    // },

]

const router = createRouter({
    history : createWebHistory(),
    routes
})



export default router;
