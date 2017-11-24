@extends('mnovels.layouts.default')
@section('title'){{ $chapter['chaptername'] }}_{{$chapter['articlename']}}-{{config('app.wap_name')}}-{{config('app.url_wap')}}@endsection
@section('keywords'){{$chapter['chaptername']}},{{$chapter['articlename']}}@endsection
@section('description'){{$chapter['chaptername']}}是小说{{$chapter['articlename']}}的最新章节。@endsection
@section('style')
<link rel="stylesheet" type="text/css" href="/css/sweetalert.css" />
<script src="/js/jquery.cookie.js"></script>
<script src="/js/sweetalert.min.js"></script>
@endsection
@section('content')
<div class="read_header online" style="text-align: center;">
    {{$chapter['articlename']}}
    <a class="header-left" href="javascript:history.back()">
      <i class="iconfont icon-fanhui1"></i>
    </a>
    <a class="header-right" href="{{$chapter['infolink']}}">
      <i class="iconfont icon-liebiao"></i>
    </a>
</div>
<div class="my-ad" id='show_read_ad_s_1'></div>
<div v-bind:style="'width:'+ screen_width + 'px;min-height:' + screen_height +'px;'">
  <div class="nr_set">
    <div class="set1" v-on:click="jubaocuowu('{{$chapter['articlename']}}_{{$chapter['chaptername']}}' , '{{request()->url()}}')">
    	报错
    </div>
    <div id="night-day-button">
      <div id="day_icon" class="set1" style="display:none">开灯</div>
      <div id="night_icon" class="set1" style="display:none">关灯</div>
    </div>

		<div class="set2">
			<div id="large-font">
				字 +
			</div>
			<div id="small-font">
				字 -
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

    <div class="nr_page">
  		<a class="nr_page_a" v-on:click.stop="addbookcase({{$chapter['articleid']}} , {{$chapter['chapterid']}})" >书签</a>
      @if($previousChapter)
      <a class="nr_page_a prev_bf" href="{{ $previousChapter['link']}}" target="_top" style="display:none" >上一章</a>
      <input class="nr_page_a nr_page_input prev_bf1" type="button" onclick="location.href= '{{ $previousChapter['link']}}'" value="上一章" />
      @else
      <a class="nr_page_a prev_bf" href="{{ route('mnovels.newmulu',['bid'=>$chapter['articleid'] ,'id'=>$page ] ) }}" target="_top" id="prev_bf" style="display:none" >到头了</a>
      <input class="nr_page_a nr_page_input prev_bf1" type="button" onclick="location.href= '{{ route('mnovels.newmulu',['bid'=>$chapter['articleid'] ,'id'=>$page ] ) }}'" value="到头了" />
      @endif

      <a class="nr_page_a mu_bf" href="{{ route('mnovels.newmulu',['bid'=>$chapter['articleid'] ,'id'=>$page ] ) }}" style="display:none" >目录</a>
      <input class="nr_page_a nr_page_input mu_bf1"  type="button" onclick="location.href= '{{ route('mnovels.newmulu',['bid'=>$chapter['articleid'] ,'id'=>$page ]) }}'" value="目录" />

      @if($nextChapter)
      <a class="nr_page_a next_bf" href="{{ $nextChapter['link'] }}" target="_top" style="display:none" >下一章</a>
      <input class="nr_page_a nr_page_input next_bf1" type="button"  onclick="location.href= '{{ $nextChapter['link'] }}'" value="下一章" />
      @else
      <a class="nr_page_a next_bf" href="{{ $chapter['mulu'] }}" target="_top" style="display:none" >最新？</a>
      <input class="nr_page_a nr_page_input next_bf1" type="button"  onclick="location.href= '{{ $chapter['mulu'] }}'" value="最新？" />
      @endif

  		<a class="nr_page_a" href="{{route('mnovels.bookshelf.index')}}?redirect_url={{request()->url()}}" >书架</a>
  	</div>

    {!!$content!!}
    <div class="my-ad" id='show_read_ad_s_2'></div>
    <div class="my-ad" id='show_read_ad_d_1'></div>
    <div class="nr_page">
  		<a class="nr_page_a" v-on:click.stop="addbookcase({{$chapter['articleid']}} , {{$chapter['chapterid']}})" >书签</a>

      @if($previousChapter)
      <a class="nr_page_a prev_bf" href="{{ $previousChapter['link'] }}" target="_top" style="display:none" >上一章</a>
      <input class="nr_page_a nr_page_input prev_bf1" type="button" onclick="location.href= '{{ $previousChapter['link'] }}'" value="上一章" />
      @else
      <a class="nr_page_a prev_bf" href="{{ route('mnovels.newmulu',['bid'=>$chapter['articleid'] ,'id'=>$page ] ) }}" target="_top" style="display:none" >到头了</a>
      <input class="nr_page_a nr_page_input prev_bf1" type="button" onclick="location.href= '{{ route('mnovels.newmulu',['bid'=>$chapter['articleid'] ,'id'=>$page ] ) }}'" value="到头了" />
      @endif

      <a class="nr_page_a mu_bf" href="{{ route('mnovels.newmulu',['bid'=>$chapter['articleid'] ,'id'=>$page ] ) }}" style="display:none" >目录</a>
      <input class="nr_page_a nr_page_input mu_bf1"  type="button"  onclick="location.href= '{{ route('mnovels.newmulu',['bid'=>$chapter['articleid'] ,'id'=>$page ]) }}'" value="目录" />

      @if($nextChapter)
      <a class="nr_page_a next_bf" href="{{ $nextChapter['link'] }}" target="_top" style="display:none" >下一章</a>
      <input class="nr_page_a nr_page_input next_bf1" type="button" onclick="location.href= '{{ $nextChapter['link'] }}'" value="下一章" />
      @else
      <a class="nr_page_a next_bf" href="{{ $chapter['mulu'] }}" target="_top" style="display:none" >最新？</a>
      <input class="nr_page_a nr_page_input next_bf1" type="button" onclick="location.href= '{{ $chapter['mulu'] }}'" value="最新？" />
      @endif

  		<a class="nr_page_a" href="{{route('mnovels.bookshelf.index')}}?redirect_url={{request()->url()}}" >书架</a>
  	</div>
    <div class="my-ad" id='show_read_ad_d_2'></div>
    <div class="my-ad" id='show_read_ad_d_3'></div>
  </div>
