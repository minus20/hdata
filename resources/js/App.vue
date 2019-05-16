<template>
    <div class="container">
        <div class="row">
            <div class="col-4">
                <h1>
                    <router-link to="/">
                    <img src="images/logo.png" alt="H-Data" class="img-fluid">
                    </router-link>
                </h1>
            </div>
            <div v-if="!profile.name" class="col-8 text-right pt-4">
                <router-link to="/login" class="btn btn-primary">
                    Войти
                </router-link>
            </div>
            <div v-else class="col-8 text-right pt-4">
                {{ profile.name }}
                <button class="btn btn-primary" v-on:click="signOut">
                    Выйти
                </button>
            </div>
        </div>
        <div class="home-anchor">
            <router-view></router-view>
        </div>
    </div>
</template>

<script>
    export default {
        computed: {
            profile() {
                return this.$store.state.profile
            }
        },
        mounted() {
            // загрузить данные с сервера
            this.$store.dispatch('loadCompanies');
            this.$store.dispatch('loadReviews');
            this.$store.dispatch('loadUsers');
            this.$store.dispatch('tryToLoadLocalProfile');
        },
        methods: {
            signOut() {
                this.$store.dispatch('signOut')
            }
        }
    }
</script>

<style scoped>
</style>
