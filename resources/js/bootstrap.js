window._ = require('lodash');

try {
    window.Popper = require('popper.js').default;
    window.$ = window.jQuery = require('jquery');

    require('bootstrap');
} catch (e) {}

window.axios = require('axios');

window.userInfo = document.head.querySelector('meta[name="userInfo"]');
if(window.userInfo!=null){
    window.userInfo = window.userInfo.content;
}

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
