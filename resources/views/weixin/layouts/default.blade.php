<!doctype html>
<html lang="zh-cn">
<head>
<title>@section('title')标题@show</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<meta name="apple-mobile-web-app-capable" content="yes" />
<meta name="apple-mobile-web-app-status-bar-style" content="black" />
<meta name="format-detection" content="telephone=no" />
<link rel="stylesheet" type="text/css" href="/css/weixin/mobile.css">
@yield('style')
</head>
<body>
<div class="wrapper">
    @yield('content')
<script type="text/javascript" src="/service/default.aspx?u="></script>
<script type="text/javascript" src="http://res.xiaoshuo520.com/m_script/tongji.baidu.js"></script>
</div>
</body>
</html>
