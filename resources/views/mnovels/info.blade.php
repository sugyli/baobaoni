@extends('mnovels.layouts.default')
@section('title'){{ $bookData['articlename'] }}全文阅读_{{ $bookData['articlename'] }}最新章节-{{config('app.wap_name')}}-{{config('app.url_wap')}}@endsection
@section('keywords'){{$bookData['slug']}},{{ $bookData['articlename'] }},小说{{ $bookData['articlename'] }},{{ $bookData['articlename'] }}最新章节,{{ $bookData['articlename'] }}全文阅读@endsection
@section('description'){{ $bookData['articlename'] }}是由{{ $bookData['author'] }}所写的{{ $bookData['sort']}}类小说，本站提供{{ $bookData['articlename'] }}最新章节观看,{{ $bookData['articlename'] }}全文阅读等服务，如果您发现{{ $bookData['articlename'] }}更新慢了,请第一时间联系{{config('app.wap_name')}}。@endsection
@section('content')
<div class="header online" style="text-align: center;">
    {{ $bookData['articlename'] }}
    <a class="header-left" href="/">
      <i class="iconfont icon-fanhui1"></i>
    </a>
    <a class="header-right" href="{{ route('mnovels.hislogs') }}">
      <i class="iconfont icon-lishi"></i>
    </a>
</div>
<div id="root" class="container-warp">
  @include('mnovels.layouts.search')
  <div class="my-ad" id="show_info_ad_s">
  </div>
  <div class="cover">
    <div class="block">
        <div class="block_img">
          <img src="{{$bookData['imgflag']}}" onerror="this.src='{{config('app.dfxsfmdir')}}'">
        </div>
        <div class="block_txt">
           <h2>{{$bookData['articlename']}}</h2>
          <p>
            作者：{{$bookData['author']}}
          </p>
          <p>
            更新：{{$bookData['updatetime']}}
          </p>
          <p>
            状态：{{$bookData['fullflag']}}
          </p>
          <p>
            标签：{{$bookData['sort']}}
          </p>
        </div>
    </div>
    <div class="clear"></div>
    <div id="notice">
        @foreach ($bookData['relation_chapters'] as $chapter)
        <input type="button" onclick="location.href= '{{$chapter['link']}}'" value="开始阅读">
        @break($loop->iteration >= 1)
        @endforeach
        <input type="button" onclick="location.href= '{{$bookData['newmulu']}}'" value="查看目录">
  	</div>
    <div class="ablum_read chapterlist" style="display:none">
      @foreach ($bookData['relation_chapters'] as $chapter)
      <span class="left"><a href="{{$chapter['link']}}">开始阅读</a></span>
      @break($loop->iteration >= 1)
      @endforeach
  		<span><a href="javascript:void(0)" onclick="baobaoni.tuijian({{$bookData['articleid']}})">推荐本书</a></span>
  	</div>
    <div class="ablum_read chapterlist" style="display:none">
      <span class="left"><a href="{{ $bookData['newmulu'] }}">章节目录</a></span>
      <span><a href="javascript:void(0)" onclick="baobaoni.addbookcase( {{ $bookData['articleid'] }} , 0)">收藏本书</a></span>
    </div>
    <div class="intro">
  		小说简介
  	</div>
    <div class="intro_info">
  		{{$bookData['intro']}}
  	</div>
    <div class="my-ad" id="show_info_ad_z">
    </div>
    <div class="intro">
  		最新章节预览
  	</div>
    @if (count($bookData['relation_chapters']) > 0)
    <ul class="chapter">
      @foreach (array_reverse($bookData['relation_chapters']) as $chapter)
  		  <li><a href="{{$chapter['link']}}">{{$chapter['chaptername']}}<span>{{$chapter['updatetime']}}</span></a></li>
      @break($loop->iteration >= 9)
      @endforeach
  	</ul>
    @endif
  </div>
  <div class="my-ad" style="margin-top:5px;" id='show_info_ad_d'>

  </div>
  @include('mnovels.layouts.foot')
</div>
@endsection
@section('subscripts')
<div id="info_ad_s" style="display:none">
  <script>info_ad_s();</script>
</div>
<div id="info_ad_z" style="display:none">
  <script>info_ad_z();</script>
</div>
<div id="info_ad_d" style="display:none">
  <script>info_ad_d();</script>
</div>
<script>
(function () {
  $("#notice").hide();
  $(".chapterlist").show();

  document.getElementById("show_info_ad_s").innerHTML = document.getElementById("info_ad_s").innerHTML;
  document.getElementById("info_ad_s").innerHTML = "";

  document.getElementById("show_info_ad_z").innerHTML = document.getElementById("info_ad_z").innerHTML;
  document.getElementById("info_ad_z").innerHTML = "";

  document.getElementById("show_info_ad_d").innerHTML = document.getElementById("info_ad_d").innerHTML;
  document.getElementById("info_ad_d").innerHTML = "";
})()//闭包不影响全局
</script>
@endsection
