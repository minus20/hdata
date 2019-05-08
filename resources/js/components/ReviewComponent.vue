<template>
    <div v-if="review" class="mb-3">
        <div v-if="user">
            {{ user.name }}: {{ review.rating }}
        </div>
        <div>
            {{ review.comment }}
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            review: Object
        },
        computed: {
            user() {
                return this.$store.state.users.find(user => user.id == this.review.id)
            }
        }
    }
</script>

<style scoped>

</style>