</div>

@endsection
@section('subscripts')
<script>
(function () {
  baobaoni.readApi({{$chapter['articleid']}} , {{$page}} ,{{$weizhi}} ,{{$chapter['chapterid']}} ,'{{$chapter['articlename']}}');
  $(".prev_bf1").hide();
  $(".prev_bf").show();

  $(".mu_bf1").hide();
  $(".mu_bf").show();

  $(".next_bf1").hide();
  $(".next_bf").show();
})()//闭包不影响全局
</script>
<div id="read_ad_s_1" style="display:none">
  <script>read_ad_s_1();</script>
</div>

<div id="read_ad_s_2" style="display:none">
  <script>read_ad_s_2();</script>
</div>

<div id="read_ad_d_1" style="display:none">
  <script>read_ad_d_1();</script>
</div>

<div id="read_ad_d_2" style="display:none">
  <script>read_ad_d_2();</script>
</div>

<div id="read_ad_d_3" style="display:none">
  <script>read_ad_d_3();</script>
</div>
<script>
(function () {
  document.getElementById("show_read_ad_s_1").innerHTML = document.getElementById("read_ad_s_1").innerHTML;
  document.getElementById("read_ad_s_1").innerHTML = "";
  document.getElementById("show_read_ad_s_2").innerHTML = document.getElementById("read_ad_s_2").innerHTML;
  document.getElementById("read_ad_s_2").innerHTML = "";
  document.getElementById("show_read_ad_d_1").innerHTML = document.getElementById("read_ad_d_1").innerHTML;
  document.getElementById("read_ad_d_1").innerHTML = "";
  document.getElementById("show_read_ad_d_2").innerHTML = document.getElementById("read_ad_d_2").innerHTML;
  document.getElementById("read_ad_d_2").innerHTML = "";
  document.getElementById("show_read_ad_d_3").innerHTML = document.getElementById("read_ad_d_3").innerHTML;
  document.getElementById("read_ad_d_3").innerHTML = "";
})()//闭包不影响全局
</script>
@endsection
