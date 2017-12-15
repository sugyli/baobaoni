<!DOCTYPE html>
<html lang="zh">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" />
<title>@section('title')标题@show</title>
<meta name="keywords" content="@yield('keywords',"关键字")" />
<meta name="description" content="@yield('description',"描述")" />
<meta http-equiv="Cache-Control" content="no-siteapp">
<meta http-equiv="Cache-Control" content="no-transform">
<link rel="stylesheet" type="text/css" href="/css/novels_1.css">
<link rel="shortcut icon" href="/favicon.ico"/>
<script src="/js/jquery.min.js"></script>
<script src="/js/axios.min.js"></script>
<script src="/js/webquanju_3.js"></script>
</head>
<body>
  <script>
      var Config = {
        aliinputsearchurl: '{{route('ajax.aliinputsearch')}}',
      };

  </script>
@yield('style')
<header class="header">
  <div class="main re" id="header">
      <div class="lf f-cb">
        <a href="/" title="用户登录">用户登录</a> | <a href="/" title="用户注册">用户注册</a>
      </div>
  </div>
</header>
<div class="main re f-cb" style="padding-top:35px">
  <div class="logo">
    <a href="/" title="{{config('app.webname')}}">{{config('app.webname')}}</a>
  </div>
  <div class="seach">
    <div class="seach-main">
      <form action="/search" method="get" id="search-form">
        <input id="search_input" name="query" type="text" class="search-text" placeholder="请输入小说名和作者名来搜索，千万别输错字了！" autocomplete="off" style="height: 34px; line-height: 34px;">
        <input type="submit" class="search-bnt"  value="搜索">
      </form>
    </div>
  </div>
</div>
<div class="suggest" id="search-suggest" style="display:none">
 <ul id="search-result">
 </ul>
</div>

@yield('content')
@section('scripts')
  <script src="/js/webjs_1.js"></script>
  @if (!Request::is('user/*'))
  <script>tongji();</script>
  @endif
@show
@section('subscripts')
@show
</body>
</html>
