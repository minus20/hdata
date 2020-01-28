import Vuex from "vuex";
import Vue from 'vue';
import mutations from './mutations';
import actions from './actions';

Vue.use(Vuex);
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
        isAdmin: state => {
            return !!state.profile.name && state.profile.role === 'admin';
        },
    }
});
