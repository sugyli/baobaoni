/*jquery.metadata.js*/
(function ($) { $.extend({ metadata: { defaults: { type: 'class', name: 'metadata', cre: /({.*})/, single: 'metadata' }, setType: function (type, name) { this.defaults.type = type; this.defaults.name = name; }, get: function (elem, opts) { var settings = $.extend({}, this.defaults, opts); if (!settings.single.length) settings.single = 'metadata'; var data = $.data(elem, settings.single); if (data) return data; data = "{}"; if (settings.type == "class") { var m = settings.cre.exec(elem.className); if (m) data = m[1]; } else if (settings.type == "elem") { if (!elem.getElementsByTagName) return undefined; var e = elem.getElementsByTagName(settings.name); if (e.length) data = $.trim(e[0].innerHTML); } else if (elem.getAttribute != undefined) { var attr = elem.getAttribute(settings.name); if (attr) data = attr; } if (data.indexOf('{') < 0) data = "{" + data + "}"; data = eval("(" + data + ")"); $.data(elem, settings.single, data); return data; } } }); $.fn.metadata = function (opts) { return $.metadata.get(this[0], opts); }; })(jQuery);
/* WsAjax AJAX Version:  1.0
 * $.fn.WsAjax(); */
(function (b) { b.fn.WsAjax = function (a) { a = b.extend({ type: "POST", contentType: "application/x-www-form-urlencoded", url: "", data: {}, dataType: "json", crossDomain: !1, beforeSend: function () { }, cache: !1, timeout: 3E4, success: function () { }, error: function () { } }, a); b.ajax({ type: a.type, contentType: a.contentType, url: a.url, data: a.data, dataType: a.dataType, beforeSend: a.beforeSend, cache: a.cache, timeout: a.timeout, success: a.success, error: a.error }) } })(jQuery);
/**$.msgbox.show**/
(function (n) { n.msgbox = n.msgbox || {}; n.msgbox.defaults = { icon: "ok", i18n: !1, message: "", timeOut: 3e3, beforeHide: null }; n.msgbox.show = function (t) { t = n.extend({}, n.msgbox.defaults, t || {}); var i = { show: function () { var t, r = !0; n(".msgbox_layout_wrap").length > 0 ? (t = n(".msgbox_layout_wrap")[0], r = !1) : t = n(i.getHtml()); n(".msgbox_layout_wrap", t).css("top", i.getTop() + "px"); i.setText(i.getMessage(), t); i.setIcon(i.getStyle(), t); i.addEvent(); i.render(t, r) }, getMessage: function () { if (t.i18n) { var i = n.util.getMessage(t.message); return i && "" != i || (i = t.message), i } return t.message }, getStyle: function () { return t.icon != "ok" && t.icon != "no" && t.icon != "warn" && t.icon != "clear" ? "icon_clear" : "icon_" + t.icon }, getHtml: function () { var n = []; return n.push('<div class="msgbox_layout_wrap" id="m_mgbox" style="">'), n.push('     <span class="msgbox_layout" style="z-index: 10000;">'), n.push('         <span class="" id="iconSpan"><\/span>'), n.push('         <span id="txtPan"><\/span>'), n.push('         <span class="icon_end"><\/span>'), n.push("     <\/span>"), n.push("<\/div>"), n.join("") }, getTop: function () { var t = n(window).height(); return t - 27 }, setText: function (t, i) { var r = n("#txtPan", n(i)); r.html(t) }, setIcon: function (t, i) { var r = n("#iconSpan", n(i)), u = r.attr("class"); r.removeClass(u); r.addClass(t) }, addEvent: function () { var i = setInterval(function () { t.beforeHide && t.beforeHide(); n("#m_mgbox").hide(); clearTimeout(i) }, t.timeOut) }, render: function (t, i) { i ? n("body").append(t) : n(t).show() } }; i.show() } })(jQuery);
/* 数组删除 Version:  1.0 */
//Array.prototype.del = function (n) { if (n < 0) { return this; } else { return this.slice(0, n).concat(this.slice(n + 1, this.length)); } }

