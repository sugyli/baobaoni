@extends('mnovels.layouts.default')
@section('title')小说搜索@endsection
@section('keywords')小说搜索@endsection
@section('description')小说搜索@endsection
@section('style')
<style>
.search_box {
    padding: 15px;
    width: 100%;
    background: #f5f5f5;
    border-bottom: 1px solid #f2f2f2;
    position: relative;
    overflow: hidden;
}
.search_box input {
    width: 100%;
    height: 38px;
    background: #fff;
    border: 1px solid #ccc;
    border-radius: 5px;
    padding: 0 10px;
    font-size: 14px;
    display: block;
}
.search_box .look {
    background: url(/images/person_icon.png) 0 -144px no-repeat;
    width: 20px;
    height: 20px;
    display: block;
    background-size: 100%;
    position: absolute;
    top: 27px;
    right: 24px;
}
.i-cl-list{
  padding: 0 13px;

}
.i-cl-list li{
  padding: 17px 0;
  border-bottom: 1px solid #f0f0f0;
}
.i-cl-list li:last-child {
    border: none;
}
.i-cl-list-main{
  overflow: hidden;
}

.i-cl-list-main-left{
  position: relative;
  float: left;
  width: 85px;
  height: 113px;
  background-color: #eeece9;/*书没加载出来有个背景色*/
  border: 1px solid #f0f0f0;
  border-radius: 1px;
  overflow: hidden;
}
.i-cl-list-main-left img {
    width: 100%;
    height: 100%;
    border-radius: 1px;
}
.i-cl-list-main-left-state{
  position: absolute;
  bottom: 0;
  width: 100%;
  box-sizing: border-box;/* border和padding计算入width之内*/
  font: 10px/10px a;
  padding: 25px 7px 6px;
  color: #fff;
  background: -webkit-linear-gradient(top,rgba(0,0,0,0),rgba(0,0,0,0.3));

}
.i-cl-list-main-right{
    margin-left: 100px;
    padding-top: 6px;
    background: #fff;
}
.i-cl-list-main-right-bookname{
  margin-bottom: 4px;
  font: 16px/17px a;
  color: rgba(0, 0, 0, 0.9);
  overflow: hidden;
  text-overflow: ellipsis;/*单行溢出文本显示省略号*/
  white-space: nowrap;/*规定段落中的文本不进行换行*/
}
.i-cl-list-main-right-author{
  margin-top: 8px;
  font: 12px/12px a;
  color: rgba(0, 0, 0, 0.7);
  overflow: hidden;
  text-overflow: ellipsis;
  white-space: nowrap;
}
.i-cl-list-main-right-info{
  margin: 8px 0 0;
  height: 2.8em;
  font: 12px/1.4em a;
  color: rgba(0, 0, 0, 0.6);
  overflow: hidden;
  text-overflow: ellipsis;
  /*下面3个控制多行*/
  display: -webkit-box;/*多行文字溢出*/
  -webkit-line-clamp: 2;/*多行文字几行*/
  -webkit-box-orient: vertical;/*溢出就用...*/
}

.i-cl-list-main-right-tags{
  margin-top: 10px;
  padding-top: 3px;
  overflow: hidden;
}
.i-cl-list-main-right-tags-tag{
  float: left;
  margin: -3px 7px 0 0;
  padding: 3px 6px 2px;
  font: 10px/11px a;
  color: #53ac7d;
  border-radius: 3px;
  border: 1px solid #53ac7d;
  overflow: hidden;
  text-overflow: ellipsis;
  white-space: nowrap;
  max-width: 6em;
}
.i-cl-list-main-right-tags-tag:last-child {
    margin-right: 0;
}

</style>

@endsection
@section('content')
<div class="header online" style="text-align: center;">
    小说搜索
    <a class="header-left" href="javascript:history.back()">
      <i class="iconfont icon-fanhui1"></i>
    </a>
</div>
<div id="reader" style="padding-top: 45px;">
  <div class="search_box">

      <input type="text" name="keyWord" placeholder="书名/作者/关键词" class="search" id="searchBox" autocomplete="off">
      <input id="search_bnt" type="button" class="look" style="border: none" value="" autocomplete="off">

  </div>
  <section id="sousuo" class="i-cl">

  </section>
</div>
@endsection
@section('subscripts')
<script>
(function () {
  baobaoni.searchApi("{{config('app.dfxsfmdir')}}","{{config('app.xsfmdir')}}");

})()//闭包不影响全局
</script>
@endsection
