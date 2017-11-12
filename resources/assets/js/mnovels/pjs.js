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
        //开启Vue
        self.vuefun();
        //self.myAd();
    },
    vuefun:function(){


          //var offset = $($('.Swipe-tab').find('a')[0]).offset();
          //var index_header_tab_width = offset.width;
          //var index_header_tab_width = $($('.Swipe-tab').find('a')[0]).width();
          window.VM =  new Vue({
                    	  el:'#app',
                    	  data:{
                          screen_width:Util.windowWidth,
                          screen_height:Util.windowHeight,
                    	  },
                        components: {
                        },
                    	  methods:{
                          tuijian(bid){
                              bid = Number(bid);
                              var self = this;
                              self.$loading('推荐请求中...');
                              axios.post(Config.recommendurl, {
                                    bid: bid,
                                })
                                .then(function (response) {
                                  //console.log(response);
                                  self.$loading.close();
                                  //console.log(response);
                                  if(response.data.message){
                                    setTimeout(function () {
                                        self.$toast.center(response.data.message);
                                    }, 500);

                                  }else{
                                    console.log(response);
                                    setTimeout(function () {
                                        self.$toast.center('返回数据出错了');
                                    }, 500);
                                  }

                                })
                                .catch(function (response) {
                                    self.$loading.close();
                                    console.log(response);
                                    setTimeout(function () {
                                        self.$toast.center('网络故障稍后再试');
                                    }, 500);
                                });
                            },

                            addbookcase(bid ,cid){
                                bid = Number(bid);
                                cid = Number(cid);
                                var self = this;
                                self.$loading('收藏请求中...');
                                axios.post(Config.addbookcaseurl, {
                                      bid: bid,
                                      cid: cid,
                                  })
                                  .then(function (response) {
                                    self.$loading.close();
                                    if(response.data.message){
                                      setTimeout(function () {
                                          self.$toast.center(response.data.message);
                                      }, 500);

                                    }else{
                                      console.log(response);
                                      setTimeout(function () {
                                          self.$toast.center('返回数据出错了');
                                      }, 500);

                                    }

                                  })
                                  .catch(function (response) {
                                      self.$loading.close();
                                      console.log(response);
                                      setTimeout(function () {
                                          self.$toast.center('网络故障稍后再试');
                                      }, 500);

                                  });

                              },
                              yudu(bid ,cid){
                                var pageItem = Util.StorageGetter('muluobj_'+bid);
                                if(pageItem){
                                   cid = pageItem.cid;
                                }
                                location.href= '/wapbook-'+ bid+ '-' + cid;

                              }
                        },
                    });

      },
      readApi: function(bid , page ,weizhi,cid , bookName){
        //统计浏览记录
        var str = $.cookie("hislogs");
        var jos = {'url':window.location.href,'bookName':bookName};
        var hislogs = new Array();
        if (str !=null){
            hislogs = JSON.parse(str);
            $.each(hislogs, function(i,val){
              if (val.url == window.location.href) {
                  hislogs.splice(eval(i),1);
                  return false;
                }else if(val.bookName == bookName) {
                  hislogs.splice(eval(i),1);
                  return false;
                }
            });
        }
        var arrylength = (hislogs.length -1);
        if (arrylength < 100) {
            hislogs.push(jos);
            var str = JSON.stringify(hislogs);
            $.cookie('hislogs',str,{expires:365 , path:'/'});

        }else{
            hislogs.splice(0,1);
            hislogs.push(jos);
            var str = JSON.stringify(hislogs);
            $.cookie('hislogs',str,{expires:365 , path:'/'});
        }


        var Dom = {
            night_icon: $('#night_icon'),
            day_icon: $('#day_icon'),
            bk_container_current: $('.bk-container-current'),
            bk_container: $('.bk-container'),
        };

          var Win = $(window);
          //本地存储字体大小
          var RootContainer = $('#fiction_container');

          var initFontSize = Util.StorageGetter('font_size');
          initFontSize = parseInt(initFontSize);
          if (!initFontSize) {
              initFontSize = 14;
          }
          RootContainer.css('font-size', initFontSize);

          //本地存储背景颜色
          var Body = $('body');
          var initBackground = Util.StorageGetter('background');
          if (!initBackground) {
              initBackground = '#f7eee5';
          }
          if (initBackground == '#283548') {
              $('#night_icon').show();
          } else {
              $('#day_icon').show();
          }
          //显示背景
          $('[data-background="' + initBackground + '"]').children('.bk-container-current').css('display', 'block');
          VM.$refs.appBox.style.background = initBackground;

          //记录位置
          var key = 'muluobj_' + bid;
          var obj = {'page':page,'weizhi':weizhi ,'cid':cid}
          Util.StorageSetter(key, obj);


          /*todo 入口函数*/
          function main() {
            /*
              readerModel = ReaderModel();
              readerUI = ReaderBaseFrame(RootContainer);
              readerModel.init(function (data) {
                  readerUI(data);
              });
              */
              EventHanlder();
          }
          /*todo 交互的事件绑定*/
          function EventHanlder() {
            $('#large-font').click(function () {
                  if (initFontSize > 20) {
                      VM.$toast.center('字号不能更大了！');
                      return;
                  }
                  initFontSize += 1;
                  RootContainer.css('font-size', initFontSize);
                  Util.StorageSetter('font_size', initFontSize);

            });
            $('#small-font').click(function () {
                if (initFontSize < 12) {
                    VM.$toast.center('字号不能更小了！');
                    return;
                }
                initFontSize -= 1;
                RootContainer.css('font-size', initFontSize);
                Util.StorageSetter('font_size', initFontSize);
            });
            $('#beijing-bnt').click(function () {
              if ($('#beijing_container').css('display') == 'none') {
                  $('#beijing_container').show();
              }else{
                  $('#beijing_container').hide();
              }
            });

            $('#night-day-button').click(function () {
                //todo 触发背景切换事件
                if (Dom.day_icon.css('display') == 'none') {
                    //黑变白
                    Dom.day_icon.show();
                    Dom.night_icon.hide();
                    Dom.bk_container_current.css('display', 'none');
                    $('#first_day').children('.bk-container-current').css('display', 'block');
                    initBackground = '#f7eee5';
                    //Body.css('background', initBackground);
                    VM.$refs.appBox.style.background = initBackground;
                    Util.StorageSetter('background', initBackground);
                } else {
                    //白变黑
                    Dom.day_icon.hide();
                    Dom.night_icon.show();
                    Dom.bk_container_current.css('display', 'none');
                    $('#last_night').children('.bk-container-current').css('display', 'block');
                    initBackground = '#283548';
                    //Body.css('background', initBackground);
                    VM.$refs.appBox.style.background = initBackground;
                    Util.StorageSetter('background', initBackground);
                }
            });

            Dom.bk_container.click(function () {
                if ($(this).children('.bk-container-current').css('display') == 'none') {
                    Dom.bk_container_current.css('display', 'none');
                    $(this).children('.bk-container-current').css('display', 'block');
                    initBackground = $(this).attr('data-background');
                    //Body.css('background', initBackground);
                    VM.$refs.appBox.style.background = initBackground;
                    Util.StorageSetter('background', initBackground);
                    if (initBackground == '#283548') {
                        $('#night_icon').show();
                        $('#day_icon').hide();
                    } else {
                        $('#night_icon').hide();
                        $('#day_icon').show();
                    }
                }
            });

            Win.scroll(function () {
              $('#beijing_container').hide();
            });

          }

          main();//调用入口函数

      },

  }

  window.baobaoni = baobaoni;
  baobaoni.init();
})()//闭包不影响全局
