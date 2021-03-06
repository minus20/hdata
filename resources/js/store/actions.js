import Hdata from "../api/hdata";

export default {
    loadCompanies() {
        return Hdata.getCompanies().then(companies => {
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
        return Hdata.signIn(payload.login, payload.password).then(user => {
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
        return Hdata.addCompany(payload, this.state.profile.api_token).then(() => {
            this.dispatch('loadCompanies');
        })
    },
    /**
     * @param commit
     * @param payload
     *  {
     *      company_id: Number,
     *      rating: 1..5,
     *      comment: String
     *  }
     */
    addReview(commit, payload) {
        Hdata.addReview(payload, this.state.profile.api_token).then(() => {
            this.dispatch('loadReviews');
            this.dispatch('loadCompanies');
        })

    },
    tryToLoadLocalProfile() {
        const storageProfile = localStorage.getItem('hdata-profile');
        if (storageProfile) {
            this.commit({'type': 'setProfile', 'profile': JSON.parse(storageProfile)});
        }
    },
    setProfile(commit, payload) {
        this.commit({'type': 'setProfile', 'profile': payload});
        localStorage.setItem('hdata-profile', JSON.stringify(this.state.profile));
    },
    deleteCompany(commit, payload) {
        Hdata.deleteCompany(payload.id, this.state.profile.api_token).then(() => {
            this.dispatch('loadCompanies');
        });
    },
    deleteReview(commit, payload) {
        Hdata.deleteReview(payload.id, this.state.profile.api_token).then(() => {
            this.dispatch('loadCompanies');
            this.dispatch('loadReviews');
        })
    },
    approveCompany(commit, payload) {
        Hdata.approveCompany(payload.id, this.state.profile.api_token).then(() => {
            this.dispatch('loadCompanies');
        })
    }
}
