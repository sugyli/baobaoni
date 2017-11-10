@extends('mnovels.layouts.default')
@section('title'){{ $chapter['chaptername'] }}_{{$chapter['articlename']}}-{{config('app.wap_name')}}-{{config('app.url_wap')}}@endsection
@section('keywords'){{$chapter['chaptername']}},{{$chapter['articlename']}}@endsection
@section('description'){{$chapter['chaptername']}}是小说{{$chapter['articlename']}}的最新章节。@endsection

@section('content')
<div class="header online" style="text-align: center;">
    {{$chapter['articlename']}}
    <a class="header-left" href="javascript:history.back()">
      <i class="iconfont icon-fanhui1"></i>
    </a>
    <a class="header-right" href="/">
      <i class="iconfont icon-shouye1"></i>
    </a>
</div>
<div v-bind:style="'padding-top:45px;width:'+ screen_width + 'px;min-height:' + screen_height +'px;'">
  <div class="nr_set">
    <baocuo-bnt
      title="{{$chapter['articlename']}}_{{$chapter['chaptername']}}"
      from={{request()->url()}}
    ></baocuo-bnt>
    <div id="night-day-button">
      <div id="day_icon" class="set1" style="display:none">开灯</div>
      <div id="night_icon" class="set1" style="display:none">关灯</div>
    </div>

		<div class="set2">
			<div id="large-font">
				A++
			</div>
			<div id="small-font">
				A--
			</div>
      <div id="beijing-bnt">
        背景
      </div>
      <div v-on:click="tuijian({{ $chapter['articleid'] }})">
        推荐
      </div>
		</div>
		<div class="clear">
		</div>
	</div>
  <div class="child-mod" style="display: none;" id='beijing_container'>
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

  <div id="fiction_container" class="m-read-content">
    <div class="nr_title">
          {{$chapter['chaptername']}}
    </div>
    <div class="m-button-bar">
        <ul class="u-tab">
            <a v-on:click.stop="addbookcase({{$chapter['articleid']}} , {{$chapter['chapterid']}})">
              <li>书签</li>
            </a>
            <a href="{{ $previousChapter['link'] or $chapter['link'] }}" target="_top">
              <li>上一章</li>
            </a>
            <a href="{{ $chapter['mulu'] }}">
              <li>目录</li>
            </a>
            <a href="{{ $nextChapter['link'] or $chapter['link'] }}" target="_top">
              <li>下一章</li>
            </a>
            <a href="{{route('mnovels.bookshelf.index')}}">
              <li>书架</li>
            </a>
        </ul>
    </div>
    {!!$content!!}
    <div class="m-button-bar">
        <ul class="u-tab">
            <a v-on:click.stop="addbookcase({{$chapter['articleid']}} , {{$chapter['chapterid']}})">
              <li>书签</li>
            </a>
            <a href="{{ $previousChapter['link'] or $chapter['link'] }}" target="_top">
              <li>上一章</li>
            </a>
            <a href="{{ $chapter['mulu'] }}">
              <li>目录</li>
            </a>
            <a href="{{ $nextChapter['link'] or $chapter['link'] }}" target="_top">
              <li>下一章</li>
            </a>
            <a href="{{route('mnovels.bookshelf.index')}}">
              <li>书架</li>
            </a>
        </ul>
    </div>
  </div>
</div>

@endsection
@section('subscripts')
<script src="/js/jquery.cookie.js"></script>
<script>
baobaoni.readApi({{$chapter['articleid']}} , {{$page}} ,{{$weizhi}} ,{{$chapter['chapterid']}} ,'{{$chapter['articlename']}}');
</script>

@endsection
