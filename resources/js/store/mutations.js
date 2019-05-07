export default {
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
}
