import Vue from 'vue';
import Router from "vue-router";
import CompanyComponent from "./components/CompanyComponent.vue";
import RatingListComponent from "./components/RatingListComponent.vue";

Vue.use(Router);

export default new Router({
    // mode: 'history',
    routes: [
        {
            path: '/',
            name: 'home',
            component: RatingListComponent,
        },
        {
            path: '/company/:id',
            name: 'company',
            component: CompanyComponent,
            props: true
        },
    ]
});
