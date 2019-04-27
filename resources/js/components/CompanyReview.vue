<template>
    <div class="card mb-3" v-if="review">
        <div v-if="user" class="card-header">
            {{ user.name }} published at <small class="badge badge-secondary">{{ review.created_at}}</small>
        </div>
        <div class="card-body">
            <span class="badge badge-info float-right">
                {{ review.rating }}
            </span>
            <p>
                {{ review.comment }}
            </p>
        </div>
    </div>
</template>

<script>
    export default {
        name: "CompanyReview",
        props: {
            review: Object
        },
        computed: {
            user() {
                return this.$store.state.users[this.review.id];
            }
        }
    }
</script>

<style scoped>

</style>
