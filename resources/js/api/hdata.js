import Axios from "axios";

export default {
    path: 'http://mmaw.vologda-uni.ru/api/',
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
    async signIn(login, password) {
        return Axios.post(this.path + 'login', {login: login, password}).then((response) => {
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
        company.api_token = apiToken;
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
        review.api_token = apiToken;
        return  Axios.post(this.path + 'reviews', review, {
            headers: {
                'Authorization': 'Bearer ' + apiToken
            }
        });
    },

    deleteCompany(company, apiToken) {
        console.log(apiToken);
        return Axios.delete(this.path + 'companies/' + company, {
            headers: {
                'Authorization': 'Bearer ' + apiToken
            }
        })
    },

    deleteReview(review, apiToken) {
        console.log(apiToken);
        return Axios.delete(this.path + 'reviews/' + review, {
            headers: {
                'Authorization': 'Bearer ' + apiToken
            }
        })
    },

    approveCompany(company, apiToken) {
        let data = {
            id: company,
            approved: 1,
            api_token: apiToken
        };
        return Axios.put(this.path + 'companies/' + company, data, {
            headers: {
                'Authorization': 'Bearer ' + apiToken
            }
        })
    }
}
