(function () {

  var baobaoni = {
    init: function(){
        var self = this;
        self.vuefun();
    },
    vuefun:function(){

          var windowWidth = Util.windowWidth;
          //var offset = $($('.Swipe-tab').find('a')[0]).offset();
          //var index_header_tab_width = offset.width;
          var index_header_tab_width = $($('.Swipe-tab').find('a')[0]).width();
          window.VM =  new Vue({
                    	  el:'#app',
                    	  data :{
                    	  	  screen_width:windowWidth,
                            double_screen_width:windowWidth*2,
                            screen_height:Util.windowHeight,
                            index_header_tab_width:index_header_tab_width,
                            header_duration:0,
                            header_position:0,
                            position:0,
                            tab_1_class:'Swipe-tab__on',
                            tab_2_class:'',
                            read_f:0,
                            read_e:0,
                    	  },
                    	  methods:{
                          tabSwitch:function(pos){
                            //this.duration = 0.5;
                            this.header_duration = 0.5;
                            if(pos == 0){
                              this.position = 0;
                              this.header_position = 0;
                              this.tab_1_class = "Swipe-tab__on";
                              this.tab_2_class = "";
                            }else{
                              this.position = (-windowWidth);
                              this.header_position = index_header_tab_width;
                              this.tab_2_class = "Swipe-tab__on";
                              this.tab_1_class = "";
                            }
                          },
                          tuijian(bid, num = 1){
                            bid = Number(bid);
                            var self = this;
                            if(self.read_f > 0 || self.read_e > 0){
                              return;
                            }else{
                                self.$loading('推荐请求中...');
                                self.read_f = 1;
                                axios.post(Config.recommend, {
                                      bid: bid,
                                      num: num,
                                  })
                                  .then(function (response) {
                                    self.$loading.close();
                                    //console.log(response);
                                    self.read_f = 0;
                                    if(response.data.message){
                                      setTimeout(function () {
                                          self.$toast.center(response.data.message);
                                      }, 1000);

                                    }else{
                                      console.log(response);
                                      setTimeout(function () {
                                          self.$toast.center('返回数据出错了');
                                      }, 1000);
                                    }

                                  })
                                  .catch(function (response) {
                                      self.$loading.close();
                                      self.read_f = 0;
                                      console.log(response);
                                      setTimeout(function () {
                                          self.$toast.center('网络故障稍后再试');
                                      }, 1000);
                                  });

                                }

                          },
                          addbookcase(bid ,cid){
                              bid = Number(bid);
                              cid = Number(cid);
                              var self = this;
                              if(self.read_e > 0 || self.read_f > 0){
                                return;
                              }else{
                                  self.$loading('收藏请求中...');
                                  self.read_e = 1;
                                  axios.post(Config.addbookcaseurl, {
                                        bid: bid,
                                        cid: cid,
                                    })
                                    .then(function (response) {
                                      self.$loading.close();
                                      self.read_e = 0;
                                      if(response.data.message){
                                        setTimeout(function () {
                                            self.$toast.center(response.data.message);
                                        }, 1000);


                                      }else{
                                        console.log(response);
                                        setTimeout(function () {
                                            self.$toast.center('返回数据出错了');
                                        }, 1000);

                                      }

                                    })
                                    .catch(function (response) {
                                        self.$loading.close();
                                        self.read_e = 0;
                                        console.log(response);
                                        setTimeout(function () {
                                            self.$toast.center('网络故障稍后再试');
                                        }, 1000);

                                    });
                              }

                          },



                        },



                    });

      },
      readApi: function(){
          var Dom = {
              top_nav: $('#top_nav'),
              bottom_nav: $('.bottom_nav'),
              font_container: $('#font-container'),
              font_button: $('#font-button'),
              bk_container: $('.bk-container'),
              bk_container_current: $('.bk-container-current'),
              day_icon: $('#day_icon'),
              night_icon: $('#night_icon'),

              reader__ft_bar: $('.reader__ft-bar'),
              gongneng_container: $('#gongneng-container'),
              gongneng_button: $('#gongneng-button'),

          };
          var Win = $(window);
          var Doc = $(document);
          var readerModel;//闭包内的全局方法
          var readerUI;//闭包内的全局方法

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
          $('[data-background="' + initBackground + '"]').children('.bk-container-current').css('display', 'block');
          //Body.css('background', initBackground);
          VM.$refs.appBox.style.background = initBackground;
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
              $('#action_mid').click(function () {
                  if (Dom.top_nav.css('display') == 'none') {
                      Dom.reader__ft_bar.show();
                      Dom.bottom_nav.show();
                      Dom.top_nav.show();
                  } else {
                      Dom.reader__ft_bar.hide();
                      Dom.bottom_nav.hide();
                      Dom.top_nav.hide();
                      Dom.font_container.hide();
                      $(Dom.font_button.find('i')[0]).removeClass('current');
                      Dom.gongneng_container.hide();
                      $(Dom.gongneng_button.find('i')[0]).removeClass('current');
                  }
              });

              //切换
              Dom.font_button.click(function () {
                  Dom.gongneng_container.hide();
                  $(Dom.gongneng_button.find('i')[0]).removeClass('current');
                  if (Dom.font_container.css('display') == 'none') {
                      Dom.font_container.show();
                      Dom.reader__ft_bar.hide();
                      $(Dom.font_button.find('i')[0]).addClass('current');
                  } else {
                      Dom.reader__ft_bar.show();
                      Dom.font_container.hide();
                      $(Dom.font_button.find('i')[0]).removeClass('current');
                  }
              });
              Dom.gongneng_button.click(function () {
                  Dom.font_container.hide();
                  $(Dom.font_button.find('i')[0]).removeClass('current');
                  if (Dom.gongneng_container.css('display') == 'none') {
                      Dom.gongneng_container.show();
                      Dom.reader__ft_bar.hide();
                      $(Dom.gongneng_button.find('i')[0]).addClass('current');
                  } else {
                      Dom.reader__ft_bar.show();
                      Dom.gongneng_container.hide();
                      $(Dom.gongneng_button.find('i')[0]).removeClass('current');
                  }
              });


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
              })
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
                  Dom.bottom_nav.hide();
                  Dom.top_nav.hide();
                  Dom.reader__ft_bar.hide();
                  //Dom.font_button.removeClass('current');
                  Dom.font_container.hide();
                  $(Dom.font_button.find('i')[0]).removeClass('current');

                  Dom.gongneng_container.hide();
                  $(Dom.gongneng_button.find('i')[0]).removeClass('current');
              });

          }

          main();//调用入口函数


      },


  }

  window.baobaoni = baobaoni;
  baobaoni.init();
})()//闭包不影响全局
