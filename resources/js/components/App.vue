<template>
    <div class="container">
        <h1><router-link :to="{name: 'home'}">{{ title }}</router-link></h1>
        <router-view></router-view>
    </div>
</template>

<script>
    export default {
        name: "App.vue",
        data() {
            return {
                title: 'H-Data'
            }
        },
        created() {
            this.$store.dispatch('getCompanies');
            this.$store.dispatch('getReviews');
            this.$store.dispatch('getUsers');
        }
    }
</script>

<style scoped>

</style>
