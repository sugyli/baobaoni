window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

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
$(function(){
  
});
function tongji() {

   var _hmt = _hmt || [];
    (function() {
      var hm = document.createElement("script");
      hm.src = "https://hm.baidu.com/hm.js?c8af1f9ecc1a0fb3a3144adc03db1ca0";
      var s = document.getElementsByTagName("script")[0];
      s.parentNode.insertBefore(hm, s);
    })();

   //百度推送
   (function(){
      var bp = document.createElement('script');
      var curProtocol = window.location.protocol.split(':')[0];
      if (curProtocol === 'https') {
          bp.src = 'https://zz.bdstatic.com/linksubmit/push.js';
      }
      else {
          bp.src = 'http://push.zhanzhang.baidu.com/push.js';
      }
      var s = document.getElementsByTagName("script")[0];
      s.parentNode.insertBefore(bp, s);
  })();

}
