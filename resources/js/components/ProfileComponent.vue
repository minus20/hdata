<template>
    <div>
        <div v-if="profile.name">
            {{ profile.name }}
            <button class="btn" v-on:click="signOut">Logout</button>
        </div>
        <div v-else>
            <button class="btn" v-on:click="showSignInForm = !showSignInForm">Sign In</button>
            <form v-if="showSignInForm"  v-on:submit.prevent="signIn">
                <input placeholder="E-mail" type="email" v-model="email" required><br>
                <input placeholder="Password" type="password" v-model="password" required><br>
                <button class="btn">Sign In</button>
            </form>

            <button class="btn" v-on:click="showRegisterForm = !showRegisterForm">Register</button>
            <form v-if="showRegisterForm" v-on:submit.prevent="register">
                <input placeholder="Name" type="text" v-model="name" required><br>
                <input placeholder="E-Mail" type="email" v-model="email" required><br>
                <input placeholder="Password" type="password" v-model="password" required><br>
                <input placeholder="Password Confirmation" type="password" v-model="passwordConfirmation" required><br>
                <button>Register</button>
            </form>
        </div>
    </div>
</template>

<script>
    export default {
        name: "ProfileComponent",
        data() {
            return {
                showSignInForm: false,
                showRegisterForm: false,
                name: '',
                email: '',
                password: '',
                passwordConfirmation: ''
            }
        },
        computed: {
            profile() {
                return this.$store.state.profile;
            }
        },
        methods: {
            signIn() {
                this.$store.dispatch('signIn', {
                    email: this.email,
                    password: this.password
                })
            },
            signOut() {
                this.$store.dispatch('signOut')
            },
            register() {
                this.$store.dispatch('register', {
                    name: this.name,
                    email: this.email,
                    password: this.password,
                    'password_confirmation': this.passwordConfirmation
                })
            }
        }
    }
</script>

<style scoped>

</style>
