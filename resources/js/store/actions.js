import Axios from "axios";
import Hdata from "../api/hdata";

const api = 'http://127.0.0.1:8000/api/';
export default {
    loadCompanies() {
        Hdata.getCompanies().then(companies => {
            this.commit({type: 'setCompanies', companies});
        });
    },
    setCompanies(companies) {
        this.commit({type: 'setCompanies', companies});
    },
    loadUsers() {
        Hdata.getUsers().then(users => {
            this.commit({'type': 'setUsers', users})
        })
    },
    loadReviews() {
        Hdata.getReviews().then((reviews) => {
            this.commit({'type': 'setReviews', reviews})
        })
    },
    signIn(commit, payload) {
        Hdata.signIn(payload.email, payload.password).then(user => {
            this.commit({'type': 'setProfile', 'profile': user});
            localStorage.setItem('hdata-profile', JSON.stringify(this.state.profile));
        });
    },
    signOut() {
        Hdata.signOut(this.state.profile.api_token);
        localStorage.removeItem('hdata-profile');
        this.commit('unsetProfile')
    },
    register(commit, payload) {
        Hdata.register(payload).then( user =>
            this.commit({'type': 'setProfile', 'profile': user})
        )
    },
    addCompany(commit, payload) {
        Hdata.addCompany(payload, this.state.profile.api_token).then(() => {
            this.dispatch('loadCompanies');
        })
    },
    addReview(commit, payload) {
        Hdata.addReview(payload).then(() => {
            this.dispatch('loadReviews');
        })
    },
    tryToLoadLocalProfile() {
        const storageProfile = localStorage.getItem('hdata-profile')
        if (storageProfile) {
            this.commit('loadLocalProfile', JSON.parse(storageProfile));
        }
    },
}
