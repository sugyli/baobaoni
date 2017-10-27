@extends('wapdashubao.layouts.default')
@section('title'){{ $bookData->articlename }}全文阅读_{{ $bookData->articlename }}最新章节-{{get_sys_set('wapname')}}-{{get_sys_set('wapuri')}}@endsection
@section('keywords'){{$bookData->slug or ''}},{{ $bookData->articlename }},小说{{ $bookData->articlename }},{{ $bookData->articlename }}最新章节,{{ $bookData->articlename }}全文阅读@endsection
@section('description'){{ $bookData->articlename }}是由{{ $bookData->author }}所写的{{$bookData->getSort()['title'] or '未知分类'}}类小说，本站提供{{ $bookData->articlename }}最新章节观看,{{ $bookData->articlename }}全文阅读等服务，如果您发现{{ $bookData->articlename }}更新慢了,请第一时间联系{{get_sys_set('wapname')}}。@endsection

@section('content')
<div class="header online HeaderTitlePosition">
    书籍详情
    <a href="javascript:" onclick="javascript:history.go(-1);" class="header-left">
      <i class="iconfont icon-fanhui1"></i>
    </a>
    <a class="header-right" v-on:click.stop="addbookcase({{$bookData->articleid}} , 0)">
      <i class="iconfont icon-shoucang"></i>
    </a>
</div>
<div style="padding-top: 45px;" class="container-warp" v-bind:style="'width:'+ screen_width + 'px;'">
	<div class="info_book-page">
	  <div class="u-book-detail">
			<div class="book-cover">
				<img src="{{ $bookData->imgflag }}" alt="{{ $bookData->articlename }}">
			</div>
			<div class="info">
				<h3 class="title online">{{ $bookData->articlename }}</h3>
				<span class="author online">作者：{{ $bookData->author }}</span>
				<p class="online">月推荐：{{ $bookData->getMonthHits() }} </p>
	      <p class="online">周推荐：{{ $bookData->getWeekHits() }} </p>
				<p class="online">日推荐：{{ $bookData->getDayHits() }}  </p>
				<p class="online">状态：<span class="u-booktag-serial">{{ $bookData->fullflag }}</span></p>
			</div>
		</div>
	  <section class="main-card" style="margin-top: -10px;">
	    <div class="wrap">
				<ul class="btn-group">
					<li class="u-btn2">
            <a href="{{route('web.articles.mulu',['bid'=>$bookData->articleid])}}">
	          <span class="book-dash-text"></span>
            </a>
	        </li>
	        <li><a class="u-btn3" v-on:click.stop="tuijian({{$bookData->articleid}})">推荐本书</a></li>
				</ul>
			</div>
	    <div class="u-folder">
				<div class="folder-cnt">
					{{ $bookData->intro }}
				</div>
				<div class="folder-tail">
					<div class="online">最近一次更新 {{formatTime($bookData->lastupdate)}}</div>
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
						{{ $bookData->getSort()['title'] or '未知分类' }}
					</li>
				</ul>
			</div>
		</section>
	  @if ($bookData->relationChapters->count() > 0)
	  <section class="zxjz">
	    <div class="bk">最新 9 章</div>
	      <ul>
	        @foreach ($bookData->relationChapters->reject(function ($value, $key) {
	                        return $value->chaptertype >0;
	                    })->reverse() as $chapter)
	        <li class="online">
	          <a href="{{$chapter->link()}}" title="{{$chapter->chaptername}}">{{$chapter->chaptername}}</a><i></i>
	        </li>
	        @break($loop->iteration >= 9)
	        @endforeach
	      </ul>
	      <div class="gengduo"><a href="/wapbook-88047_1/">查看更多章节&gt;</a></div>
	    </section>
	    @endif
	</div>

@include('wapdashubao.include.foot')

</div>

@endsection
