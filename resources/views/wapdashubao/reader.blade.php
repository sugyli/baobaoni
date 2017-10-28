@extends('wapdashubao.layouts.default')
@section('title'){{$chapter->chaptername}}_{{$chapter->articlename}}-{{get_sys_set('wapname')}}-{{get_sys_set('wapuri')}}@endsection
@section('keywords'){{$chapter->chaptername}},{{$chapter->articlename}}@endsection
@section('description'){{$chapter->chaptername}}是小说{{$chapter->articlename}}的最新章节。@endsection

@section('content')
<div v-bind:style="'min-height:'+screen_height +'px;'">
    <div class="artical-action-mid" id="action_mid"></div>
    <div id="top_nav" class="reader_top_nav" style="display: none;">
    		<a class="reader__back" href="javascript:" onclick="javascript:history.go(-1);"></a>返回
        <a class="reader__more" href="/search"><i class="iconfont icon-soushuo"></i></a>
    </div>
    </user-report>
    <div class="online" style="padding-left:5px;color: #555555;">书名：{{ $chapter->articlename }}</div>
    <div id="fiction_container" class="m-read-content">
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
          <span>功能1</span>
          <button class="font-size-button" v-on:click="tuijian({{$chapter->articleid}})">推荐</button>
          <button class="font-size-button" v-on:click="addbookcase({{$chapter->articleid}} , {{$chapter->chapterid}})">收藏</button>
      </div>
      <div class="child-mod">
          <span>功能2</span>
          <button class="font-size-button" onclick="window.location.href='{{route('member.outboxs.create')}}?title=书名：{{ $chapter->articlename}}_章节名：{{ $chapter->chaptername}}&amp;from=来路：{{request()->url()}}&amp;redirect_url={{request()->url()}}'">举报</button>
          <button class="font-size-button" onclick="window.location.href='{{route('member.bookshelf.index')}}?redirect_url={{request()->url()}}'">书架</button>
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
        <a href="/">首页</a>
        <a href="{{ getChapterUrl($nextChapter , $bookData) }}" target="_top" title="{{ $nextChapter->chaptername or  $chapter->articlename}}">下一章</a>
      </div>
      <a class="reader__ft" href="{{ route('web.articles.mulu',['bid'=>$chapter->articleid]) }}" target="_top">
        <div class="reader__ft_i">
            <i class="iconfont icon-liebiao"></i>
        </div>
        <div class="reader__ft_text">
              目录
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
</div>
@endsection
@section('subscripts')
<script>
baobaoni.readApi();
baobaoni.saveMuluHistory( {{$chapter->articleid}} , {{$page}} ,{{$weizhi}} ,{{$chapter->chapterid}});
</script>
@endsection
