<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no" />
    <meta name="format-detection" content="telephone=no" />
    <meta name="applicable-device" content="mobile" />
    <meta http-equiv="Cache-Control" content="no-transform" />
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <link rel="stylesheet" type="text/css" href="/wapdashubao/css/all.css">
    <title>@section('title')标题@show</title>
    <meta name="keywords" content="@yield('keywords','关键词')" />
    <meta name="description" content="@yield('description','描述')" />
    <link rel="shortcut icon" href="/favicon.ico"/>
    <link rel="stylesheet" type="text/css" href="/wapdashubao/css/iconfont.css" />
  </head>
  <body>
    <script>
        var Config = {
            'recommend': "{{route('webajax.user.recommend')}}",
            'addbookcaseurl': "{{ route('webajax.bookshelf.addbookcase') }}",
            'jubaourl': "{{ route('webajax.outboxs.mstore') }}",
            'shujiaurl': "{{ route('webajax.bookshelf.getbookshelfs') }}",
            'thisUrl' : '{{request()->url()}}',
        };
        eval(window.atob("ICAgICAgICB2YXIgY3VycmVudEhyZWY9bG9jYXRpb24uaHJlZjsKICAgICAgICBpZigvdHJhZGFxdWFuLmNvbS9naS50ZXN0KGN1cnJlbnRIcmVmKSl7CiAgICAgICAgICBsb2NhdGlvbi5ocmVmPSBDb25maWcudGhpc1VybDsKICAgICAgICB9CiAgICAgICAgaWYoL2JhaWR1Y29udGVudC5jb20vZ2kudGVzdChjdXJyZW50SHJlZikpewogICAgICAgICAgbG9jYXRpb24uaHJlZj0gQ29uZmlnLnRoaXNVcmw7CiAgICAgICAgfQ=="));
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
