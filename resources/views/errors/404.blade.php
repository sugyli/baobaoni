@extends('mnovels.layouts.default')
@section('title')鸟不拉屎的地方@endsection
@section('keywords')鸟不拉屎的地方@endsection
@section('description')鸟不拉屎的地方@endsection
@section('style')
<style>
  .section .error {
      width: 155px;
      height: 65px;
      background: url(/images/error.png) no-repeat;
      background-size: 100%;
      margin: 175px auto 15px;
  }
  .section p {
      font-size: 1.5rem;
      color: #6d6c6c;
      margin-bottom: 15px;
      text-align: center;
  }

</style>
@endsection
@section('content')
<div class="header online" style="text-align: center;">
    出错了请返回首页
    <a class="header-left" href="/">
      <i class="iconfont icon-fanhui1"></i>
    </a>
</div>
<div v-bind:style="'width:'+ screen_width + 'px;'" class="container-warp section">
  <div class="error"></div>
  <p>对不起，您访问的页面暂时无法显示！</p>
  <p><a href="/">返回首页</a></p>
</div>
@endsection
