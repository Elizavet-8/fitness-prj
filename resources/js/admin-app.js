require('./bootstrap');
import store from './store';

window.Vue = require('vue').default;

import Vuelidate from 'vuelidate'
Vue.use(Vuelidate)

Vue.component('Todolistmenu', require('./components/admin/MenuOneEdit.vue').default);
Vue.component('Todolistinfo', require('./components/admin/TodoListInfo.vue').default);
Vue.component('Todolistvideo', require('./components/admin/TodoListVideo.vue').default);
Vue.component('Workouttodolist', require('./components/admin/WorkoutOneEdit.vue').default);

Vue.component('Addtodolistmenu', require('./components/admin/add/MenuOneEdit.vue').default);
Vue.component('Addtodolistinfo', require('./components/admin/add/TodoListInfo.vue').default);

const app = new Vue({
    el: '#app',
    store
});
