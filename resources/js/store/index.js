import Vuex from "vuex";
import Vue from 'vue';
import mutations from './mutations';
import actions from './actions';

Vue.use(Vuex);
const api = 'http://127.0.0.1:8000/api/';
export default new Vuex.Store({
    strict: true,
    state: {
        companies: [],
        users: [],
        reviews: [],
        profile: {
            loggedIn: false,
            name: '',
            apiToken: '',
        }
    },
    mutations,
    actions,
    getters: {
        getCompanyRating: state => id => {
            let companyReviews = state.reviews.filter(review => review.company_id === id);
            if (companyReviews.length > 0) {
                let accumulator = 0;
                companyReviews.forEach(function (item) {
                    accumulator += parseInt(item.rating);
                });
                return (accumulator / companyReviews.length).toFixed(1);
                // return companyReviews.reduce((sum, review) => sum + review.rating);
            } else {
                return '-';
            }
        },
        getCompany: state => id => {
            if (state.companies === 0 ) {
                store.dispatch('getCompanies');
            }
            let company = store.state.companies;//.find((company) => company['id'] === id);
            console.log(company);
            return company;
        },
        signedIn: state => {
            return (state.profile.name);
        }
    }
});
