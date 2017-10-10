(function () {
  var baobaoni = {
      init: function(){
          var self = this;
          self.qiandao();
          self.searchApi();
      },
      setCookies: function(cookieName,cookieValue){
        var today = new Date();
        var expire = new Date();
        expire.setTime(today.getTime() + 3600000 * 356 * 24);
        document.cookie = cookieName+'='+escape(cookieValue)+ ';path=/;expires='+expire.toGMTString();

      },
      LAST_READ_SET: function(muluurl,neirongurl, booktitle, texttitle){
        if(texttitle=="") {
          texttitle = '首页';
        }
        var LRRead = muluurl+"#"+neirongurl+"#"+booktitle+"#"+texttitle;
        this.setCookies("BLR", LRRead);

      },
      searchApi: function() {
        $('#search_input').bind('keyup',function(){
         var jqueryInput = $(this);
         var searchText = jqueryInput.val();
         axios.post('/searchinput', {
               q: searchText,
           })
           .then(function (response) {
              console.log(response);

           })
           .catch(function (response) {

               console.log(response);

           });
        });


        $('#search-suggest').css({
        	top:$('#search-form').offset().top+$('#search-form').height(),
        	left:$('#search-form').offset().left-1,
          position: 'absolute'
        }).show();





      },
      toTop: function(){
        var a = {
            setting: {
                startline: 300,
                scrollto: 0,
                scrollduration: 400,
                fadeduration: [500, 100]
            },
            controlHTML: '<img src="/images/top.gif" style="width:40px; height:40px; border:0;" />',
            controlattrs: {
                offsetx: 10,
                offsety: 80
            },
            anchorkeyword: "#top",
            state: {
                isvisible: false,
                shouldvisible: false
            },
            scrollup: function() {
                if (!this.cssfixedsupport) {
                    this.$control.css({
                        opacity: 0
                    })
                }
                var b = isNaN(this.setting.scrollto) ? this.setting.scrollto: parseInt(this.setting.scrollto);
                if (typeof b == "string" && jQuery("#" + b).length == 1) {
                    b = jQuery("#" + b).offset().top
                } else {
                    b = 0
                }
                this.$body.animate({
                    scrollTop: b
                },
                this.setting.scrollduration)
            },
            keepfixed: function() {
                var d = jQuery(window);
                var c = d.scrollLeft() + d.width() - this.$control.width() - this.controlattrs.offsetx;
                var b = d.scrollTop() + d.height() - this.$control.height() - this.controlattrs.offsety;
                this.$control.css({
                    left: c + "px",
                    top: b + "px"
                })
            },
            togglecontrol: function() {
                var b = jQuery(window).scrollTop();
                if (!this.cssfixedsupport) {
                    this.keepfixed()
                }
                this.state.shouldvisible = (b >= this.setting.startline) ? true: false;
                if (this.state.shouldvisible && !this.state.isvisible) {
                    this.$control.stop().animate({
                        opacity: 1
                    },
                    this.setting.fadeduration[0]);
                    this.state.isvisible = true
                } else {
                    if (this.state.shouldvisible == false && this.state.isvisible) {
                        this.$control.stop().animate({
                            opacity: 0
                        },
                        this.setting.fadeduration[1]);
                        this.state.isvisible = false
                    }
                }
            },
            init: function() {
                jQuery(document).ready(function(d) {
                    var b = a;
                    var c = document.all;
                    b.cssfixedsupport = !c || c && document.compatMode == "CSS1Compat" && window.XMLHttpRequest;
                    b.$body = (window.opera) ? (document.compatMode == "CSS1Compat" ? d("html") : d("body")) : d("html,body");
                    b.$control = d('<div id="topcontrol">' + b.controlHTML + "</div>").css({
                        position: b.cssfixedsupport ? "fixed": "absolute",
                        bottom: b.controlattrs.offsety,
                        right: b.controlattrs.offsetx,
                        opacity: 0,
                        cursor: "pointer"
                    }).attr({
                        title: "返回顶部"
                    }).click(function() {
                        b.scrollup();
                        return false
                    }).appendTo("body");
                    if (document.all && !window.XMLHttpRequest && b.$control.text() != "") {
                        b.$control.css({
                            width: b.$control.width()
                        })
                    }
                    b.togglecontrol();
                    d('a[href="' + b.anchorkeyword + '"]').click(function() {
                        b.scrollup();
                        return false
                    });
                    d(window).bind("scroll resize",
                    function(f) {
                        b.togglecontrol()
                    })
                })
            }
        };
        a.init();
      },
      setStatus: function(){
        var date = new Date();
        var timestamp = Date.parse(new Date());
        date.setTime(date.getTime() + (30 * 24 * 60 * 60 * 1000));
        jQuery.cookie = function(b, j, m) {
          if (typeof j != "undefined") {
              m = m || {};
              if (j === null) {
                  j = "";
                  m.expires = -1
              }
              var e = "";
              if (m.expires && (typeof m.expires == "number" || m.expires.toUTCString)) {
                  var f;
                  if (typeof m.expires == "number") {
                      f = new Date();
                      f.setTime(f.getTime() + (m.expires * 24 * 60 * 60 * 1000))
                  } else {
                      f = m.expires
                  }
                  e = "; expires=" + f.toUTCString()
              }
              var l = m.path ? "; path=" + (m.path) : "";
              var g = m.domain ? "; domain=" + (m.domain) : "";
              var a = m.secure ? "; secure": "";
              document.cookie = [b, "=", encodeURIComponent(j), e, l, g, a].join("")
          } else {
              var d = null;
              if (document.cookie && document.cookie != "") {
                  var k = document.cookie.split(";");
                  for (var h = 0; h < k.length; h++) {
                      var c = jQuery.trim(k[h]);
                      if (c.substring(0, b.length + 1) == (b + "=")) {
                          d = decodeURIComponent(c.substring(b.length + 1));
                          break
                      }
                  }
              }
              return d
          }
        };

          $("#screen").click(function() {
              var b = $("#screen").parent().parent().children(".select");
              b.show()
          });
          $("#screen1").click(function() {
              var b = $("#screen").parent().parent().children(".select");
              b.show()
          });

          $("#screen").parent().parent().children(".select").children("p").each(function() {
              $(this).click(function() {
                  $("#screen").val($(this).html());
                  $("#screen").parent().parent().children(".select").hide();
                  var b = $("#screen").val();
                  $.cookie("screen", b, {
                      path: "/",
                      expires: date
                  });
                  a.start()
              })
          });
          $("#background").click(function() {
              var b = $("#background").parent().parent().children(".select");
              b.show()
          });
          $("#background1").click(function() {
              var b = $("#background1").parent().parent().children(".select");
              b.show()
          });
          $(".select").parent().each(function() {
              $(this).mouseover(function() {
                  $(this).children(".select").show()
              })
          });
          $(".select").parent().each(function() {
              $(this).mouseout(function() {
                  $(this).children(".select").hide()
              })
          });

          $("#background").parent().parent().children(".select").children("p").each(function() {
              $(this).click(function() {
                  $("#background").val($(this).html());
                  $("#background").parent().parent().children(".select").hide();
                  $(".ydleft").removeClass($("#background2").val());
                  $("body").removeClass($("#background2").val());
                  $("body").attr("style", "");
                  $(".ydleft").attr("style", "");
                  $("#background2").val($(this).attr("class"));
                  $(".ydleft").addClass($(this).attr("class"));
                  $("body").addClass($(this).attr("class"))
              })
          });
          $("#fontSize").click(function() {
              var b = $("#fontSize").parent().parent().children(".select");
              b.show()
          });
          $("#fontSize1").click(function() {
              var b = $("#fontSize1").parent().parent().children(".select");
              b.show()
          });
          $("#fontSize").parent().parent().children(".select").children("p").each(function() {
              $(this).click(function() {
                  $("#fontSize").val($(this).html());
                  $("#fontSize").parent().parent().children(".select").hide();
                  $(".yd_text2").removeClass($("#fontSize2").val());
                  $("#fontSize2").val($(this).attr("class"));
                  $(".yd_text2").addClass($(this).attr("class"))
              })
          });
          $("#fontFamily").click(function() {
              var b = $("#fontFamily").parent().parent().children(".select");
              b.show()
          });
          $("#fontFamily1").click(function() {
              var b = $("#fontFamily1").parent().parent().children(".select");
              b.show()
          });
          $("#fontFamily").parent().parent().children(".select").children("p").each(function() {
              $(this).click(function() {
                  $("#fontFamily").val($(this).html());
                  $("#fontFamily").parent().parent().children(".select").hide();
                  $(".yd_text2").removeClass($("#fontFamily2").val());
                  $("#fontFamily2").val($(this).attr("class"));
                  $(".yd_text2").addClass($(this).attr("class"))
              })
          });
          $("#fontColor").click(function() {
              var b = $("#fontColor").parent().parent().children(".select");
              b.show()
          });
          $("#fontColor1").click(function() {
              var b = $("#fontColor1").parent().parent().children(".select");
              b.show()
          });
          $("#fontColor").parent().parent().children(".select").children("p").each(function() {
              $(this).click(function() {
                  $("#fontColor").val($(this).html());
                  $("#fontColor").parent().parent().children(".select").hide();
                  $(".yd_text2").removeClass($("#fontColor2").val());
                  $("#fontColor2").val($(this).attr("class"));
                  $(".yd_text2").addClass($(this).attr("class"))
              })
          });
          $("#saveButton").click(function() {
              $.cookie("screen", $("#screen").val(), {
                  path: "/",
                  expires: date
              });
              $.cookie("background", $("#background2").val(), {
                  path: "/",
                  expires: date
              });
              $.cookie("fontSize", $("#fontSize2").val(), {
                  path: "/",
                  expires: date
              });
              $.cookie("fontColor", $("#fontColor2").val(), {
                  path: "/",
                  expires: date
              });
              $.cookie("fontFamily", $("#fontFamily2").val(), {
                  path: "/",
                  expires: date
              });
              alert("保存成功")
          });

          $("#recoveryButton").click(function() {
              $("body").removeClass($.cookie("background"));
              $("body").removeClass($("#background2").val());
              $(".ydleft").removeClass($("#background2").val());
              $(".ydleft").removeClass($.cookie("background"));
              $("body").attr("style", "background:#fff");
              $(".ydleft").attr("style", "background:#FFF");
              $(".yd_text2").removeClass($("#background2").val());
              $(".yd_text2").removeClass($("#fontSize2").val());
              $(".yd_text2").removeClass($.cookie("fontSize"));
              $(".yd_text2").removeClass($("#fontColor2").val());
              $(".yd_text2").removeClass($.cookie("fontColor"));
              $(".yd_text2").removeClass($("#fontFamily2").val());
              $(".yd_text2").removeClass($.cookie("fontFamily"));
              $.cookie("background", "", {
                  path: "/",
                  expires: date
              });
              $.cookie("fontSize", "", {
                  path: "/",
                  expires: date
              });
              $.cookie("fontColor", "", {
                  path: "/",
                  expires: date
              });
              $.cookie("fontFamily", "", {
                  path: "/",
                  expires: date
              });
              $("#screen").val("滚屏");
              $("#background").val("背景");
              $("#fontColor").val("字色");
              $("#fontFamily").val("字体");
              $("#fontSize").val("字号")
          });
          var a = (function() {
              var d;
              var g;
              var f;
              function c() {
                  g = setInterval(b, 40);
                  try {
                      if (document.selection) {
                          document.selection.empty()
                      } else {
                          var h = document.getSelection();
                          h.removeAllRanges()
                      }
                  } catch(j) {}
              }
              function b() {
                  d = document.documentElement.scrollTop || document.body.scrollTop;
                  if ($.cookie("screen") != null) {
                      d = d + parseInt($.cookie("screen"))
                  }
                  window.scroll(0, d);
                  f = document.documentElement.scrollTop || document.body.scrollTop;
                  if (d != f) {
                      e()
                  }
              }
              function e() {
                  clearInterval(g)
              }
              return {
                  start: c,
                  stop: e
              }
          })();

          function readCookStyle() {
              if ($.cookie("screen") != null && $.cookie("screen") != "") {
                  $("#screen").val($.cookie("screen"))
              } else {
                  $("#screen").val("滚屏")
              }
              if ($.cookie("fontSize") != null && $.cookie("fontSize") != "") {
                  $(".yd_text2").addClass($.cookie("fontSize"));
                  size = $.cookie("fontSize").replace("fon_", "");
                  size += "px";
                  $("#fontSize").val(size);
                  $("#fontSize2").val($.cookie("fontSize"))
              }
              if ($.cookie("background") != null && $.cookie("background") != "") {
                  var b = "背景";
                  if ($.cookie("background") == "bg_lan") {
                      b = "淡蓝"
                  }
                  if ($.cookie("background") == "bg_huang") {
                      b = "明黄"
                  }
                  if ($.cookie("background") == "bg_lv") {
                      b = "淡绿"
                  }
                  if ($.cookie("background") == "bg_fen") {
                      b = "红粉"
                  }
                  if ($.cookie("background") == "bg_bai") {
                      b = "白色"
                  }
                  if ($.cookie("background") == "bg_hui") {
                      b = "灰色"
                  }
                  if ($.cookie("background") == "bg_hei") {
                      b = "漆黑"
                  }
                  if ($.cookie("background") == "bg_cao") {
                      b = "草绿"
                  }
                  if ($.cookie("background") == "bg_cha") {
                      b = "茶色"
                  }
                  if ($.cookie("background") == "bg_yin") {
                      b = "银色"
                  }
                  if ($.cookie("background") == "bg_mi") {
                      b = "米色"
                  }
                  $("#background2").val($.cookie("background"));
                  $("#background").val(b);
                  $("body").addClass($.cookie("background"));
                  $(".ydleft").addClass($.cookie("background"));
                  $(".yd_text2").addClass($.cookie("background"))
              }
              if ($.cookie("fontColor") != null && $.cookie("fontColor") != "") {
                  var a = "字色";
                  if ($.cookie("fontColor") == "z_hei") {
                      a = "黑色"
                  }
                  if ($.cookie("fontColor") == "z_red") {
                      a = "红色"
                  }
                  if ($.cookie("fontColor") == "z_lan") {
                      a = "蓝色"
                  }
                  if ($.cookie("fontColor") == "z_lv") {
                      a = "绿色"
                  }
                  if ($.cookie("fontColor") == "z_hui") {
                      a = "灰色"
                  }
                  if ($.cookie("fontColor") == "z_li") {
                      a = "栗色"
                  }
                  if ($.cookie("fontColor") == "z_wu") {
                      a = "雾白"
                  }
                  if ($.cookie("fontColor") == "z_zi") {
                      a = "暗紫"
                  }
                  if ($.cookie("fontColor") == "z_he") {
                      a = "玫褐"
                  }
                  $("#fontColor2").val($.cookie("fontColor"));
                  $("#fontColor").val(a);
                  $(".yd_text2").addClass($.cookie("fontColor"))
              }
              if ($.cookie("fontFamily") != null && $.cookie("fontFamily") != "") {
                  var c = "字体";
                  if ($.cookie("fontFamily") == "fam_song") {
                      c = "宋体"
                  }
                  if ($.cookie("fontFamily") == "fam_hei") {
                      c = "黑体"
                  }
                  if ($.cookie("fontFamily") == "fam_kai") {
                      c = "楷体"
                  }
                  if ($.cookie("fontFamily") == "fam_qi") {
                      c = "启体"
                  }
                  if ($.cookie("fontFamily") == "fam_ya") {
                      c = "雅黑"
                  }
                  $("#fontFamily2").val($.cookie("fontFamily"));
                  $("#fontFamily").val(c);
                  $(".yd_text2").addClass($.cookie("fontFamily"))
              }
          }
          jQuery(document).dblclick(a.start);
          jQuery(document).mousedown(a.stop);
          readCookStyle();
      },

      qiandao: function(){
        var scrtime;
        $(".gundong").hover(function(){
          clearInterval(scrtime);

        },function(){

        scrtime = setInterval(function(){
          var $ul = $(".gundong ul");
          var liHeight = $ul.find("li:last").height();
          $ul.animate({marginTop : liHeight + 35 + "px"},1000,function(){

          $ul.find("li:last").prependTo($ul)
          $ul.find("li:first").hide();
          $ul.css({marginTop:0});
          $ul.find("li:first").fadeIn(1000);
          });
        },4000);

        }).trigger("mouseleave");
      },

  }

  window.baobaoni = baobaoni;
  baobaoni.init();
})()//闭包不影响全局
