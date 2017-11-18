@extends('mnovels.layouts.default')
@section('title')排行榜_{{config('app.wap_name')}}-{{config('app.url_wap')}}@endsection
@section('keywords')排行榜@endsection
@section('description')排行榜@endsection
@section('content')
<div class="header online" style="text-align: center;">
    排行榜
    <a class="header-left" href="javascript:history.back()">
      <i class="iconfont icon-fanhui1"></i>
    </a>
    <a class="header-right" href="/">
      <i class="iconfont icon-shouye1"></i>
    </a>
</div>
<div v-bind:style="'width:'+ screen_width + 'px;'" class="container-warp">
  <section class="i-top">
    <a href="/newsearch">
  		<div class="i-top-search">输入书名/作者/关键字</div>
  	</a>
  </section>
  <div class="sortcontent">
    <ul>
    <li><a href="{{ route('mnovels.showwaptop',['any'=>'newbook']) }}">最新入库</a></li>
    <li><a href="{{ route('mnovels.showwaptop',['any'=>'updatebook']) }}">最新更新</a></li>
    <li><a href="{{ route('mnovels.showwaptop',['any'=>'dayhit']) }}">日推荐榜</a></li>
    <li><a href="{{ route('mnovels.showwaptop',['any'=>'weekhit']) }}">周推荐榜</a></li>
    <li><a href="{{ route('mnovels.showwaptop',['any'=>'monthhit']) }}">月推荐榜</a></li>
    </ul>
  </div>
</div>
@endsection
