import Axios from "axios";

export default {
    path: 'http://127.0.0.1:8000/api/',
    async getCompanies() {
        return Axios.get(this.path + 'companies').then((response) => {
            return response.data;
        })
    },
    async getUsers() {
        return Axios.get(this.path + 'users').then((response) => {
            return response.data
        })
    },
    async getReviews() {
        return Axios.get(this.path + 'reviews').then((response) => {
            return response.data
        })
    },
    async signIn(email, password) {
        return Axios.post(this.path + 'login', {email, password}).then((response) => {
            return response.data.data
        })
    },
    /**
     *
     * @param apiToken of user
     */
    signOut(apiToken) {
        Axios.post(this.path + 'logout', null, {
            headers: {
                'Authorization': 'Bearer ' + apiToken
            }
        })
    },
    /**
     * User object:
     * {
     *     email,
     *     name,
     *     password,
     *     password_confirmation
     * }
     * @param user Object
     */
    async register(user) {
        return Axios.post(this.path + 'register', user).then((response) => {
            return response.data.data
        });
    },
    async addCompany(company, apiToken) {
        return Axios.post( this.path + 'companies', company,{
            headers: {
                'Authorization': 'Bearer ' + apiToken
            }
        });
    },

    /**
     * @param review
     *  {
     *      company_id: Number,
     *      rating: 1..5,
     *      comment: String
     *  }
     *  @param apiToken String
     */
    async addReview(review, apiToken) {
        return  Axios.post(this.path + 'reviews', review, {
            headers: {
                'Authorization': 'Bearer ' + apiToken
            }
        });
    }
}
