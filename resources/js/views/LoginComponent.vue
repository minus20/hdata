<template>
    <form v-on:submit.prevent="submit">
        <div class="form-group">
            <input
                    type="text"
                    required
                    placeholder="Логин"
                    class="form-control form-control-lg"
                    v-model="login"
            >
        </div>
        <div class="form-group">
            <input
                type="password"
                required
                placeholder="Пароль"
                class="form-control  form-control-lg"
                v-model="password"
                autocomplete="current-password"
            >
        </div>
        <div class="mb-3">
            <button type="submit" class="btn btn-lg btn-secondary">
                Войти
            </button>
            <router-link to="/register">
                Зарегистрироваться
            </router-link>
        </div>
        <social-login-component></social-login-component>
    </form>
</template>

<script>
    // import  from '../api/vkopenapi'
    import SocialLoginComponent from "../components/SocialLoginComponent";
    export default {
        components: {SocialLoginComponent},
        data() {
            return {
                login: 'admin@admin.com',
                password: 'admin',
            }
        },
        methods: {
            submit() {
                this.$store.dispatch('signIn', {
                    login: this.login,
                    password: this.password,
                }).then(() => this.$router.push('/'));
            }
        }
    }
</script>

<style scoped>

</style>
