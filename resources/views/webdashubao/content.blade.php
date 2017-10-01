@extends('webdashubao.layouts.default')
@section('content')
@include('webdashubao.packaging.logo-nav-qiandao')
<div class="read_t">
当前位置：<a href="/">首页</a> &gt; <a href="{{ $sorts->uri or '/'}}">{{$sorts->title or '未知分类'}}</a> &gt; <a href="{{ route('articles.show',['bid'=>$chapter->articleid]) }}">{{ $chapter->articlename }}</a> &gt;  {{$chapter->chaptername}}
</div>
<div class="read_b re f-cb">
  <user-booknrbnt
  bid={{$chapter->articleid}}
  cid={{$chapter->chapterid}}
  addbookcaseurl="{{route('ajax.bookshelf.addbookcase')}}"
  recommend="{{route('ajax.member.recommend')}}"
  newmessageurl="{{route('outboxs.create')}}?title={{ $chapter->articlename}}_{{ $chapter->chaptername}}&amp;from={{request()->url()}}"
  ></user-booknrbnt>
</div>
<div class="novel re">
  <h1>{{$chapter->chaptername}}</h1>
  <div class="pereview f-cb">
    <a href="{{ getChapterUrl($chapter->articleid , $previousChapter) }}" target="_top" title="{{ $previousChapter->chaptername or  $chapter->articlename}}">← 上一章</a><a class="back" href="{{ route('articles.show',['bid'=>$chapter->articleid]) }}" target="_top" title="{{$chapter->articlename}}">返回目录</a><a href="{{ getChapterUrl($chapter->articleid ,$nextChapter) }}" target="_top" title="{{ $nextChapter->chaptername or  $chapter->articlename}}">下一章 →</a>
  </div>

  <div class="yd_text2">
    {!!$content!!}
  </div>

  <div class="pereview f-cb">
    <a href="{{ getChapterUrl($chapter->articleid , $previousChapter) }}" target="_top" title="{{ $previousChapter->chaptername or  $chapter->articlename}}">← 上一章</a><a class="back" href="{{ route('articles.show',['bid'=>$chapter->articleid]) }}" target="_top" title="{{$chapter->articlename}}">返回目录</a><a href="{{ getChapterUrl($chapter->articleid ,$nextChapter) }}" target="_top" title="{{ $nextChapter->chaptername or  $chapter->articlename}}">下一章 →</a>
  </div>

</div>

@endsection

@section('subscripts')
<script type="text/javascript">
var preview_page = "{{ getChapterUrl($chapter->articleid , $previousChapter) }}";
var next_page = "{{ getChapterUrl($chapter->articleid ,$nextChapter) }}";
var index_page = "{{ route('articles.show',['bid'=>$chapter->articleid]) }}";
function jumpPage() {
  if (event.keyCode==37) location=preview_page;
  if (event.keyCode==39) location=next_page;
  if (event.keyCode==13) location=index_page;
}
document.onkeydown=jumpPage;
baobaoni.LAST_READ_SET("{{ route('articles.show',['bid'=>$chapter->articleid]) }}", "{{request()->url()}}", "{{$chapter->articlename}}", "{{$chapter->chaptername}}");
baobaoni.setStatus();
baobaoni.toTop();
</script>
@endsection
