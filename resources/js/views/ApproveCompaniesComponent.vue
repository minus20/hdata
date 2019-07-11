<template>
    <div>
        <a href="#" @click="$router.go(-1)" class="btn btn-secondary mb-3">Назад</a>
        <success-component v-bind:message="message" v-if="message"></success-component>
        <div v-if="companies.length">
            <div v-for="company in companies" class="rating-company row">
                <div class="col-8">
                    <router-link v-if="company.approved === 0" :to="{name: 'company', params: {id: company.id}}" >
                        {{ company.name }}
                    </router-link>
                </div>
                <div class="col-4">
                    <button class="btn btn-secondary float-right ml-3" @click.stop="approveCompany(company.id); return false;">
                        Одобрить
                    </button>
                    <button class="btn btn-danger float-right" @click="deleteCompany(company.id)">
                        Удалить
                    </button>
                </div>
            </div>
        </div>
        <div v-else class="lead p-3">
            Нет заявок для рассмотрения
        </div>
        <div class="color-block"></div>
        <div class="p-3">
            <p class="lead">
                В рамках эксперимента по организации сетевого производства жилища проводится анализ рынка.
            </p>
            <p class="lead">
                Создание единой базы компаний по жилищу, которая позволит людям понять какие компании хороши, а к каким не стоит обращаться.
            </p>
        </div>
    </div>
</template>

<script>
    import SuccessComponent from "../components/SuccessComponent";
    export default {
        components: {SuccessComponent},
        data() {
            return {
                message: ''
            }
        },
        computed: {
            companies() {
                return this.$store.state.companies.filter(company => company.approved === 0);
            },
        },
        methods: {
            approveCompany(id) {
                this.message = '';
                this.$store.dispatch('approveCompany', {id: id}).then(() => {
                    this.message = 'Компания одобрена';
                })
            },
            deleteCompany(id) {
                this.message = '';
                if (confirm('Вы действительно хотите удалить эту компанию?')) {
                    this.$store.dispatch('deleteCompany', {id: id}).then(() => {
                        this.message = 'Компания удалена';
                    })
                }
                return false;
            }
        },
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
