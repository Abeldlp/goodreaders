require("./bootstrap");

// window.Vue = require('vue').default;
//
// /**
//  * The following block of code may be used to automatically register your
//  * Vue components. It will recursively scan this directory for the Vue
//  * components and automatically register them with their "basename".
//  *
//  * Eg. ./components/App.vue -> <example-component></example-component>
//  */
//
// //const app = document.getElementById('app')
//
// // const files = require.context('./', true, /\.vue$/i)
// // files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))
//
// Vue.component('app', require('./components/App.vue').default);
//
// const app = new Vue({
//     el: '#app',
// });

import Vue from "vue";
import VueRouter from "vue-router";

Vue.use(VueRouter);

import App from "./components/App";
import Home from "./views/Home.vue";
import CreateBook from "./views/CreateBook.vue";
import Endpoints from "./views/Endpoints.vue";
import BookDetails from "./views/BookDetails.vue";
import Login from "./views/Login.vue";
import EditDetails from "./views/EditDetails.vue";
import EditReviews from "./views/EditReviews.vue";

const router = new VueRouter({
    mode: "history",
    routes: [
        {
            path: "/",
            name: "main",
            component: Home
        },
        {
            path: "/create-new-book",
            name: "createbook",
            component: CreateBook
            //meta: { requiresAuth: true }
        },
        {
            path: "/login",
            name: "login",
            component: Login
        },
        {
            path: "/books/:id",
            name: "bookdetails",
            props: true,
            component: BookDetails
        },
        {
            path: "/edit-details/:id",
            name: "editdetails",
            props: true,
            component: EditDetails
        },
        {
            path: "/api/rating/:id ",
            name: "editreviews",
            props: true,
            component: EditReviews
        },
        {
            path: "/endpoints",
            name: "endpoints",
            component: Endpoints
        }
    ]
});

/*router.beforeEach((to, from, next) => {
    if (to.matched.some(record => record.meta.requiresAuth)) {
        if (!this.authUser) {
            next({
                path: "/login"
                query: { redirect: to.fullPath }
            });
        } else {
            next();
        }
    } else {
        next();
    }
});*/

const app = new Vue({
    el: "#app",
    components: { App },
    router
});
