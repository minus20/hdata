<template>
    <form v-on:submit.prevent="submit">
        <div class="form-group">
            <input
                type="text"
                placeholder="Имя"
                class="form-control form-control-lg"
                required
                v-model="name"
            >
        </div>
        <div class="form-group">
            <input
                    type="email"
                    placeholder="E-mail"
                    class="form-control form-control-lg"
                    required
                    v-model="email"
            >
        </div>
        <div class="form-group">
            <input
                    type="password"
                    placeholder="Пароль"
                    class="form-control form-control-lg"
                    required
                    v-model="password"
                    autocomplete="new-password"
            >
        </div>
        <div class="form-group">
            <input
                    type="password"
                    placeholder="Повторите пароль"
                    class="form-control form-control-lg"
                    required
                    v-model="password_confirmation"
                    autocomplete="new-password"
            >
        </div>
        <div class="mb-3">
            <button type="submit" class="btn btn-secondary btn-lg">
                Зарегистрироваться
            </button>
        </div>
        <social-login-component></social-login-component>
        <div v-if="errors.length > 0" class="alert alert-info">
            <div v-for="error in errors">
                {{ error }}
            </div>
        </div>
    </form>
</template>

<script>
    import SocialLoginComponent from "../components/SocialLoginComponent";
    export default {
        components: {SocialLoginComponent},
        data() {
            return {
                name: 'Иван',
                email: 'ivan@ivan.com',
                password: 'ivan',
                password_confirmation: 'ivan',
                errors: []
            }
        },
        methods: {
            submit() {
                this.errors = [];
                if (this.password_confirmation !== this.password) {
                    this.errors.push('Пароли не совпадают');
                    return;
                }
                if (this.password.length < 8) {
                    this.errors.push('Пароль должен быть минимум 8 символов');
                    return;
                }
                this.$store.dispatch('register', {
                    name: this.name,
                    email: this.email,
                    password: this.password,
                    password_confirmation: this.password_confirmation
                }).then(() => this.$router.push('/'));
            },
        }
    }
</script>

<style scoped>

</style>
