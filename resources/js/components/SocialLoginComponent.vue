<template>
    <div>
        <button @click="AuthProvider('vkontakte')" class="btn btn-lg btn-secondary">VK</button>
        <button @click="AuthProvider('odnoklassniki')" class="btn btn-lg btn-secondary">OK</button>
    </div>
</template>

<script>
    export default {
        name: "SocialLoginComponent",
        methods: {
            AuthProvider(provider) {

                var self = this;

                this.$auth.authenticate(provider).then(response =>{

                    self.SocialLogin(provider,response)

                }).catch(err => {
                    console.log({err:err})
                })

            },

            SocialLogin(provider,response){

                this.$http.post('/sociallogin/'+provider,response).then(response => {
                    console.log(response.data);
                    this.$store.dispatch('setProfile', response.data);

                }).catch(err => {
                    console.log({err:err})
                })
            },
        }
    }
</script>

<style scoped>

</style>
