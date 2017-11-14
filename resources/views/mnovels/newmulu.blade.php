@extends('mnovels.layouts.default')
@section('title'){{$title}}最新章节_{{config('app.wap_name')}}-{{config('app.url_wap')}}@endsection
@section('keywords'){{$title}}最新章节|{{$title}}手机阅读|{{config('app.wap_name')}}@endsection
@section('description'){{$title}}最新章节由网友提供，{{$title}}情节跌宕起伏、扣人心弦，是一本情节与文笔俱佳的综合类型，{{config('app.wap_name')}}免费提供{{$title}}最新清爽干净的文字章节在线手机阅读。@endsection
@section('style')
<style>
.chapter li {
    border-bottom: 1px solid #efefef;
    height: 35px;
    line-height: 35px;
    color: #999;
    display: list-item;
    padding-left: 10px;
}
.chapter li a {
    display: block;
    border-radius: 4px;
    overflow: hidden;
}
.chapter .page {
    height: auto;
    padding-top: 10px;
    text-align: center;
}
.chapter .page a {
    display: inline-block;
    text-align: center;
    height: 30px;
    line-height: 30px;
    padding: 0 15px;
    margin-right: 5px;
    border-radius: 4px;
    background: #208181;
    color: #fff;
}
</style>
@endsection
@section('content')
<div class="header online" style="text-align: center;">
    {{$title}}
    <a class="header-left" href="javascript:history.back()">
      <i class="iconfont icon-fanhui1"></i>
    </a>
    <a class="header-right" href="/">
      <i class="iconfont icon-shouye1"></i>
    </a>
</div>
<div v-bind:style="'width:'+ screen_width + 'px;'" class="container-warp">
  <div class="my-ad" id="show_mulu_ad_s"></div>
  <section id="zjlb" class="zjlb" style="display:none">
    <div class="fenye">
      <div class="fy">{!! $pageset !!}</div>
        <div class="desc">
          <span>
            @if($sort)
            <a href="{{route('mnovels.newmulu',['bid'=>$bid ,'id'=>1])}}" class="dise r2">正序</a>
            @else
            <a href="{{route('mnovels.newmulu1',['bid'=>$bid ,'id'=>1 ,'zid'=>1])}}" class="dise r2">倒序</a>
            @endif
          </span>
        </div>
        <div class="cc"></div>
    </div>
    <ul class="lb fk">
      @foreach ($chapters as $chapter)
        <li><a href="{{$chapter['link']}}" class="xbk online" id="{{$chapter['chapterid']}}">{{$chapter['chaptername']}}</a></li>
      @endforeach
        <li><a class="last tb">本页章节列表结束！</a></li>
    </ul>
    <div class="fenye">
      <div class="fy">{!! $pageset !!}</div>
        <div class="desc">
          <span>
            @if($sort)
            <a href="{{route('mnovels.newmulu',['bid'=>$bid ,'id'=>1])}}" class="dise r2">正序</a>
            @else
            <a href="{{route('mnovels.newmulu1',['bid'=>$bid ,'id'=>1 ,'zid'=>1])}}" class="dise r2">倒序</a>
            @endif
          </span>
        </div>
        <div class="cc"></div>
    </div>
  </div>
  </section>
  <div class="chapter" id="chapter">
    <ul>
        @foreach ($chapters as $chapter)
    		<li><a href="{{$chapter['link']}}">{{$chapter['chaptername']}}</a></li>
        @endforeach
    </ul>
    <div class="page">
      <a href="{{route('mnovels.newmulu',['bid'=>$bid ,'id'=>$pevpage ] )}}">上一页</a>
    	<a href="{{route('mnovels.newmulu',['bid'=>$bid ,'id'=>$nextpage] )}}">下一页</a>
    </div>
  </div>
  <div class="my-ad" id="show_mulu_ad_d">
  </div>
  @include('mnovels.layouts.foot')

</div>

@endsection
@section('subscripts')
<div id="mulu_ad_s" style="display:none">
  <script>mulu_ad_s();</script>
</div>
<div id="mulu_ad_d" style="display:none">
  <script>mulu_ad_d();</script>
</div>
<script>
$("#chapter").hide();
$("#zjlb").show();
$("#zjlb .spage").click(function(){$("#zjlb .showpage").show(300);
$("#spagebg").css("opacity","0.7").fadeIn(500).height($("body").height());  });
$("#spagebg").click(function(){$(this).fadeOut(700);$("#zjlb .showpage").hide(300);});
var pageItem = Util.StorageGetter('muluobj_'+{{$bid}});

if(pageItem){
   $("#"+pageItem.cid).css("color","red");
}

document.getElementById("show_mulu_ad_s").innerHTML = document.getElementById("mulu_ad_s").innerHTML;
document.getElementById("mulu_ad_s").innerHTML = "";

document.getElementById("show_mulu_ad_d").innerHTML = document.getElementById("mulu_ad_d").innerHTML;
document.getElementById("mulu_ad_d").innerHTML = "";
</script>
<script defer src="{{ route( 'mnovels.checkupsql',['bid'=>$bid] ) }}"></script>
@endsection
