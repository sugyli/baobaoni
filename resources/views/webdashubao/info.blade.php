@extends('webdashubao.layouts.default')
@section('title'){{ $bookData->articlename }}全文阅读_{{ $bookData->articlename }}最新章节-{{get_sys_set('webname')}}-{{get_sys_set('weburi')}}@endsection
@section('keywords'){{$bookData->slug or ''}},{{ $bookData->articlename }},小说{{ $bookData->articlename }},{{ $bookData->articlename }}最新章节,{{ $bookData->articlename }}全文阅读@endsection
@section('description'){{ $bookData->articlename }}是由{{ $bookData->author }}所写的{{$sorts->title or '未知分类'}}类小说，本站提供{{ $bookData->articlename }}最新章节观看,{{ $bookData->articlename }}全文阅读等服务，如果您发现{{ $bookData->articlename }}更新慢了,请第一时间联系{{get_sys_set('webname')}}。@endsection

@section('content')
@include('webdashubao.packaging.logo-nav-jilu-qiandao')
<section class="jieshao re f-cb">
  <div class="lf jieshao-cove">
    <img src="{{ $bookData->imgflag }}" alt="{{ $bookData->articlename }}" onerror="this.src='{{get_sys_set('dfxsfmdir')}}'" />
  </div>
  <div class="rt jieshao-main">
    <h1>{{ $bookData->articlename }}</h1>
    <div class="msg">
      <em>作者：{{ $bookData->author }} </em><em>状态：{{ $bookData->fullflag }} </em><em>今日推荐：{{ $bookData->getDayHits() }} </em><em>周推荐：{{ $bookData->getWeekHits() }} </em><em>月推荐：{{ $bookData->getMonthHits() }} </em><em>更新时间：{{formatTime($bookData->lastupdate)}}</em><em>最新章节：<a href="{{ route('web.articles.content' ,['article'=>$bookData->articleid ,'cid'=>$bookData->lastchapterid]) }}">{{$bookData->lastchapter}}</a></em>
    </div>
    <div class="info f-cb" style="line-height: 23px;height: 23px;">

      <user-bookinfobnt
          bid={{$bookData->articleid}}
          cid=0
          addbookcaseurl="{{route('webajax.bookshelf.addbookcase')}}"
          recommend="{{route('webajax.user.recommend')}}"
          newmessageurl="{{route('member.outboxs.create')}}?title={{ $bookData->articlename}}&amp;from={{request()->url()}}"
      ></user-bookinfobnt>

    </div>
    <div class="tags_wrap">
  		<a href='{{ $sorts->uri or '/'}}'>{{ $sorts->title or '未知分类' }}</a>
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
@section('subscripts')
<script type="text/javascript">
baobaoni.toTop();
</script>
@endsection
