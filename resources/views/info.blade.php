@extends('layouts.default')
@section('title'){{ $bookData['articlename'] }}全文阅读_{{ $bookData['articlename'] }}最新章节-{{config('app.name')}}-{{config('app.url')}}@endsection
@section('keywords'){{$bookData['slug']}},{{ $bookData['articlename'] }},小说{{ $bookData['articlename'] }},{{ $bookData['articlename'] }}最新章节,{{ $bookData['articlename'] }}全文阅读@endsection
@section('description'){{ $bookData['articlename'] }}是由{{ $bookData['author'] }}所写的{{ $bookData['sort']}}类小说，本站提供{{ $bookData['articlename'] }}最新章节观看,{{ $bookData['articlename'] }}全文阅读等服务，如果您发现{{ $bookData['articlename'] }}更新慢了,请第一时间联系{{config('app.name')}}。@endsection

@section('style')
<style>
.info_book-page .u-book-detail {
    padding: 40px;
    display: table;
    width: 100%;
    box-sizing: border-box;
    position: relative;
    overflow: hidden;
}
.info_book-page .u-book-detail .book-cover {
    width: 100px;
    height: 134px;
    position: relative;
    background: #eeece9;
    box-shadow: 0px 6px 5px -3px #aaa;
    border: 1px solid #f0f0f0;
    border-bottom: none;
    overflow: hidden;
}
.info_book-page .u-book-detail .book-cover img {
    width: 100%;
    height: 100%;
}

.info_book-page .u-book-detail .info {
    padding: 0 0 0 14px;
    display: table-cell;
    vertical-align: middle;
}
.u-book-detail .info .title {
    margin-bottom: :13px;
    font-size: 16px;
}
.u-book-detail .info .author {
    margin-right: 5px;
    color: #4b99a7;
}

.u-book-detail .info .u-booktag-serial{
    border: 1px solid #00a0e9;
    border-radius: 4px;
    font-size: 12px;
    line-height: 16px;
    display: inline-block;
    padding: 0 2px;
    color: #63bd6e;
    border-color: #63bd6e;
}
.main-card {
    border-bottom: 10px solid #f5f5f5;

}
.info_book-page .main-card .wrap {
    padding: 0 14px;
    margin: 0 0 27px;
}
.info_book-page .main-card .wrap .btn-group {
    width: 100%;
    font-size: 0;
    white-space: nowrap;
}
.info_book-page .main-card .wrap .btn-group li:first-child {
    margin-right: 2%;
}
.info_book-page .main-card .wrap .btn-group li {
    display: inline-block;
    width: 49%;
}
.u-btn2, .u-btn3, .u-btn4, .u-btn-disable {
    display: block;
    height: 2.8em;
    line-height: 2.8em;
    text-align: center;
    color: #737373;
    border: 1px solid #ddd;
    background: #fff;
    border-radius: 4px;
    font-size: 14px;
    -webkit-box-sizing: border-box;
}
.u-btn2, .u-btn3 {
    position: relative;
}
.u-btn2, .u-btn4 {
    background: #f35d02;
    border: 1px solid #e35109;
    color: #fff;
    padding: 0 10px;
}
.book-dash-text{
  color: #fff;
}
.book-dash-text:after {
    content: '\5f00\59cb\9605\8bfb';
}

.u-folder>.folder-cnt {
    position: relative;
    line-height: 1.6;
    padding: 0 14px;
    margin-bottom: 10px;
    font-size: 14px;
    color: #585858;
}
.u-folder>.folder-tail {
    text-align: center;
    font-size: 14px;
    border-top: 1px solid #f0f0f0;
    color: #8d8d8d;
}
.u-folder>.folder-tail>div {
    padding: 10px 14px;
}
.u-folder>.folder-top {
    font-size: 16px;
    font-weight: normal;
    color: #8d8d8d;
    padding: 14px 14px 8px;
}
.folder-cnt .m-tag {
    line-height: 1;
    overflow: hidden;
}
.folder-cnt .m-tag .u-tag {
    margin: 0 10px 5px 0;
    display: inline-block;
    width: auto;
    line-height: 1.8em;
    padding: 0 20px;
    color: #766d5d;
    border-radius: 4px;
    background: #909da8;
    font-size: 14px;
    text-align: center;
    border: 1px solid #d3d3d3;
}
.zxjz {
    padding: 0px 10px;
    background-color: #fff;
    margin: 10px;

}
.zxjz .bk {
    border-bottom-width: 1px;
    border-bottom-style: solid;
    line-height: 35px;
    height: 35px;
    border-color: #CCC;
    background-color: #fff;
}
.zxjz li {
    position: relative;
}
.zxjz li a {
    display: block;
    line-height: 40px;
    height: 40px;
    border-bottom: 1px solid #eee;
}

