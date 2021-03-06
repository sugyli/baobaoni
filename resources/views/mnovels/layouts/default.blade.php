<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no" />
    <meta name="format-detection" content="telephone=no" />
    <meta name="applicable-device" content="mobile" />
    <meta http-equiv="Cache-Control" content="no-transform" />
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <link rel="stylesheet" type="text/css" href="/css/mnovelall_19_11_27.css">
    <title>@section('title')标题@show</title>
    <meta name="keywords" content="@yield('keywords','关键词')" />
    <meta name="description" content="@yield('description','描述')" />
    <link rel="shortcut icon" href="/favicon.ico"/>
    <link rel="stylesheet" type="text/css" href="/css/iconfont.css" />
    <script src="/js/jquery.min.js"></script>
    <script src="/js/layer_mobile/layer.js"></script>
    <script src="/js/axios.min.js"></script>
    <script src="/js/quanju_18.js"></script>
  </head>
  <body>
    <script>
        var currentHref=location.href;
        if(/baiducontent.com/gi.test(currentHref)){
          location.href= "{{request()->url()}}";
        }
        var Config = {
          alisearchurl: '{{route('ajax.alisearch')}}',
          recommendurl: '{{ route('ajax.recommend') }}',
          addbookcaseurl: '{{route('ajax.addbookcase')}}',
          delbookcaseurl: '{{ route('ajax.destroy') }}',
          muluurl: '{{ route('ajax.mulu') }}',
          jubaourl: '{{route('ajax.sendmessage')}}',
          shujiaurl: '{{route('ajax.getbookshelfs')}}',
        };

    </script>
    @yield('style')
    <div id="app" style="position: relative;">
        @yield('content')
    </div>
  </body>
  @section('scripts')
  <script src="/js/myjs_2.js"></script>
    @if (!Request::is('user/*'))
    <script>tongji();</script>
    @endif
  @show
  @section('subscripts')
  @show
</html>
