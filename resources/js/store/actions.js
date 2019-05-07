import Axios from "axios";
import Hdata from "../api/hdata";

const api = 'http://127.0.0.1:8000/api/';
export default {
    getCompanies() {
        Hdata.getCompanies().then(companies => {
            this.commit({type: 'setCompanies', companies});
        });
    },
    getUsers() {
        Hdata.getUsers().then(users => {
            this.commit({'type': 'setUsers', users})
        })
    },
    getReviews() {
        Hdata.getReviews().then((reviews) => {
            this.commit({'type': 'setReviews', reviews})
        })
    },
    signIn(commit, payload) {
        Hdata.signIn(payload.email, payload.password).then(user => {
            this.commit({'type': 'setProfile', 'profile': user});
            localStorage.setItem('hdata-profile', JSON.stringify(this.state.profile));
        })
    },
    signOut() {
        Hdata.signOut(this.state.profile.api_token);
        this.commit('unsetProfile')
    },
    register(commit, payload) {
        Hdata.register().then( user =>
            this.commit({'type': 'setProfile', 'profile': user})
        )
    },
    addCompany(commit, payload) {
        Hdata.addCompany(payload, this.state.profile.api_token).then(() => {
            this.dispatch('getCompanies');
        })
    },
    addReview(commit, payload) {
        Hdata.addReview(payload).then(() => {
            this.dispatch('getReviews');
        })
    },
    tryToLoadLocalProfile() {
        const storageProfile = localStorage.getItem('hdata-profile')
        if (storageProfile) {
            this.commit('loadLocalProfile', JSON.parse(storageProfile));
        }
    }
}
