@extends('mnovels.layouts.default')
@section('title')分类列表_{{config('app.wap_name')}}-{{config('app.url_wap')}}@endsection
@section('keywords')分类列表@endsection
@section('description')分类列表@endsection
@section('content')
<div class="header online" style="text-align: center;">
    分类列表
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
    @foreach (config('app.fenlei') as $key => $value)
    <li><a href="{{ route('mnovels.showwapsort' ,['bid'=>$key+1]) }}">{{$value}}</a></li>
    @endforeach
    </ul>
  </div>
</div>
@endsection
