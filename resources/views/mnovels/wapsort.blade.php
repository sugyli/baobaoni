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
<div id="root" class="container-warp">
  @include('mnovels.layouts.search')
  <div class="sortcontent">
    <ul>
    @foreach (config('app.fenlei') as $key => $value)
    <li><a href="{{ route('mnovels.showwapsort' ,['bid'=>$key+1]) }}">{{$value}}</a></li>
    @endforeach
    </ul>
  </div>
</div>
@endsection
