require('./bootstrap');
import store from './store';
import VueLoading from 'vuejs-loading-plugin'

window.Vue = require('vue').default;

import Vuelidate from 'vuelidate'
Vue.use(Vuelidate)
// using default options
Vue.use(VueLoading)

Vue.component('Formstep', require('./components/modal/Formstep.vue').default);
Vue.component('Buy', require('./components/modal/Buy.vue').default);
Vue.component('Login', require('./components/modal/Login.vue').default);
Vue.component('Register', require('./components/modal/Register.vue').default);

Vue.component('Workout', require('./components/workout/Workout.vue').default);
Vue.component('Home', require('./components/home/Home.vue').default);
Vue.component('Diet', require('./components/diet/Diet.vue').default);
Vue.component('Plugin', require('./components/plugin/Plugin.vue').default);
Vue.component('Questions', require('./components/questions/Questions.vue').default);
Vue.component('Question', require('./components/questions/Question.vue').default);


const app = new Vue({
    el: '#app',
    store
});


