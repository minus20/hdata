import Vuex from "vuex";
import Axios from "axios";
import Vue from 'vue';

Vue.use(Vuex);

export const store =  new Vuex.Store({
    strict: true,
    state: {
        companies: [],
        users: [],
        reviews: [{"id":1,"created_at":"2019-04-23 08:26:43","updated_at":"2019-04-23 08:26:43","user_id":2,"company_id":2,"rating":4,"comment":"Optio laboriosam quae sint et sit. Voluptatum et voluptate iusto ullam consectetur omnis ut quo. Maxime rem et ut eos officiis ipsum voluptas voluptatem."},{"id":2,"created_at":"2019-04-23 08:26:43","updated_at":"2019-04-23 08:26:43","user_id":1,"company_id":3,"rating":2,"comment":"Culpa sit est tempora quia enim. Et facilis iusto aut praesentium ratione debitis numquam. Occaecati cumque est et et rem doloremque facilis."},{"id":3,"created_at":"2019-04-23 08:26:43","updated_at":"2019-04-23 08:26:43","user_id":7,"company_id":3,"rating":4,"comment":"Cupiditate repellendus aut placeat quia sit provident. Et non fuga quas. Consequatur aut dolore pariatur odio hic in."},{"id":4,"created_at":"2019-04-23 08:26:43","updated_at":"2019-04-23 08:26:43","user_id":4,"company_id":6,"rating":5,"comment":"Est eligendi dignissimos quisquam earum aliquam corrupti. Id sunt placeat asperiores inventore. Modi qui quia amet totam. Et recusandae consequatur rerum quasi ab."},{"id":5,"created_at":"2019-04-23 08:26:43","updated_at":"2019-04-23 08:26:43","user_id":8,"company_id":10,"rating":2,"comment":"Consequatur dolor necessitatibus aut aut distinctio voluptatem eum. Dolorum ratione aut expedita."},{"id":6,"created_at":"2019-04-23 08:26:43","updated_at":"2019-04-23 08:26:43","user_id":2,"company_id":2,"rating":4,"comment":"Rerum nisi accusamus quos soluta vel. Et non voluptatum veniam consequuntur. Sequi ipsam perspiciatis vitae soluta voluptas cupiditate."},{"id":7,"created_at":"2019-04-23 08:26:43","updated_at":"2019-04-23 08:26:43","user_id":10,"company_id":6,"rating":4,"comment":"Et asperiores et ad sunt. Occaecati commodi perferendis libero magnam quam dicta quia. Est itaque at nesciunt vitae."},{"id":8,"created_at":"2019-04-23 08:26:43","updated_at":"2019-04-23 08:26:43","user_id":3,"company_id":9,"rating":5,"comment":"Praesentium similique ratione dolorum ullam aut quia perspiciatis. Non officiis aspernatur enim vitae. Ipsum voluptatem rem dolorum eligendi libero dolor."},{"id":9,"created_at":"2019-04-23 08:26:43","updated_at":"2019-04-23 08:26:43","user_id":10,"company_id":10,"rating":5,"comment":"Consequatur laudantium alias earum qui quo. Veritatis natus unde animi consequatur quidem. Totam unde recusandae tempore delectus. Ducimus corrupti et voluptatum dolorem aut."},{"id":10,"created_at":"2019-04-23 08:26:43","updated_at":"2019-04-23 08:26:43","user_id":2,"company_id":2,"rating":3,"comment":"Deleniti et distinctio qui soluta. Aliquam reiciendis nihil earum ipsam. Soluta esse ex nobis. Voluptas aut recusandae et ut hic aut. Nesciunt eum sit beatae est odit."},{"id":11,"created_at":"2019-04-23 08:26:43","updated_at":"2019-04-23 08:26:43","user_id":7,"company_id":10,"rating":3,"comment":"Nostrum autem repellendus nulla temporibus quasi doloremque qui. Et et tenetur et non. Aliquam ratione sequi consequatur qui."}],
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
    },
    actions: {
        getCompanies() {
            Axios.get('http://127.0.0.1:8000/api/companies').then(function (res) {
                store.commit({type: 'setCompanies', companies: res.data})
            })
        },
        getUsers() {
            Axios.get('http://127.0.0.1:8000/api/users').then(function (res) {
                store.commit({'type': 'setUsers', 'users': res.data})
            })
        },
        getReviews() {
            Axios.get('http://127.0.0.1:8000/api/reviews').then(function (res) {
                store.commit({'type': 'setReviews', 'reviews': res.data})
            })
        },
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
        }
    }
});
