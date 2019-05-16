import Vue from 'vue';
import Router from "vue-router";
import RatingComponent from './views/RatingComponent';
import CompanyComponent from "./views/CompanyComponent";
import LoginComponent from "./views/LoginComponent";
import RegisterComponent from "./views/RegisterComponent";
import NewCompanyComponent from "./views/NewCompanyComponent";
import NewReviewComponent from "./views/NewReviewComponent";

Vue.use(Router);

export default new Router({
    // mode: 'history',
    routes: [
        {
            path: '/',
            name: 'home',
            component: RatingComponent,
        },
        {
            path: '/company/new',
            component: NewCompanyComponent,
        },
        {
            path: '/company/:id/review',
            name: 'newReview',
            component: NewReviewComponent,
        },
        {
            path: '/company/:id',
            name: 'company',
            component: CompanyComponent,
        },
        {
            path: '/login',
            component: LoginComponent
        },
        {
            path: '/register',
            component: RegisterComponent
        }
    ]
});
