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
            name: ''
        }
    },
    mutations,
    actions,
    getters: {
        loggedIn: state =>  {
            return !!state.profile.name;
        },
        companyAvgRating: state => id => {
            if (state.reviews.length && state.companies.length) {
                let relatedReviews = state.reviews.filter((review => {
                    return (review.company_id === id);
                }));
                if (relatedReviews.length < 0) {
                    let summaryRating = relatedReviews.reduce(function (accumulator, review) {
                        return accumulator + parseFloat(review.rating);
                    }, .0);
                    return (summaryRating / relatedReviews.length).toFixed(1);
                } else {
                    return null;
                }
            }
        }
    }
});
