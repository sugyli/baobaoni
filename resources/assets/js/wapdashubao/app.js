require('../base');

var Util = (function () {
    //本地存储 加prefix区别
    var prefix = 'html5_'
    var StorageGetter = function (key) {
        return localStorage.getItem(prefix + key);
    }
    var StorageSetter = function (key, val) {
        return localStorage.setItem(prefix + key, val)
    }
    var StorageDel = function (key) {
        localStorage.removeItem(prefix + key);
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
    }
})();
window.Util = Util;
/*
import VueScroller from 'vue-scroller'
Vue.use(VueScroller)
*/
import 'vue2-toast/lib/toast.css';
import Toast from 'vue2-toast';
Vue.use(Toast, {
    defaultType: 'center',
    duration: 2000,
    wordWrap: false,//不允许换行
    width: 'auto'
});

Vue.component('scroll-search', require('./components/scroll-search.vue'));
Vue.component('scroll-mulu', require('./components/scroll-mulu.vue'));
Vue.component('rotate-loade', require('vue-spinner/src/RotateLoader.vue'));

require('./pjs');
