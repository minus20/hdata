<template>
    <div>
        <div v-if="company">
            {{ company.name }}
            <span class="float-right">
                {{ company.average_rating }}
            </span>
        </div>
        <div v-if="reviews">
            <review v-for="review in reviews" :review="review" :key="review.id">
            </review>
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
            }
        },
    }
</script>

<style scoped>

</style>
