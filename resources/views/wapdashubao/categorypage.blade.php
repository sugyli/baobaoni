@extends('wapdashubao.layouts.default')

@section('content')
<style>
.categorypage{
  background: #fff;
  width: 100%;

}
.categorypage-header{
  border-bottom: 10px solid #f5f5f5;
  background: #fff;
}

.categorypage-header-ul>li {
    border-bottom: 1px solid #f0f0f0;
    padding-left: 14px;
    padding-right: 14px;
    list-style: none;
}

.categorypage-header-ul-t{

    padding: 8px 0;
}

.categorypage-header-ul-t .tag {
    display: inline-block;
    font-size: 14px;
    padding: 5px 6px;
    color: #666;
}

.categorypage-header-ul-t .tag.-crt {
    color: #4b99a7;
    font-weight: 600;
}



.categorypage-main-ul>li {
    cursor: pointer;
    position: relative;
    overflow: hidden;
    border-bottom: 1px solid #f0f0f0;
    list-style: none;
}

.categorypage-main-ul li>.u-book {
    padding: 13px 14px;
}
.u-book {
    position: relative;
    overflow: hidden;
}

</style>
<div id="app">
  @include('wapdashubao.include.common-header')

  <section class="categorypage">
    <div class="categorypage-header">
      <ul class="categorypage-header-ul">
        <li>
          <ul class="categorypage-header-ul-t">
            <li class="tag -crt"> 全部 </li>
            <li class="tag"> 东方玄幻 </li>
            <li class="tag"> 异界大陆 </li>
          </ul>

        </li>

        <li>
          <ul class="categorypage-header-ul-t">
            <li class="tag -crt"> 热门 </li>
            <li class="tag"> 最新 </li>
            <li class="tag"> 完结 </li>
          </ul>
        </li>
      </ul>

    </div>

    <div class="categorypage-main">
      <ul class="categorypage-main-ul">

          <li data-track="0">
            <div class="u-book">
              <div class="cnt">
                <div class="book-cover Lazy_loading Lazy_loaded" data-id="270794" id="Tag__10">
                  <img alt="七界武神" src="http://cover.read.duokan.com/mfsv2/download/fdsc3/p01DMhyt0Zkm/sf6mdPxWm06zcc.jpg!s">
                  <div class="u-tagRT"></div>
                </div>
                <div class="info">
                  <h3 class="title single-line">七界武神</h3>
                  <p class="summary">神州大陆，唯武独尊！
在这片浩瀚的大陆，武者便是金字塔顶端的生物，强大的武者可以粉碎天地，打破苍穹...
                  </p>
                  <div class="wrap">
                    <p class="author single-line"><span class="author">叶之凡</span></p>
                  </div>
                </div>
              </div>
            </div>
          </li>
      </ul>
    </div>


  </section>

  @include('wapdashubao.include.foot')

</div>
@stop
