@extends('wapdashubao.layouts.default')
@section('title')分类列表-{{get_sys_set('wapname')}}-{{get_sys_set('wapuri')}}@endsection
@section('keywords')分类列表@endsection
@section('description')分类列表@endsection
@section('style')
<style>
.category{

  background: #fff;
  width: 100%;

}
.category-main{

  margin: 0 10px;
}
.category-main-title{
  margin-top: 10px;
  position: relative;
  line-height: 2.4em;
  border-bottom: 1px solid #eee;
  color: #8A8D8E;
  -webkit-box-sizing: border-box;
}
.category-main-title h1{
  margin-left: 5px;
  display: inline-block;
  font-size: 15px;
  font-weight: 400;
  vertical-align: middle;
}

.category-list{
  margin-bottom: 2%;
  overflow: hidden;
}
.category-list li:nth-child(2n+1) {
    margin-right: 2%;
}
.category-list li {
    float: left;
    width: 49%;
    margin: 2% 0 0 0;
    list-style: none;
}

.category-list-item {
    width: 100%;
    height: 66px;
    padding: 16px 6px 0;
    background-color: #eee;
    background-size: 100%;
    background-position: right bottom;
    background-repeat: no-repeat;
    color: #515151;
    -webkit-box-sizing: border-box;
}

.category-list-item h3 {
    font-size: 13px;
    line-height: 16px;
}
.category-list-item .num {
    font-size: 11px;
    line-height: 1em;
    color: #999;
    padding-top: 4px;
}

</style>
@endsection

@section('content')
<div class="header online HeaderTitlePosition">
    分类列表
    <a href="javascript:" onclick="javascript:history.go(-1);" class="header-left">
      <i class="iconfont icon-fanhui1"></i>
    </a>
</div>
<div style="padding-top: 45px;" class="container-warp" v-bind:style="'width:'+ screen_width + 'px;'">
  @if($sorts = get_sort('webnovel'))
  <section class="category">
    <div class="category-main">
      <ul class="category-list">
        @foreach($sorts as $sort)
        <li>
          <a href="{{$sort['uri']}}">
            <div class="category-list-item" style="background-image:url(/wapdashubao/images/fenlei/xuanhuan.jpg);">
              <h3>{{$sort['title']}}</h3>
              <p class="num"></p>
            </div>
          </a>
        </li>
        @endforeach
      </ul>
    </div>
  </section>
  @endif
@include('wapdashubao.include.foot')
</div>

