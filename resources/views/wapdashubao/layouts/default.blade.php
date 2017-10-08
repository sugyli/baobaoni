<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no" />
    <meta name="format-detection" content="telephone=no" />
    <meta name="applicable-device" content="mobile" />
    <meta http-equiv="Cache-Control" content="no-transform" />
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <link rel="stylesheet" type="text/css" href="/wapdashubao/css/reset.css">
		<link rel="stylesheet" type="text/css" href="/wapdashubao/css/index.css">
    <title>@section('title')标题@show</title>
    <meta name="keywords" content="@yield('keywords','关键词')" />
    <meta name="description" content="@yield('description','描述')" />
  </head>
  <body>
    @yield('content')
  </body>
  @section('scripts')
    <script src="/wapdashubao/js/vue.js"></script>
    <script src="/wapdashubao/js/zepto.js"></script>
  @show
</html>