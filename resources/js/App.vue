<template>
    <div class="container">
        <div class="row">
            <div class="offset-md-2 col-md-8">
                <div class="row">
                    <div class="col-4">
                        <h1>
                            <router-link to="/">
                                <img src="images/logo.png" alt="H-Data" class="img-fluid">
                            </router-link>
                        </h1>
                    </div>
                    <div v-if="typeof profile === 'undefined' || !profile.name" class="col-8 text-right pt-4">
                        <router-link to="/login" class="btn btn-lg btn-secondary">
                            Войти
                        </router-link>
                        <router-link to="/register" class="btn btn-lg btn-secondary">
                            Зарегистрироваться
                        </router-link>
                    </div>
                    <div v-else class="col-8 text-right pt-4">
                        <span class="lead">{{ profile.name }}</span>
                        <button class="btn btn-lg btn-secondary" v-on:click="signOut">
                            Выйти
                        </button>
                    </div>
                </div>
                <div class="home-anchor">
                    <router-view></router-view>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import Vue from 'vue';
    import Loading from 'vue-loading-overlay';
    import 'vue-loading-overlay/dist/vue-loading.css';

    Vue.use(Loading);

    export default {
        computed: {
            profile() {
                return this.$store.state.profile
            }
        },
        created() {
            let loader = this.$loading.show({
                // Optional parameters
                container: this.fullPage ? null : this.$refs.formContainer,
                canCancel: true,
                onCancel: this.onCancel,
                backgroundColor: '#ffffff',
                opacity: 1,
            });
            // загрузить данные с сервера
            this.$store.dispatch('loadCompanies').then(() => setTimeout(loader.hide,2000));
            this.$store.dispatch('loadReviews');
            this.$store.dispatch('loadUsers');
            this.$store.dispatch('tryToLoadLocalProfile');
        },
        mounted() {
        },
        methods: {
            signOut() {
                this.$store.dispatch('signOut')
            }
        }
    }
</script>

<style scoped>
    .home-anchor {
        position: relative;
    }
    .home-anchor:before {
        background: url(/images/home.png);
        background-size: cover;
        content: '';
        position: absolute;
        top: -70px;
        left: -117px;
        width: 150px;
        height: 150px;
        z-index: -1;
    }
</style>
