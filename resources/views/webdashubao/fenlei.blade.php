@extends('webdashubao.layouts.default')
@section('title'){{$sorts['title'] or '未知分类'}}-{{get_sys_set('webname')}}-{{get_sys_set('weburi')}}@endsection
@section('keywords'){{$sorts['title'] or '未知分类'}}@endsection
@section('description'){{$sorts['title'] or '未知分类'}}@endsection
@section('style')
<style>
.breadnav {
    width: 960px;
    height: 30px;
    line-height: 30px;
    color: #999999;
    margin: 0px auto;
}
.list {
    width: 960px;
    margin: 10px auto;
    overflow: hidden;
    border: 1px solid #d1e3d3;
}
.list .ltop {
    overflow: hidden;
    height: 44px;
    background: url(/webdashubao/images/bg.png);
}
.list .ltop h2 {
    text-indent: 24px;
    float: left;
    color: #0087d5;
    font-size: 14px;
    font-weight: bold;
    line-height: 40px;
}
.list li {
    clear: both;
    height: 200px;
    border-bottom: 1px dashed #e1e9ee;
    margin: 20px;
}
.list li img {
    float: left;
    margin-right: 15px;
    height: 150px;
    width: 120px;
    padding: 2px 4px 4px 2px;
    background: url(/webdashubao/images/hb.png) no-repeat -220px 0;
}
.list li .title {
    float: left;
    width: 770px;
    height: 35px;
    overflow: hidden;
}
.list li .title h3 {
    font-size: 14px;
    font-weight: bold;
    float: left;
    line-height: 30px;
    height: 30px;
}
.list li .title .author {
    float: left;
    color: #999;
    padding-left: 15px;
    line-height: 30px;
    height: 30px;
}
.list li .title .shujia {
    width: 89px;
    height: 26px;
    float: right;
    background: url(/webdashubao/images/bg.png) 0px -44px no-repeat;
    overflow: hidden;
}
.list li .title .shujia a {
    padding-left: 14px;
    display: block;
    line-height: 26px;
    color: #999999;
    text-align: center;
}
.list li .title  .read {
    width: 89px;
    height: 26px;
    float: right;
    margin-right: 10px;
    background: url(/webdashubao/images/bg.png) 0px -96px no-repeat;
    overflow: hidden;
}
.list li .title .read a {
    display: block;
    line-height: 26px;
    color: #00a2ff;
    text-align: center;
}
.list li .status {
    line-height: 35px;
    color: #999999;
}
.list li .status span {
    padding-left: 20px;
}
.list li .status a {
    line-height: 30px;
    color: #00a2ff;
}
.list li p {
    text-indent: 25px;
    line-height: 19px;
    color: #676767;
    overflow: hidden;
    display: -webkit-box;/*多行文字溢出*/
    -webkit-line-clamp: 3;/*多行文字几行*/
    -webkit-box-orient: vertical;/*溢出就用...*/
}
.list li .data {
    line-height: 35px;
    color: #00a2ff;
}
.list li .data span {
    padding-right: 20px;
}
.pagelink {
    height: 27px;
    line-height: 27px;
    overflow: hidden;
    text-align: center;
    margin-bottom: 20px;
}
.pagelink a {
    width: 25px;
    height: 25px;
    white-space: nowrap;
    line-height: 25px;
    border: 1px solid #d1e3d3;
    display: inline-block;
    text-align: center;
    margin-left: 10px;
    color: #acacac;
    background: #fff;
    vertical-align: top;
}
.pagelink strong {
    width: 25px;
    height: 25px;
    text-align: center;
    color: #fff;
    display: inline-block;
    border: 1px solid #06b025;
    background: #06b025;
    margin-left: 10px;
    line-height: 25px;
    vertical-align: top;
}
</style>
@endsection
@section('content')
@include('webdashubao.packaging.logo-nav-jilu-qiandao')
<header class="breadnav">当前位置： <a href="/" title="{{get_sys_set('webname')}}">首页</a> &gt;  {{$sorts['title'] or '未知分类'}}</header>
<section class="list">
  <div class="ltop">
    <h2>{{$sorts['title'] or '未知分类'}}</h2>
  </div>
  <ul>
    @if ($fenleidatas->count() > 0)
      @foreach ($fenleidatas as $fenleidata)
      <li>
        <a href="{{$fenleidata->link()}}" title="{{$fenleidata->articlename}}">
          <img src="{{ $fenleidata->imgflag }}" alt="{{$fenleidata->articlename}}">
        </a>
        <div class="title">
          <h3>
            <a href="{{$fenleidata->link()}}" title="{{$fenleidata->articlename}}">《{{$fenleidata->articlename}}》</a>
          </h3>
          <span class="author">作者：{{$fenleidata->author}}</span>
          <user-fenleibnt
              bid={{$fenleidata->articleid}}
              cid=0
              addbookcaseurl="{{route('webajax.bookshelf.addbookcase')}}"
          ></user-fenleibnt>

          <span class="read">
            <a href="{{$fenleidata->link()}}" title="{{$fenleidata->articlename}}">在线阅读</a>
          </span>
        </div>
        <div class="status">连载中<span>最新章节：<a href="{{route('web.articles.content', ['bid' => $fenleidata->articleid , 'cid' => $fenleidata->lastchapterid])}}">{{$fenleidata->lastchapter}}</a></span></div>
        <p>{{ $fenleidata->intro }}</p>
        <div class="data">
          <span>今日推荐：{{ $fenleidata->getDayHits() }}</span>
          <span>周推荐：{{ $fenleidata->getWeekHits() }}</span>
          <span>月推荐：{{ $fenleidata->getMonthHits() }}</span>
          <span>更新：{{formatTime($fenleidata->lastupdate)}}</span>
        </div>
      </li>
      @endforeach
    @endif
  </ul>
  {{ $fenleidatas->links('vendor.pagination.bootstrap-4') }}
</section>
@endsection
@section('subscripts')
<script type="text/javascript">
baobaoni.toTop();
</script>
@endsection
