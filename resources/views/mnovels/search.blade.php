@extends('mnovels.layouts.default')
@section('title')小说搜索@endsection
@section('keywords')小说搜索@endsection
@section('description')小说搜索@endsection
@section('style')
<link rel="stylesheet" type="text/css" href="/newcss/zujian.css" />
@endsection
@section('content')
<div class="top__bd" :style="'height:'+screen_height+'px;'">
  <div class="right-search">
    <a href="javascript:history.back()" class="top__back"></a>
    <div id="search-input" class="search-input"> <b class="search-input__mi"></b>
      <input type="text" v-model="searchKeyword" placeholder="输入书名/作者/关键字" @keyup.13="search">
      <div class="search-input__btn" v-on:click="search">搜索</div>
    </div>
  </div>
  <scroller
    style="top: 45px"
    ref="searchScroller"
    :on-refresh="refresh"
    :on-infinite="infinite"
    :no-data-text="searchNoDataText"
    >
    <section class="i-cl" v-if="isNotNullArray(searchItems)">
      <ul class="i-cl-list Displayanimation">
          <li v-for="(item, index) in searchItems">
            <div class="i-cl-list-main">
              <a :href="item['link']">
                <div class="i-cl-list-main-left">
                  <img :src="item['imgflag']"/>
                  <p class="i-cl-list-main-left-state">
                    @{{item['fullflag']}}
                  </p>
                </div>
                <div class="i-cl-list-main-right">
                  <p class="i-cl-list-main-right-bookname">
                    @{{item['articlename']}}
                  </p>

                  <p class="i-cl-list-main-right-author">
                      @{{item['author']}}
                  </p>

                  <p class="i-cl-list-main-right-info">
                    @{{item['intro']}}
                  </p>
                  <div class="i-cl-list-main-right-tags">
                    <div class="i-cl-list-main-right-tags-tag">@{{item['sort']}}</div>
                  </div>
                </div>
              </a>
            </div>
          </li>
      </ul>
    </section>
    <div :class="{ishide:ishide}">
        <ul class="m-tag -color search-tag">
          <li v-for="(item, index) in storageSearchItems" class="u-tag">
          <a v-on:click.stop="tagclick(item)">@{{item}}</a>
          </li>
        </ul>

        <div class="his-dele" v-if="isNotNullArray(storageSearchItems)">
          <a v-on:click.stop="delStorageSearchItems">
          <img src="/images/icon_search_del.png" style="width:.98rem;height:.92rem;display: inline-block;">清除记录
          </a>
        </div>
    </div>
  </scroller>
</div>
@endsection
@section('scripts')
<script src="/js/vue-scroller.min.js"></script>
<script src="/newjs/search.js"></script>
@endsection
