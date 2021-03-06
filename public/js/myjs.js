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
      searchApi:function(defimage,imagepath) {

        $('#searchBox').keydown(function(event){
          if(event.keyCode=='13'){
            $('#search_bnt').click();
          }

        });

        $('#search_bnt').bind('click',function(){
            var searchText =  $.trim($('#searchBox').val());
            if(searchText){
              var searchItems = [];
              layer.open({
                      type: 2,
                      content: '玩命的请求中',
                      shadeClose: false
                    });
              axios.post(Config.alisearchurl, {
                    query: searchText,
                })
                .then(function (response) {
                   layer.closeAll();
                   if(response.data.error == 0){
                      var data = response.data.bakdata;
                      var htmls = '<ul class="i-cl-list Displayanimation">';
                      for (var i = 0; i < data.length; i++) {
                          htmls += '<li>';
                          htmls += '<div class="i-cl-list-main">';
                          htmls += '<a href="'+ '/info-' + data[i]['fields']['bookid'] + '">';
                          htmls += '<div class="i-cl-list-main-left">';
                          if(data[i]['fields']['price'] == 'nopic'){
                              htmls += '<img src="' + defimage + '"/>';
                           }else{
                              htmls += '<img src="' + imagepath + data[i]['fields']['price'] + '"/>';
                           }

                          htmls += '</div>';
                          htmls += '<div class="i-cl-list-main-right">';
                          htmls += '<p class="i-cl-list-main-right-bookname">';
                          htmls += data[i]['fields']['title'];
                          htmls += '</p>';
                          htmls += '<p class="i-cl-list-main-right-author">';
                          htmls += data[i]['fields']['author'];
                          htmls += '</p>';
                          htmls += '</div>';
                          htmls += '</a>';
                          htmls += '</div>';
                          htmls += '</li>'
                      }
                      htmls += '</ul>';

                   }else{
                     var htmls =  '<div style="text-align:center; padding:50px 0;">没有相应的搜索结果</div>';

                   }
                   $("#sousuo").html(htmls);
                })
                .catch(function (response) {
                    layer.closeAll();
                    console.log(response);
                    layer.open({
                      content: '搜索出现故障欢迎举报问题'
                      ,skin: 'msg'
                      ,time: 2 //2秒后自动关闭
                      });
                });
            }

          });


      },
      readApi: function(bid , page ,weizhi,cid , bookName){

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

          document.getElementById('app').style.background = initBackground;
          //VM.$refs.appBox.style.background = initBackground;

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
                    layer.open({
                      content: '字号不能更大了！'
                      ,skin: 'msg'
                      ,time: 2 //2秒后自动关闭
                      });
                      return;
                  }
                  initFontSize += 1;
                  RootContainer.css('font-size', initFontSize);
                  Util.StorageSetter('font_size', initFontSize);

            });
            $('#small-font').click(function () {
                if (initFontSize < 12) {
                  layer.open({
                    content: '字号不能更小了！'
                    ,skin: 'msg'
                    ,time: 2 //2秒后自动关闭
                    });
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
                    document.getElementById('app').style.background = initBackground;
                    //VM.$refs.appBox.style.background = initBackground;
                    Util.StorageSetter('background', initBackground);
                } else {
                    //白变黑
                    Dom.day_icon.hide();
                    Dom.night_icon.show();
                    Dom.bk_container_current.css('display', 'none');
                    $('#last_night').children('.bk-container-current').css('display', 'block');
                    initBackground = '#283548';
                    //Body.css('background', initBackground);
                    document.getElementById('app').style.background = initBackground;
                    //VM.$refs.appBox.style.background = initBackground;
                    Util.StorageSetter('background', initBackground);
                }
            });

            Dom.bk_container.click(function () {
                if ($(this).children('.bk-container-current').css('display') == 'none') {
                    Dom.bk_container_current.css('display', 'none');
                    $(this).children('.bk-container-current').css('display', 'block');
                    initBackground = $(this).attr('data-background');
                    //Body.css('background', initBackground);
                    document.getElementById('app').style.background = initBackground;
                    //VM.$refs.appBox.style.background = initBackground;
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


          //统计浏览记录
          var str = $.cookie("hislogs");
          var jos = {'url':window.location.href,'bookName':bookName};
          var hislogs = new Array();
          if (str){
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
              $.cookie('hislogs',str,{expires:30 , path:'/'});

          }else{
              hislogs.splice(0,1);
              hislogs.push(jos);
              var str = JSON.stringify(hislogs);
              $.cookie('hislogs',str,{expires:30 , path:'/'});
          }


      },
      jubaocuowu( biaoti,from){
        var jubaotitle = biaoti;
        var jubaofrom = from;
        swal({
          title: "举报问题",
          text: "请输入举报问题：",
          type: "input",
          showCancelButton: true,
          cancelButtonText: '关闭',
          confirmButtonText: "确认",
          closeOnConfirm: false,
          animation: "slide-from-top",
          inputPlaceholder: "输入一些话"
        },
        function(inputValue){
          if (inputValue === false) return false;

          if (inputValue === "") {
            swal.showInputError("你需要输入一些话！");
            return false
          }
          swal.close();
          var biaoti = '来源手机_书名：'+ jubaotitle + '_来路：' + jubaofrom;
          axios.post(Config.jubaourl, {
               content: inputValue,
               title: biaoti,
           })
           .then(function (response) {
             //console.log(response);
            if(response.data.error == 0){
              swal("消息提示！", response.data.message ,"success");

            }else if (response.data.message) {
              swal("消息提示！", response.data.message ,"warning");
            }else{
                swal("消息提示！", '服务器返回数据出错了' ,"warning");

             }

           })
           .catch(function (response) {
               console.log(response);
               swal("消息提示！", '网络故障稍后再试！' ,"error");
           });

         });
      },
      addbookcase(bid ,cid){
          bid = Number(bid);
          cid = Number(cid);
          var self = this;
          layer.open({
                  type: 2,
                  content: '玩命的请求中',
                  shadeClose: false
                });
          axios.post(Config.addbookcaseurl, {
                bid: bid,
                cid: cid,
            })
            .then(function (response) {
              layer.closeAll();
              if(response.data.message){
                setTimeout(function () {
                    layer.open({
                        content: response.data.message
                        ,btn: '我知道了'
                        ,shadeClose: false
                    });
                }, 500);

              }else{
                console.log(response);
                setTimeout(function () {
                  layer.open({
                      content: '返回数据出错了'
                      ,btn: '我知道了'
                      ,shadeClose: false
                  });
                }, 500);

              }

            })
            .catch(function (response) {
                layer.closeAll();
                console.log(response);
                setTimeout(function () {
                    layer.open({
                        content: '网络故障稍后再试'
                        ,btn: '我知道了'
                        ,shadeClose: false
                    });
                }, 500);

            });

      },
      tuijian(bid){
          bid = Number(bid);
          var self = this;
          layer.open({
                  type: 2,
                  content: '玩命的请求中',
                  shadeClose: false
                });
          axios.post(Config.recommendurl, {
                bid: bid,
            })
            .then(function (response) {
              //console.log(response);
              layer.closeAll();
              if(response.data.message){
                setTimeout(function () {
                    layer.open({
                        content: response.data.message
                        ,btn: '我知道了'
                        ,shadeClose: false
                    });
                }, 500);

              }else{
                console.log(response);
                setTimeout(function () {
                    layer.open({
                        content: '返回数据出错了'
                        ,btn: '我知道了'
                        ,shadeClose: false
                    });
                }, 500);
              }

            })
            .catch(function (response) {
                layer.closeAll();
                console.log(response);
                setTimeout(function () {
                  layer.open({
                      content: '网络故障稍后再试'
                      ,btn: '我知道了'
                      ,shadeClose: false
                  });
                }, 500);
            });
        },
        case_del(id){
          //底部对话框
          layer.open({
            content: '您确定删除吗？'
            ,btn: ['删除', '取消']
            ,skin: 'footer'
            ,yes: function(index){
                axios.post(Config.delbookcaseurl, {
                    caseid: id
                  })
                  .then(function (response) {
                      if (response.data.error == 0) {
                        $("#"+id).html("<li><p class='red-bg'>已经删除!</p></li>");
                        layer.open({
                          content: response.data.message
                          ,skin: 'msg'
                          ,time: 2 //2秒后自动关闭
                          });
                        return;
                      }else{
                        layer.open({
                          content: '删除失败了'
                          ,skin: 'msg'
                          ,time: 2 //2秒后自动关闭
                          });
                          return;
                      }
                  })
                  .catch(function (response) {
                      console.log(response);
                      layer.open({
                        content: '服务器维护稍后再试'
                        ,skin: 'msg'
                        ,time: 2 //2秒后自动关闭
                        });
                      return;

                  });
            }
          });

        },
        showshujia(redurl,bookCount ,url){
          var self = this;
          layer.open({
                  type: 2,
                  content: '正在获取中',
                  //shadeClose: false
                });
          axios.post(Config.shujiaurl, {
            })
            .then(function (response) {
                layer.closeAll();
                if(response.data.error == 0){
                  var items = response.data.bakdata;

                  var htmls = '<li style="padding:10px 0;">';
                      htmls += '<span class="red-bg">您的等级只能显示 '+ bookCount +' 本 如果越界请删除不要的收藏才能显示更多</span>';
                      htmls += '</li>';

                  for (var i = 0; i < items.length; i++) {
                      htmls += '<li  id="' + items[i].caseid + '">';
                      htmls += '<p>书名：';
                      if(items[i].relation_articles && items[i].relation_articles.lastupdate > items[i].lastvisit){
                        htmls += '<img src="/images/new.gif" />'
                      }
                      if(items[i].relation_articles){

                        htmls += '<a href="' + redurl + '/'+  items[i].relation_articles.articleid + '"';
                        if(items[i].relation_articles && items[i].relation_articles.lastupdate > items[i].lastvisit){
                          htmls += '<span class="red-bg">';
                          htmls +=  items[i].relation_articles.articlename;
                          htmls += '</span>';
                        }else{
                          htmls += '<span style="color:#0000FF">' + items[i].relation_articles.articlename + '</span>';

                        }
                        htmls += '</a>';
                      }else{
                        htmls += '<span>' + items[i].articlename + '<em style="color:red;">丢失</em></span>';
                      }
                      htmls += '</p>';
                      htmls +='<p>作者：' + (items[i].relation_articles && items[i].relation_articles.author) ? items[i].relation_articles.author : '未知' + '</p>';
                      htmls += '<p>书签：';
                      if(items[i].chapterid > 0){
                        htmls += '<a href="' + redurl +'/' + items[i].articleid +'/'+ items[i].chapterid + '">' + items[i].chaptername + '</a>';
                      }else{
                        htmls += '<label v-else>无书签</label>';
                      }
                      htmls += '</p>';

                      htmls += '<p>最新章节：';
                      if(items[i].relation_articles && items[i].relation_articles.lastchapterid > 0){
                        htmls += '<a href="'+ redurl +'/' + items[i].relation_articles.articleid +'/'+ items[i].relation_articles.lastchapterid + '">' + items[i].relation_articles.lastchapter + '</a>';
                      }else{
                        htmls += '<label>无最新章节</label>';
                      }
                      htmls += '</p>';

                      if(items[i].relation_articles){
                        htmls += '<p>更新时间：' +  items[i].relation_articles.updatetime + '</label>';
                      }else{
                        htmls += '<p>更新时间：无</p>';
                      }

                      htmls += '<p><a href="javascript:void(0)" onclick="case_del('+ items[i].caseid + ')"><span class="red-bg">删除本书</span></a></p>';
                      htmls += '</li>';
                   }
                }else{
                  var htmls =  '<div style="text-align:center; padding:50px 0;">没有收藏</div>';
                }
                $("#shujia").html(htmls);
            })
            .catch(function (response) {
                layer.closeAll();
                console.log(response);
                layer.open({
                  content: '书架出现故障欢迎举报问题'
                  ,skin: 'msg'
                  ,time: 2 //2秒后自动关闭
                  });

            });

        }

  }

  window.baobaoni = baobaoni;
  baobaoni.init();
})()//闭包不影响全局