function scriptDomElement(u) {
    var s = document.createElement('script'),
    h = document.getElementsByTagName('head')[0];
    s.src = u;
    s.async = true;
    if (h) h.insertBefore(s, h.lastChild);
}

var to_json_string = typeof JSON !== "undefined" ? JSON.stringify : function (obj) {
    var arr = [];
    $.each(obj, function (key, val) {
        var next = key + ": ";
        next += $.isPlainObject(val) ? to_json_string(val) : val;
        arr.push(next);
    });
    return "{ " + arr.join(", ") + " }";
};

function tabclick(tabs, on, tabcon) {
    $(tabs).each(function (index) {
        $(this).click(function () {
            $(tabs).removeClass(on);
            $(this).addClass(on);
            $(tabcon).hide();
            $(tabcon).eq(index).show();
        });
    });
}

function AutoScroll(obj) { $(obj).find("ul:first").animate({ marginTop: "-25px" }, 500, function () { $(this).css({ marginTop: "0px" }).find("li:first").appendTo(this); }); }
var $back = $(".gobacktop").css({ opacity: 0.6 }).click(function () { $("html, body").animate({ scrollTop: 0 }, "fast"); });

var kernel = { domain: typeof go != "undefined" ? go.site : '' };
var core = {
    api: kernel.domain + '/services',
    isNum: function (num) {
        var numReg = /^[0-9]*$/;
        if (!numReg.test($(num).val())) {
            core.box("请输入正确的数量", "no", 2000, null);
            return false;
        }
        return true;
    },
    ajax: function (action, data, fun, before) {
        $.fn.WsAjax({
            url: core.api + "/" + action + "/?jsoncallback=?&" + Math.random(),
            data: data,
            beforeSend: before,
            success: fun,
            error: function (h, t, e) { core.box(t, "no", 2000, null); }
        });
    },
    box: function (message, icon, timeout, fun) {
        $.msgbox.show({ message: message, icon: icon, timeOut: timeout, beforeHide: fun });
    },
    get_checkbox_id: function () {
        var cid = [];
        $(":checkbox:checked[name='chk_bid']").each(function () { cid.push($(this).val()); });
        return cid.toString();
    },
    popup: {
        lay: null,
        scrollTimer: null,
        $this: null,
        show: function () {
            $this.fadeIn().css({ marginLeft: -$this.width() / 2, marginTop: -$this.height() / 2 - 20 });
            //console(lay);
        },
        changeTop: function () {
            $this.animate({ marginLeft: -$this.width() / 2 + $(window).scrollLeft(), marginTop: -$this.height() / 2 + $(window).scrollTop() }, "fast");
        },
        close: function () {
            lay.fadeOut();
        },
        init: function (obj) {
            lay = obj;
            $this = $(lay);
            $this.find(".close").click(function () {
                $(this).parents(lay).fadeOut();
            });
            $(window).scroll(function () {
                if (!window.XMLHttpRequest) {
                    if (scrollTimer) clearTimeout(scrollTimer);
                    scrollTimer = setTimeout(changeTop, 100);
                }
            });
        }
    },
    backTop: function () {
        var st = $(document).scrollTop(), wt = $(window).height();
        (st > 0) ? $back.fadeIn("fast") : $back.fadeOut("fast");
        //IE6下的定位
        if (!window.XMLHttpRequest) {
            $back.css("top", st + wt - 470);
        }
    },
    pay_overlay: function () {
        core.popup.init(".pay_overlay");
        core.popup.show();
    },
    login_overlay: function () {
        core.popup.init(".login_overlay");
        core.popup.show();
    },
    tempcase: function () {
        core.ajax("Member/loadmycase", null, function (data) {
            $this = $(".record-box dl");
            $this.empty();
            if (data.Success) {
                $.each(data.InnerResult, function (index, va) {
                    $this.append("<dd><p><a href=\"" + kernel.domain + "/book/" + va.bid + "/\" target=\"_blank\">《" + va.booktitle + "》</a>" +
                        "<a href=\"" + kernel.domain + va.chapterMarkUrl + "\" target=\"_blank\" class=\"goread\">继续阅读&gt;&gt;</a></p>" +
                        "<p>阅读书签：<a href=\"" + kernel.domain + va.chapterMarkUrl + "\" target='_blank'>" + va.chapterMarkTitle + "</a></p></dd>");
                });
            } else {
                $this.append("<dd><p>您暂时没有阅读记录</p></dd>");
            }
        }, null);
    },
    isLogin: function () {
        if (_userpro.id == 0) {
            core.login_overlay();
            return false;
        }
        return true;
    },
    login_check: function (username, userpass, saveLogin, goUrl) {
        core.ajax("Member/chkLogin", { "username": username, "userpass": userpass, "saveLogin": saveLogin }, function (data) {
            //console.log(goUrl);
            if (data.Success) {
                location.href = typeof goUrl == "undefined" ? data.InnerResult : goUrl;
            } else {
                core.box(data.Error, "no", 2000, null);
            }
        }, null);
    },
    login_init: function () {
        if (typeof _userpro != "undefined") {
            if (_userpro.id > 0) {
                var fly = '<li><a href="' + kernel.domain + '/user/" class="gold">' + _userpro.nickname + '</a></li>' +
                            '<li><a href="' + kernel.domain + '/user/edit/">资料</a></li><li><a href="/user/logout.aspx">退出</a></li>';
                $("#h_login_info").prepend(fly).find("li.login").remove();
            }
        }
        $("#url").val(location.href);

        $(window).bind("scroll", core.backTop);
        core.backTop();
    },
    mark: function () {
        if (!core.isLogin()) {
            return false;
        }
        var _post;
        if (typeof _book != "undefined") {
            _post = { "bid": _book.id, "cid": _book.chapterid };
        } else {
            _post = { "bid": $(this).attr("bid"), "cid": 0 };
        }
        core.ajax("Member/addBookMark", _post, function (data) {
            if (data.Success) {
                core.box("追书成功！", "ok", 1500, null);
            } else {
                core.box(data.Error, "no", 2000, null);
            }
        }, null);
    }
};

