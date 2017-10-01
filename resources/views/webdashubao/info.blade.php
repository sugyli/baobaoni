@extends('webdashubao.layouts.default')
@section('title'){{ $bookData->articlename }}全文阅读_{{ $bookData->articlename }}最新章节-{{config('app.title_index')}}@endsection
@section('keywords'){{$bookData->slug or ''}},{{ $bookData->articlename }},小说{{ $bookData->articlename }},{{ $bookData->articlename }}最新章节,{{ $bookData->articlename }}全文阅读@endsection
@section('description'){{config('app.des_index')}}@endsection

@section('content')
@include('webdashubao.packaging.logo-nav-jilu-qiandao')
<section class="jieshao re f-cb">
  <div class="lf jieshao-cove">
    <img src="{{ $bookData->imgflag }}" alt="{{ $bookData->articlename }}" onerror="this.src='{{config('app.dfxsfmdir')}}'" />
  </div>
  <div class="rt jieshao-main">
    <h1>{{ $bookData->articlename }}</h1>
    <div class="msg">
      <em>作者：{{ $bookData->author }} </em><em>状态：{{ $bookData->fullflag }} </em><em>日推荐：{{ $bookData->getDayHits() }} </em><em>周推荐：{{ $bookData->getWeekHits() }} </em><em>月推荐：{{ $bookData->getMonthHits() }} </em><em>更新时间：{{formatTime($bookData->lastupdate)}}</em><em>最新章节：<a href="{{ route('articles.content' ,['article'=>$bookData->articleid ,'cid'=>$bookData->lastchapterid]) }}">{{$bookData->lastchapter}}</a></em>
    </div>
    <div class="info f-cb" style="line-height: 23px;height: 23px;">
      <user-bookinfobnt
          bid={{$bookData->articleid}}
          cid=0
          addbookcaseurl="{{route('ajax.bookshelf.addbookcase')}}"
          recommend="{{route('ajax.member.recommend')}}"
          newmessageurl="{{route('outboxs.create')}}?title={{ $bookData->articlename}}&amp;from={{request()->url()}}"
      ></user-bookinfobnt>
    </div>
    <div class="tags_wrap">
  		<a href='{{ $sorts->uri or '/'}}'>{{$sorts->title or '未知分类'}}</a>
      <a href='{{ $sorts->uri or '/'}}'>{{$sorts->title or '未知分类'}}</a>
  	</div>
    <div class="intro">
        {{ $bookData->intro }}
    </div>
  </div>
</section>

@if ($bookData->relationChapters->count() > 0)
<div class="mulu re Displayanimation">
  <dl>
  @foreach ($bookData->relationChapters as $chapter)
    @if($chapter->chaptertype >0)
    <dt>
      分卷 {{$chapter->chaptername}}
    </dt>
    @else
    <dd><a href="{{$chapter->link()}}" title="{{$chapter->chaptername}}">{{$chapter->chaptername}}</a></dd>
    @endif
  @endforeach
  </dl>
</div>
@endif


@endsection
