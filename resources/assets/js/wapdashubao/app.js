require('../base');

var Util = (function () {
    //本地存储 加prefix区别
    var prefix = 'html5_'
    var StorageGetter = function (key) {
        return JSON.parse(localStorage.getItem(prefix + key));
    }
    var StorageSetter = function (key, val) {
        var val = JSON.stringify(val)
        return localStorage.setItem(prefix + key, val)
    }
    var StorageDel = function (key) {
        localStorage.removeItem(prefix + key);
    }
    var StorageDelAll = function () {
         localStorage.clear();
    }
    var windowWidth = $(window).width();
    if(windowWidth<320){
       windowWidth = 320;
    }
    var windowHeight =$(window).height();
    //暴露方法
    return {
        windowWidth: windowWidth,
        windowHeight: windowHeight,
        StorageGetter: StorageGetter,
        StorageSetter: StorageSetter,
        StorageDel: StorageDel,
        StorageDelAll: StorageDelAll
    }
})();
window.Util = Util;

import VueScroller from 'vue-scroller'
Vue.use(VueScroller)

import 'vue2-toast/lib/toast.css';
import Toast from 'vue2-toast';
Vue.use(Toast, {
    defaultType: 'center',
    duration: 2000,
    wordWrap: true,//换行
    width: 'auto'
});
import VuejsDialog from "vuejs-dialog"
Vue.use(VuejsDialog ,{
    html: false,
    loader: false,
    okText: '确认',
    cancelText: '取消',
    animation: 'bounce',
  }
);


Vue.component('scroll-mulu', require('./components/mulu.vue'));
Vue.component('scroll-shujia', require('./components/scroll-shujia.vue'));
Vue.component('scroll-search', require('./components/scroll-search.vue'));
//Vue.component('mheader', require('./components/mheader.vue'));

//Vue.component('scroll-search', require('./components/scroll-search.vue'));
//Vue.component('scroll-mulu', require('./components/scroll-mulu.vue'));
//Vue.component('user-report', require('./components/user-report.vue'));
//Vue.component('scroll-shujia', require('./components/scroll-shujia.vue'));



//Vue.component('rotate-loade', require('vue-spinner/src/RotateLoader.vue'));


require('./pjs');