$(function () {
    $.metadata.setType("attr", "data-meta");
    core.login_init();
    $(".userLogin").click(core.login_overlay);
    $("a.addMark").click(core.mark);
    $("#login_form").submit(function () {
        core.login_check($("#u_account").val(), $("#u_pwd").val(), $("#saveLogin").is(':checked') == true ? 1 : 0, $("#url").val());
        return false;
    });
    //$("#chkLogin").click(function () { core.login_check($("#u_account").val(), $("#u_pwd").val(), $("#saveLogin").is(':checked') == true ? 1 : 0, $("#url").val()); });

    $("li.record").toggle(function () {
        $(this).addClass("hover").children("i").removeClass("down-icon").addClass("up-icon");
        core.tempcase();
        $(".record-box").show();
    }, function () {
        $(this).removeClass("hover").children("i").removeClass("up-icon").addClass("down-icon");
        $(".record-box").hide();
    });
    $(".footer-bar .attention a").hover(function () { $(this).children(".qrcode").show(); }, function () { $(this).children(".qrcode").hide(); });

    $(".toolbar a.sve").hover(function () {
        $(this).addClass("hover").children(".svelist").fadeIn();
        $(".sve-bd span.text").html("在线客服");
    }, function () {
        $(this).removeClass("hover").children(".svelist").fadeOut();
        $(".sve-bd span.text").html("客服");
    });

    $(".books-list li").hover(function () {
        $(this).children(".introbg").stop(true, true).fadeTo("fast", 0.6);
        $(this).children(".introlink").stop(true, true).fadeIn("fast");
    }, function () {
        $(this).children(".introbg").stop(true, true).fadeTo("fast", 0);
        $(this).children(".introlink").stop(true, true).fadeOut("fast");
    });
    $("#search_form").submit(function () {
        if ($("#searchTxt").val() == '') { alert('请输入搜索内容!'); return false; }
        location.href = "http://so.xiaoshuo520.com/kw/" + $("#searchTxt").val();
        return false;
    });
    tabclick(".clickranking-tab li", "on", ".clickranking-tabcon ul");
    tabclick(".upgrade-tab a", "on", ".upgrade-tabcon .upgrade-bd");
    tabclick(".mydata-tab a", "on", ".mydata-tabcon .dataform");

});
