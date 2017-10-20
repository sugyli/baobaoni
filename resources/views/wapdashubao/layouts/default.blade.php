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
    <link rel="stylesheet" type="text/css" href="//at.alicdn.com/t/font_444386_q6y5rc5tkry0hpvi.css" />
  </head>
  <body>
    <script>
        var Config = {
            'recommend': "{{route('webajax.user.recommend')}}",
            'addbookcaseurl': "{{ route('webajax.bookshelf.addbookcase') }}",
            'jubaourl': "{{ route('webajax.outboxs.mstore') }}"
        };
    </script>
  @yield('style')
  <div id="app" v-bind:style="'width:'+ screen_width + 'px;position: relative'" ref="appBox">
      @yield('content')
  </div>

  </body>
  @section('scripts')
  <script src="{{ mix('/wapdashubao/vue/app.js') }}"></script>
  @show
  @section('subscripts')

  @show
</html>