{{--
<div id="app">
  @include('wapdashubao.include.common-header')

  <section class="category">
    <div class="category-main">
      <div class="category-main-title">
        <h1>网文男频</h1>
      </div>

      <ul class="category-list">
        <li>
          <div class="category-list-item" style="background-image:url(/wapdashubao/images/fenlei/xuanhuan.jpg);">
            <h3>玄幻</h3>
            <p class="num">21721</p>
          </div>

        </li>

        <li>
          <div class="category-list-item" style="background-image:url(/wapdashubao/images/fenlei/qihuan.jpg);">
            <h3>奇幻</h3>
            <p class="num">2719</p>
          </div>
        </li>


        <li>
          <div class="category-list-item" style="background-image:url(/wapdashubao/images/fenlei/wuxia.jpg);">
            <h3>武侠</h3>
            <p class="num">3431</p>
          </div>
        </li>

        <li>
          <div class="category-list-item" style="background-image:url(/wapdashubao/images/fenlei/dushi.jpg);">
            <h3>都市</h3>
            <p class="num">51341</p>
          </div>
        </li>

        <li>
          <div class="category-list-item" style="background-image:url(/wapdashubao/images/fenlei/xianxia.jpg);">
            <h3>仙侠</h3>
            <p class="num">7647</p>
          </div>
        </li>

        <li>
          <div class="category-list-item" style="background-image:url(/wapdashubao/images/fenlei/lishi.jpg);">
            <h3>历史</h3>
            <p class="num">13647</p>
          </div>
        </li>

        <li>
          <div class="category-list-item" style="background-image:url(/wapdashubao/images/fenlei/junshi.jpg);">
            <h3>军事</h3>
            <p class="num">1485</p>
          </div>
        </li>

        <li>
          <div class="category-list-item" style="background-image:url(/wapdashubao/images/fenlei/lingyi.jpg);">
            <h3>灵异</h3>
            <p class="num">6168</p>
          </div>
        </li>

        <li>
          <div class="category-list-item" style="background-image:url(/wapdashubao/images/fenlei/kehuan.jpg);">
            <h3>科幻</h3>
            <p class="num">4886</p>
          </div>
        </li>

        <li>
          <div class="category-list-item" style="background-image:url(/wapdashubao/images/fenlei/youxi.jpg);">
            <h3>游戏</h3>
            <p class="num">4241</p>
          </div>
        </li>

        <li>
          <div class="category-list-item" style="background-image:url(/wapdashubao/images/fenlei/jingji.jpg);">
            <h3>竞技</h3>
            <p class="num">800</p>
          </div>
        </li>

        <li>
          <div class="category-list-item" style="background-image:url(/wapdashubao/images/fenlei/zhichang.jpg);">
            <h3>职场</h3>
            <p class="num">7294</p>
          </div>
        </li>

        <li>
          <div class="category-list-item" style="background-image:url(/wapdashubao/images/fenlei/tongren.jpg);">
            <h3>同人</h3>
            <p class="num">354</p>
          </div>
        </li>

        <li>
          <div class="category-list-item" style="background-image:url(/wapdashubao/images/fenlei/duanpian.jpg);">
            <h3>短篇</h3>
            <p class="num">130</p>
          </div>
        </li>

        <li>
          <div class="category-list-item" style="background-image:url(/wapdashubao/images/fenlei/xuanhuanyanqin.jpg);">
            <h3>玄幻言情</h3>
            <p class="num">4257</p>
          </div>
        </li>

        <li>
          <div class="category-list-item" style="background-image:url(/wapdashubao/images/fenlei/xianxiaqiyuan.jpg);">
            <h3>仙侠奇缘</h3>
            <p class="num">2121</p>
          </div>
        </li>

        <li>
          <div class="category-list-item" style="background-image:url(/wapdashubao/images/fenlei/gudaiyanqin.jpg);">
            <h3>古代言情</h3>
            <p class="num">34246</p>
          </div>
        </li>

        <li>
          <div class="category-list-item" style="background-image:url(/wapdashubao/images/fenlei/xiandaiyanqin.jpg);">
            <h3>现代言情</h3>
            <p class="num">32078</p>
          </div>
        </li>

        <li>
          <div class="category-list-item" style="background-image:url(/wapdashubao/images/fenlei/langmanqinchun.jpg);">
            <h3>浪漫青春</h3>
            <p class="num">3539</p>
          </div>
        </li>

        <li>
          <div class="category-list-item" style="background-image:url(/wapdashubao/images/fenlei/kehuankongjian.jpg);">
            <h3>科幻空间</h3>
            <p class="num">1373</p>
          </div>
        </li>

        <li>
          <div class="category-list-item" style="background-image:url(/wapdashubao/images/fenlei/xuanyilingyi.jpg);">
            <h3>悬疑灵异</h3>
            <p class="num">1087</p>
          </div>
        </li>

        <li>
          <div class="category-list-item" style="background-image:url(/wapdashubao/images/fenlei/youxijingji.jpg);">
            <h3>游戏竞技</h3>
            <p class="num">794</p>
          </div>
        </li>

        <li>
          <div class="category-list-item" style="background-image:url(/wapdashubao/images/fenlei/tongrenxiaoshuo.jpg);">
            <h3>同人小说</h3>
            <p class="num">1180</p>
          </div>
        </li>

        <li>
          <div class="category-list-item" style="background-image:url(/wapdashubao/images/fenlei/shengmeixiaoshuo.jpg);">
            <h3>耽美小说</h3>
            <p class="num">50</p>
          </div>
        </li>

      </ul>




    </div>



  </section>

  @include('wapdashubao.include.foot')
--}}
</div>
@stop
