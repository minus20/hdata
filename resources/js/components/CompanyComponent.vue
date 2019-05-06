<template>
    <div class="card">
        <div class="card-header" v-if="company">
            <h2>
                <span class="float-right">
                    <small>
                        {{ reviews.length }} rates
                    </small>
                    <span v-if="reviews" class="badge badge-info">
                        {{ averageRating() }}/5
                    </span>
                </span>
                {{ company.name }}
            </h2>
        </div>
        <div class="card-header" v-else>
            Loading...
        </div>
        <div class="card-body">
            <company-review
                v-for="review in reviews"
                :key="review.id"
                v-bind:review="review"
            ></company-review>
        </div>
        <div v-if="signedIn">
            <button v-on:click="showForm = !showForm">Write review</button>
            <form v-if="showForm" v-on:submit.prevent="newReview">
                {{ rating }}<br>

                <input type="range" min="1" max="5" step="1" v-model="rating"><br>
                <textarea v-model="comment"></textarea><br>
                <button class="btn">Отправить</button>
            </form>
        </div>
    </div>
</template>

<script>
    import {mapGetters} from "vuex";
    import store from '../store';
    import CompanyReview from "./CompanyReview";

    export default {
        name: "CompanyComponent",
        components: {CompanyReview},
        data() {
            return {
                showForm: false,
                rating: 1,
                comment: ''
            }
        },
        computed: {
            ...mapGetters([
                "getCompany",
                'signedIn'
            ]),
            company() {
                return store.state.companies.find(com => com['id'] == this.$route.params.id);
            },
            reviews() {
                return store.state.reviews.filter(rew => rew['company_id'] == this.$route.params.id);
            },
        },
        methods: {
            averageRating() {
                if (this.reviews.length > 0) {
                    let sum = this.reviews.reduce((sum, el) => sum + el.rating, 0);
                    return (sum / this.reviews.length).toFixed(1);
                } else {
                    return '-';
                }
            },
            newReview() {
                this.$store.dispatch('addReview', {
                    rating: this.rating,
                    comment: this.comment,
                    'company_id': this.company.id
                })
            }
        }
    }
</script>

<style scoped>

</style>