.zxjz .gengduo {
    text-align: center;
    line-height: 45px;
    height: 45px;
}
.zxjz .gengduo a {
    color: #666;
    font-family: Verdana, Geneva, sans-serif;
    display: block;
}
.zxjz li i {
    position: absolute;
    top: 0px;
    right: 0px;
    width: 15px;
    height: 40px;
    background: center url(/images/list.png) no-repeat;
}
</style>
@endsection
@section('content')
  <div class="header online" style="text-align: center;">
      书籍详情
      <a class="header-left" href="javascript:" onclick="javascript:history.go(-1);">
        <i class="iconfont icon-fanhui1"></i>
      </a>
      <a class="header-right" v-on:click.stop="addbookcase({{$bookData['articleid']}} , 0)">
        <i class="iconfont icon-shoucang"></i>
      </a>
  </div>

  <div style="padding-top: 45px; background: #fff;" class="container-warp" v-bind:style="'width:'+ screen_width + 'px;'">
    <div class="info_book-page">
      <div class="u-book-detail">
        <div class="book-cover">
          <img src="{{ $bookData['imgflag'] }}" alt="{{ $bookData['articlename'] }}">
        </div>
        <div class="info">
          <h3 class="title online">{{ $bookData['articlename'] }}</h3>
          <span class="author online">作者：{{ $bookData['author'] }}</span>
          <p class="online">月推荐：0 </p>
          <p class="online">周推荐：0 </p>
          <p class="online">日推荐：0  </p>
          <p class="online">状态：<span class="u-booktag-serial">{{ $bookData['fullflag'] }}</span></p>
        </div>
      </div>
      <section class="main-card" style="margin-top: -10px;">
        <div class="wrap">
          <ul class="btn-group">
            <li class="u-btn2">
              <a href="{{ $bookData['mulu'] }}">
              <span class="book-dash-text"></span>
              </a>
            </li>
            <li><a class="u-btn3"  v-on:click.stop="tuijian({{$bookData['articleid']}})">推荐本书</a></li>
          </ul>
        </div>
        <div class="u-folder">
          <div class="folder-cnt">
            {{ $bookData['intro'] }}
          </div>
          <div class="folder-tail">
            <div class="online">最近一次更新 {{ $bookData['updatetime'] }}</div>
          </div>
        </div>
      </section>
      <section class="main-card u-folder">
        <div class="folder-top">
          <h3>类别标签</h3>
        </div>
        <div class="folder-cnt">
          <ul class="m-tag -color">
            <li class="u-tag">
              {{ $bookData['sort'] }}
            </li>
          </ul>
        </div>
      </section>
      @if (count($bookData['relation_chapters']) > 0)
      <section class="zxjz">
        <div class="bk">最新 9 章</div>
          <ul>
            @foreach (array_reverse($bookData['relation_chapters']) as $chapter)
            <li class="online">
              <a href="{{$chapter['link']}}" title="{{$chapter['chaptername']}}">{{$chapter['chaptername']}}</a><i></i>
            </li>
            @break($loop->iteration >= 9)
            @endforeach
          </ul>
          <div class="gengduo"><a href="{{ $bookData['mulu'] }}">查看更多章节&gt;</a></div>
        </section>
        @endif
    </div>
  </div>
  @include('layouts.foot')
</div>
@endsection
