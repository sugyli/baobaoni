(function () {
  var baobaoni = {
      init: function(){
          var self = this;
          //第一次先清理下缓存
          var first_del_v = Util.StorageGetter('first_del_v2');
          if(!first_del_v){
              Util.StorageDelAll();
              Util.StorageSetter('first_del_v2',1);
          }
          //初始化一些数据
          $("#app ,#root , #reader").width(Util.windowWidth);
          if(document.getElementById("reader")){
              document.getElementById("reader").style.minHeight= Util.windowHeight + "px";
          }

      },
  }

  window.baobaoni = baobaoni;
  baobaoni.init();
})()//闭包不影响全局
