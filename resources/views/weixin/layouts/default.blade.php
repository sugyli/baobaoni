<!doctype html>
<html lang="zh-cn">
<head>
<title>@section('title')标题@show</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<meta name="apple-mobile-web-app-capable" content="yes" />
<meta name="apple-mobile-web-app-status-bar-style" content="black" />
<meta name="format-detection" content="telephone=no" />
<link rel="stylesheet" type="text/css" href="/css/mobile.css">
</head>
<body>
<div class="wrapper">
    <div class="header">
      <a href="/" class="logo"></a>
      <div class="nav">
          <a href="/" class="current">首页</a>
          <a href="/book/">书库</a>
          <a href="/book/top/">排行</a>
          <a href="/pay/">充值</a>
      </div>
      <div class="logininfo">
          <div class="fright r"><a href="/user/bookcase/" class="bookshelf">会员中心</a></div>
      </div>
    </div>
    <div class="content">
        <div class="search">
            <form action="/book/search/" method="post">
                <table cellpadding="0" cellspacing="0" class="search">
                    <tr>
                        <td class="col-1"><div class="textbox"><input type="text" placeholder="输入关键字搜索" class="s-text" name="searchkey" value="" /></div></td>
                        <td class="col-2"></td>
                        <td class="col-3"><input type="submit" value="搜索" class="s-btn" /></td>
                    </tr>
                </table>
            </form>
        </div>
        @yield('content')
    </div>
    <div class="gray footer">
      <div class="btnav">
        <a href="http://m.xiaoshuo520.com/">移动版</a>
        <span class="vline">|</span>
        <a href="http://www.xiaoshuo520.com/">PC版</a>
        <span class="vline">|</span>
        <a href="http://a.app.qq.com/o/simple.jsp?pkgname=com.xiaoshuo520.reader">客户端</a>
        <span class="vline">|</span>
        <a href="/help/">帮助</a>
        <span class="vline">|</span>
        <a href="/user/logout/">退出登录</a>
      </div>
      <div class="mt10 customsv">
        <h4>客服</h4>
        <p>时间：周一到周五 9:00-18:00</p>
        <p>电话：<a href="tel:027-87293128">027-87293128</a></p>
        <p>QQ：2986146492</p>
      </div>
      <div class="mt10 copyright">
        <p>鄂ICP备13014929号-6</p>
        <p>Copyright (C) xiaoshuo520.com. All Rights Reserved.</p>
      </div>
    </div>
<script type="text/javascript" src="/service/default.aspx?u="></script>
<script type="text/javascript" src="http://res.xiaoshuo520.com/m_script/tongji.baidu.js"></script>
</div>
</body>
</html>
