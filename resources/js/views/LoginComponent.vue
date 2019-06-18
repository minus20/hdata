<template>
    <form v-on:submit.prevent="submit">
        <div class="form-group">
            <input
                    type="email"
                    required
                    placeholder="E-mail"
                    class="form-control"
                    v-model="email"
            >
        </div>
        <div class="form-group">
            <input
                type="password"
                required
                placeholder="Пароль"
                class="form-control"
                v-model="password"
            >
        </div>
        <div>
            <button type="submit" class="btn btn-primary">
                Войти
            </button>
            <router-link to="/register">
                Зарегистрироваться
            </router-link>
        </div>
    </form>
</template>

<script>
    // import  from '../api/vkopenapi'
    export default {
        data() {
            return {
                email: 'admin@admin.com',
                password: 'admin',
            }
        },
        methods: {
            submit() {
                this.$store.dispatch('signIn', {
                    email: this.email,
                    password: this.password,
                }).then(() => this.$router.push('/'));
            }
        }
    }
</script>

<style scoped>

</style>
