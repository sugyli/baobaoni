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
<link rel="stylesheet" type="text/css" href="/webdashubao/css/all.css">
<link rel="shortcut icon" href="/favicon.ico"/>
</head>
@yield('style')
<div id="app">
    @include('webdashubao.components.header')

    @yield('content')
    @include('webdashubao.components.footer')
</div>
@section('scripts')
<script src="{{ mix('/webdashubao/vue/app.js') }}"></script>
@show
@section('subscripts')
@show
</body>
</html>
