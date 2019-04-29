<template>
    <div class="container">
        <div class="row">
            <div class="col-6">
                <h1><router-link :to="{name: 'home'}">{{ title }}</router-link></h1>
            </div>
            <div class="col-6">
                <profile></profile>
            </div>
        </div>
        <router-view></router-view>
    </div>
</template>

<script>
    import ProfileComponent from "./ProfileComponent";

    export default {
        name: "App.vue",
        components: {
          'profile': ProfileComponent
        },
        data() {
            return {
                title: 'H-Data'
            }
        },
        created() {
            // загрузить данные с сервера
            this.$store.dispatch('getCompanies');
            this.$store.dispatch('getReviews');
            this.$store.dispatch('getUsers');
            // попытаться загрузить сохраненный профиль
            this.$store.dispatch('tryToLoadLocalProfile');
        }
    }
</script>

<style scoped>

</style>
