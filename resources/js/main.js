import Vue from 'vue';
import App from './App';
import router from './router';
import store from './store'

Vue.component('app', App);

new Vue({
    router: router,
    store: store,
    render: (h) => h(App),
}).$mount('#app');
