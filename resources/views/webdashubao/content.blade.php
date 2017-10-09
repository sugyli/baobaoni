@extends('webdashubao.layouts.default')
@section('title'){{$chapter->chaptername}}_{{$chapter->articlename}}_{{$sorts['title'] or '未知分类'}}-{{get_sys_set('webname')}}-{{get_sys_set('weburi')}}@endsection
@section('keywords'){{$chapter->chaptername}},{{$chapter->articlename}}@endsection
@section('description'){{$chapter->articlename}}是一本{{$sorts['title'] or '未知分类'}}类小说，{{$chapter->chaptername}}是小说{{$chapter->articlename}}的最新章节。@endsection
@section('content')
@include('webdashubao.packaging.logo-nav-qiandao')
<div class="read_t">
当前位置：<a href="/">首页</a> &gt; <a href="{{ $sorts['uri'] or '/'}}">{{$sorts['title'] or '未知分类'}}</a> &gt; <a href="{{$bookData->link()}}">{{ $chapter->articlename }}</a> &gt;  {{$chapter->chaptername}}
</div>
<div class="read_b re f-cb">
  <user-booknrbnt
  bid={{$chapter->articleid}}
  cid={{$chapter->chapterid}}
  addbookcaseurl="{{ route('webajax.bookshelf.addbookcase') }}"
  recommend="{{route('webajax.user.recommend')}}"
  newmessageurl="{{route('member.outboxs.create')}}?title={{ $chapter->articlename}}_{{ $chapter->chaptername}}&amp;from={{request()->url()}}"
  ></user-booknrbnt>
</div>
<div class="novel re">
  <h1>{{$chapter->chaptername}}</h1>
  <div class="pereview f-cb">
    <a href="{{ getChapterUrl($previousChapter ,$bookData) }}" target="_top" title="{{ $previousChapter->chaptername or  $chapter->articlename}}">← 上一章</a><a class="back" href="{{$bookData->link()}}" target="_top" title="{{$bookData->articlename}}">返回目录</a><a href="{{ getChapterUrl($nextChapter , $bookData) }}" target="_top" title="{{ $nextChapter->chaptername or  $chapter->articlename}}">下一章 →</a>
  </div>

  <div class="yd_text2">
    {!!$content!!}
  </div>

  <div class="pereview f-cb">
    <a href="{{ getChapterUrl($previousChapter ,$bookData) }}" target="_top" title="{{ $previousChapter->chaptername or  $chapter->articlename}}">← 上一章</a><a class="back" href="{{$bookData->link()}}" target="_top" title="{{$bookData->articlename}}">返回目录</a><a href="{{ getChapterUrl($nextChapter , $bookData) }}" target="_top" title="{{ $nextChapter->chaptername or  $chapter->articlename}}">下一章 →</a>
  </div>

</div>

@endsection

@section('subscripts')
<script type="text/javascript">
var preview_page = "{{ getChapterUrl($previousChapter ,$bookData) }}";
var next_page = "{{ getChapterUrl($nextChapter , $bookData) }}";
var index_page = "{{$bookData->link()}}";
function jumpPage() {
  if (event.keyCode==37) location=preview_page;
  if (event.keyCode==39) location=next_page;
  if (event.keyCode==13) location=index_page;
}
document.onkeydown=jumpPage;
baobaoni.LAST_READ_SET("{{$bookData->link()}}", "{{request()->url()}}", "{{$chapter->articlename}}", "{{$chapter->chaptername}}");
baobaoni.setStatus();
baobaoni.toTop();
</script>
@endsection
