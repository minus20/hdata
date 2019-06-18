<template>
    <div>
        <div class="row company-name"  v-if="company" >
            <div class="col-8">
                {{ company.name }}
            </div>
            <div class="col-4 text-right company-rating">
                <span class="color-orange">{{ getCompanyRating() }}</span>/5
            </div>
        </div>
        <div v-if="company" class="company-description">
            {{ company.description }}
        </div>
        <div v-if="reviews">
            <review v-for="review in reviews" :review="review" :key="review.id">
            </review>
        </div>
        <div v-if="company && loggedIn">
            <router-link :to="{name: 'newReview', params: {id: company.id}}" class="btn btn-secondary btn-lg">
                Написать отзыв
            </router-link>
        </div>
    </div>
</template>

<script>
    import ReviewComponent from "../components/ReviewComponent";

    export default {
        components: {
            review: ReviewComponent
        },
        computed: {
            company() {
                return this.$store.state.companies.find(company => {
                    return company.id == this.$route.params.id
                })
            },
            reviews() {
                return this.$store.state.reviews.filter(review => review.company_id == this.$route.params.id)
            },
            loggedIn() {
                return this.$store.getters.loggedIn
            }
        },
        methods: {
            getCompanyRating() {
                if (this.company.average_rating) {
                    return parseFloat(this.company.average_rating).toFixed(1);
                } else {
                    return '-';
                }
            }
        }
    }
</script>

<style scoped>
.company-name {
    color: darkgray;
    font-size: 2rem;
}
.company-description {
    color: darkgray;
    font-size: 1.2rem;
}
</style>
