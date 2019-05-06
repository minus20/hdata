import Vuex from "vuex";
import Axios from "axios";
import Vue from 'vue';

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
    mutations: {
        setCompanies(state, payload) {
          state.companies = payload.companies
        },
        setUsers(state, payload) {
            state.users = payload.users
        },
        setReviews(state, payload) {
            state.reviews = payload.reviews
        },
        setProfile(state, payload) {
            state.profile = payload.profile
        },
        unsetProfile(state) {
            state.profile = {};
        },
        loadLocalProfile(state, payload) {
            state.profile = payload;
        }
    },
    actions: {
        getCompanies() {
            Axios.get(api + 'companies').then((res) => {
                this.commit({type: 'setCompanies', companies: res.data})
            })
        },
        getUsers() {
            Axios.get(api + 'users').then((res) => {
                this.commit({'type': 'setUsers', 'users': res.data})
            })
        },
        getReviews() {
            Axios.get(api + 'reviews').then((res) => {
                this.commit({'type': 'setReviews', 'reviews': res.data})
            })
        },
        signIn(commit, payload) {
            Axios.post(api + 'login', {
                'email': payload.email,
                'password': payload.password
            }).then((res) => {
                this.commit({'type': 'setProfile', 'profile': res.data.data});
                localStorage.setItem('hdata-profile', JSON.stringify(this.state.profile));
            })
        },
        signOut() {
            this.commit('unsetProfile')
        },
        register(commit, payload) {
            Axios.post(api + 'register', payload).then((response) => {
                this.commit({'type': 'setProfile', 'profile': response.data.data})
            });
        },
        addCompany(commit, payload) {
            Axios.post( api + 'companies', {
                name: payload.name,
                'api_token': this.state.profile['api_token']
            });
            this.dispatch('getCompanies');
        },
        addReview(commit, payload) {
            Axios.post(api + 'reviews', {
                'api_token': this.state.profile['api_token'],
                'company_id': payload['company_id'],
                rating: payload.rating,
                comment: payload.comment
            });
            this.dispatch('getReviews');
        },
        tryToLoadLocalProfile() {
            const storageProfile = localStorage.getItem('hdata-profile')
            if (storageProfile) {
                this.commit('loadLocalProfile', JSON.parse(storageProfile));
            }
        }
    },
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
