<template>
    <form v-on:submit.prevent="submit">
        <div class="form-group">
            <input
                    type="text"
                    required
                    placeholder="Логин"
                    class="form-control form-control-lg"
                    v-model="login"
                    autocomplete="username"
            >
        </div>
        <div class="form-group">
            <input
                type="password"
                placeholder="Пароль"
                class="form-control  form-control-lg"
                v-model="password"
                autocomplete="current-password"
                required
                minlength="8"
            >
        </div>
        <div class="mb-3">
            <button type="submit" class="btn btn-lg btn-secondary" v-bind:disabled="disabled">
                Войти
            </button>
            <router-link to="/register">
                Зарегистрироваться
            </router-link>
        </div>

        <error-component v-bind:error="error"></error-component>
        <social-login-component></social-login-component>
    </form>
</template>

<script>
    // import  from '../api/vkopenapi'
    import SocialLoginComponent from "../components/SocialLoginComponent";
    import ErrorComponent from "../components/ErrorComponent";
    export default {
        components: {ErrorComponent, SocialLoginComponent},
        data() {
            return {
                login: '',
                password: '',
                error: null,
                disabled: false
            }
        },
        methods: {
            submit() {
                this.disabled = true;
                this.error = null;
                this.$store.dispatch('signIn', {
                    login: this.login,
                    password: this.password,
                }).then(() => {
                    this.$router.push('/')
                }).catch(error => {
                    this.error = error.response.data;
                }).finally(() => {
                    this.disabled = false
                });
            }
        }
    }
</script>

<style scoped>

</style>
