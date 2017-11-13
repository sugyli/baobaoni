window._ = require('lodash');
try {
    window.$ = window.jQuery = require('jquery');
} catch (e) {}
window.axios = require('axios');
/*
x-requested-with  XMLHttpRequest是Ajax 异步请求方式

使用
request.getHeader("x-requested-with");
 为 null，则为传统同步请求；
为 XMLHttpRequest，则为 Ajax 异步请求。
*/

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
window.Vue = require('vue');
