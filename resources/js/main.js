import Vue from 'vue';
import App from './App';
import router from './router';
import store from './store';
import VueAxios from 'vue-axios';
import VueSocialauth from 'vue-social-auth';
import axios from 'axios';


Vue.component('app', App);

Vue.use(VueAxios, axios);
Vue.use(VueSocialauth, {
    providers: {
        vkontakte: {
            clientId: '7000247',
            redirectUri: 'http://mmaw.vologda-uni.ru',
            oauthType: '2.0',

            // name: 'facebook',
            // url: '/auth/vkontakte',
            authorizationEndpoint: 'https://oauth.vk.com/authorize',
            // requiredUrlParams: ['display', 'scope'],
            // scope: ['email'],
            // scopeDelimiter: ',',
            // display: 'popup',
            // popupOptions: { width: 580, height: 400 }
        },
        odnoklassniki: {
            clientId: '1279684352',
            redirectUri: 'http://mmaw.vologda-uni.ru',
            oauthType: '2.0',

            // name: 'facebook',
            // url: '/auth/vkontakte',
            authorizationEndpoint: 'https://connect.ok.ru/oauth/authorize',
            // requiredUrlParams: ['display', 'scope'],
            // scope: ['email'],
            // scopeDelimiter: ',',
            // display: 'popup',
            // popupOptions: { width: 580, height: 400 }
        }
    }
});

new Vue({
    router: router,
    store: store,
    render: (h) => h(App),
}).$mount('#app');
