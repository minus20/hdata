<template>
    <div class="card">
        <div class="card-header">
            <h2>{{ title }}</h2>
        </div>
        <div v-if="companies.length > 0">
            <div class="list-group">
                <rating-list-item
                    v-for="company in companies"
                    v-bind:key="company.id"
                    v-bind:id="company.id"
                    v-bind:name="company.name"
                ></rating-list-item>
            </div>
        </div>
    </div>
</template>

<script>
    import RatingListItemComponent from "./RatingListItemComponent";

    export default {
        name: "RatingListComponent",
        data() {
            return {
                'title': "Rating"
            }
        },
        components: {
            'rating-list-item': RatingListItemComponent,
        },
        computed: {
            companies() {
                return this.$store.state.companies
            },
        },
        // created() {
        //     this.$store.dispatch('getCompanies');
        //     this.$store.dispatch('getReviews');
        // }
    }
</script>

<style scoped>

</style>
