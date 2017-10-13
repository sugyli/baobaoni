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
    <title>@section('title')标题@show</title>
    <meta name="keywords" content="@yield('keywords','关键词')" />
    <meta name="description" content="@yield('description','描述')" />
    <link rel="shortcut icon" href="/favicon.ico"/>
  </head>
  <body>
  @yield('style')
  <div id="app" v-bind:style="'width:'+ screen_width + 'px;'">
      @yield('content')
  </div>

  </body>
  @section('scripts')
  <script src="{{ mix('/wapdashubao/vue/app.js') }}"></script>
  @show
  @section('subscripts')

  @show
</html>
