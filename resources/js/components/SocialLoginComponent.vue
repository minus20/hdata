<template>
    <div>
        <button @click="AuthProvider('vkontakte')" class="btn btn-light"><img src="images/vk.svg" alt="VK" style="width: 32px"></button>
        <button @click="AuthProvider('odnoklassniki')" class="btn btn-light"><img src="images/odnoklassniki.svg" alt="Odnoklassniki" style="width: 32px"></button>
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
                    this.$store.dispatch('setProfile', response.data).then(() => this.$router.push('/'));
                    this.$store.dispatch('loadUsers');
                }).catch(err => {
                    console.log({err:err})
                })
            },
        }
    }
</script>

<style scoped>
.btn-light {
    background-color: #e2e6ea;
}
</style>
