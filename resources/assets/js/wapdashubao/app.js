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
import VueScroller from 'vue-scroller'
Vue.use(VueScroller)

Vue.component('search-view', require('./components/Search.vue'));



require('./pjs');
