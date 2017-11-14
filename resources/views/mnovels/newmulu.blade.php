@extends('mnovels.layouts.default')
@section('title'){{$title}}最新章节_{{config('app.wap_name')}}-{{config('app.url_wap')}}@endsection
@section('keywords'){{$title}}最新章节|{{$title}}手机阅读|{{config('app.wap_name')}}@endsection
@section('description'){{$title}}最新章节由网友提供，{{$title}}情节跌宕起伏、扣人心弦，是一本情节与文笔俱佳的综合类型，{{config('app.wap_name')}}免费提供{{$title}}最新清爽干净的文字章节在线手机阅读。@endsection
@section('style')
<style>

.fk {
    list-style: none;
    border: 1px solid #ddd;
    border-radius: 3px;
    background-color: #fff;
    margin: 10px;

}
.xbk {
    border-color: #E2E2E2;
}
.zjlb .lb a {
    display: block;
    border-bottom-width: 1px;
    border-bottom-style: solid;
    height: 35px;
    line-height: 35px;
    margin: 0px 5px;
}
.zjlb .lb .last {
    border-bottom-width: 0px;
}
.tb {
    color: #1ABC9C;
}

.fenye {
    margin: 10px;
}
.fenye .fy {
    float: left;
    width: 75%;
    margin-left: 1%;
    margin-right: 2%;
    margin-left: 0px;
}
.fenye .showpage {
    position: fixed;
    display: none;
    width: 80%;
    height: 60%;
    top: 15%;
    left: 10%;
    background-color: #fff;
    z-index: 2147483647;
}
.r3 {
    border-radius: 3px;
}
.fenye .showpage div {
    border-bottom-style: solid;
    border-bottom-width: 1px;
    height: 40px;
    line-height: 40px;
    text-align: center;
}
.bk {
    border-color: #CCC;
    background-color: #fff;
}
.fenye .showpage ul {
    position: absolute;
    top: 40px;
    bottom: 0px;
    left: 10px;
    right: 10px;
    overflow: auto;
}

.fenye .showpage a {
    display: block;
    border-bottom-style: solid;
    border-bottom-width: 1px;
    height: 40px;
    line-height: 40px;
    margin: 0px 10px;
    font-size: 12px;
}
.fenye .showpage .this {
    background: right center no-repeat url(/images/yes.gif);
}
.fenye .desc {
    float: right;
    width: 18%;
    margin-right: 0%;
}
.fenye .desc a {
    display: block;
    color: #fff;
    text-align: center;
    height: 30px;
    line-height: 30px;
}
.dise {
    background-color: #1ABC9C;
}
.r2 {
    border-radius: 2px;
}
.cc {
    height: 0px;
    clear: both;
}
#spagebg {
    display: none;
    position: absolute;
    left: 0px;
    right: 0px;
    top: 0px;
    background-color: #000;
    z-index: 2147483647;
}
.spage {
    width: 100%;
    height: 30px;
    line-height: 30px;
    border-style: solid;
    border-width: 1px;
    padding: 0px 5px;
    text-align: center;
    border-color: #1ABC9C;
    background: #fff no-repeat center right url(/images/list2.png);
    border-radius: 3px;
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
  <div class="my-ad" id="show_mulu_ad_s">
  </div>
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
    @include('mnovels.layouts.foot')
  </div>
  </section>
</div>
  <div style="padding-top:150px;text-align:center; padding-bottom:150px;" id="mululist">
    <input type="button" style="font-size:20px" onclick="location.href= '{{route('mnovels.newmulu',['bid'=>$bid , 'id'=>1])}}'" value="被百度转码点击下切换">
  </div>
  <div class="my-ad" id="show_mulu_ad_d">
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
$("#mululist").hide();
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
