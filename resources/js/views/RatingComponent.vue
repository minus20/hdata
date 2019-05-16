<template>
    <div>
        <div v-if="companies.length">
            <div v-for="company in companies" class="rating-company">
                <router-link :to="{name: 'company', params: {id: company.id}}" >
                    {{ company.name }}
                    <span class="float-right rating-number" v-if="company">
                        {{ getRating(company) }}
                    </span>
                </router-link>
            </div>
        </div>
        <div class="mb-4 text-right" v-if="loggedIn">
            <router-link to="/company/new" class="btn btn-secondary btn-lg">Заявка на добавление</router-link>
        </div>
        <div class="color-block"></div>
        <div class="p-3">
            <p class="lead">
                В рамках эксперимента по организации сетевого производства жилища проводится анализ рынка.
            </p>
            <p class="lead">
                Создание единой базы компаний по жилищу, которая позволит людям понять какие компании хорошо, а к каким не стоит обращаться.
            </p>
        </div>
    </div>
</template>

<script>
    export default {
        computed: {
            companies() {
                return this.$store.state.companies;
            },
            loggedIn() {
                return this.$store.getters.loggedIn
            }
        },
        methods: {
            getRating(company) {
                if (company.average_rating) {
                    return parseFloat(company.average_rating).toFixed(1);
                } else {
                    return '-';
                }
            }
        }
    }
</script>

<style scoped>
    .rating-company a {
        display: block;
        padding: 5px 30px;
        color: darkgrey;
        font-size: 1.5rem
    }
    .rating-company a:hover {
        background: linear-gradient(to right, #c8c8c8, #ffffff);
        color: white;
        text-decoration: none;
    }
    .rating-number {
        color: darkorange;
    }
    .color-block {
        height: 50px;
        background: #c8c8c8;
        clear: both;
        margin-bottom: 30px;
    }
    p {
        color: darkgrey;
    }
</style>
