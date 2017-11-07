@extends('layouts.default')
<link rel="stylesheet" type="text/css" href="/css/home.css">
@section('title'){{config('app.name')}}-{{config('app.url')}}@endsection
@section('keywords'){{config('app.keywords')}}@endsection
@section('description'){{config('app.des')}}@endsection
@section('content')
<div class="header online" style="text-align: center;">
    书城
    <a class="header-left">
      <i class="iconfont icon-qiandao"></i>
    </a>
    <a class="header-right" href="{{ route('novel.user.show') }}">
      <i class="iconfont icon-huiyuan"></i>
    </a>
</div>
<div style="padding-top: 45px; background: #fff;" class="container-warp" v-bind:style="'width:'+ screen_width + 'px;'">
  <section class="i-top">
    <a href="/search">
  		<div class="i-top-search">输入书名/作者/关键字</div>
  	</a>
    <div class="i-top-nav">
      <a href="javascript:">
        <div class="image">
            <i class="iconfont icon-leimupinleifenleileibie"></i>
        </div>
        <div class="title">
          分类
        </div>

      </a>
      <a href="javascript:">
        <div class="image">
            <i class="iconfont icon-paihang"></i>
        </div>
        <div class="title">
          排行
        </div>

      </a>
    </div>

  </section>
  @if (count($newBookDatas) > 0)
    <section class="i-hot">
      <div class="i-hot-header">
        <h2 class="i-hot-header-title">重磅推出</h2>
      </div>
      <ul class="i-hot-list Displayanimation">
        @foreach ($newBookDatas as $newBookData)
        <li>
            <a href="{{$newBookData['link']}}">
              <div class="i-hot-list-wrap">
                <div class="i-hot-list-wrap-cover">
                  <img src="{{ $newBookData['imgflag']}}"/>
                  <div class="p-tag -word"></div>
                </div>

                <div class="i-hot-list-wrap-info">
                    <h3 class="i-hot-list-wrap-info-title">
                      {{$newBookData['articlename']}}
                    </h3>
                </div>
              </div>
            </a>
        </li>
        @endforeach
      </ul>
    </section>
  @endif
  @if (count($weekdates) > 0)
  <section class="i-cl">
    <div class="i-cl-header">
      <p class="i-cl-header-title">
        会员推荐<i>周榜</i>
      </p>
    </div>
    <ul class="i-cl-list Displayanimation">
      @foreach ($weekdates as $weekdate)
      <li>
        <div class="i-cl-list-main">
          <a href="{{$weekdate['relation_articles']['link']}}">
            <div class="i-cl-list-main-left">
              <img src="{{$weekdate['relation_articles']['imgflag']}}"/>
              <p class="i-cl-list-main-left-state">
                {{$weekdate['relation_articles']['fullflag']}}
              </p>
            </div>
            <div class="i-cl-list-main-right">
              <p class="i-cl-list-main-right-bookname">
                {{ $weekdate['relation_articles']['articlename']}}
              </p>

              <p class="i-cl-list-main-right-author">
                {{$weekdate['relation_articles']['author']}}
              </p>

              <p class="i-cl-list-main-right-info">
                {{ str_limit($weekdate['relation_articles']['intro'], 200) }}
              </p>
              <div class="i-cl-list-main-right-tags">
                <div class="i-cl-list-main-right-tags-tag">{{$weekdate['relation_articles']['sort']}}</div>
              </div>

            </div>
          </a>
        </div>
      </li>
      @endforeach
    </ul>
  </section>
  @endif

  @if (count($monthdates) > 0)
  <section class="i-cl">
    <div class="i-cl-header">
      <p class="i-cl-header-title">
        会员推荐<i>月榜</i>
      </p>
    </div>
    <ul class="i-cl-list Displayanimation">
      @foreach ($monthdates as $monthdate)
      <li>
        <div class="i-cl-list-main">
          <a href="{{$monthdate['relation_articles']['link']}}">
            <div class="i-cl-list-main-left">
              <img src="{{$monthdate['relation_articles']['imgflag']}}"/>
              <p class="i-cl-list-main-left-state">
                {{$monthdate['relation_articles']['fullflag']}}
              </p>
            </div>
            <div class="i-cl-list-main-right">
              <p class="i-cl-list-main-right-bookname">
                {{$monthdate['relation_articles']['articlename']}}
              </p>

              <p class="i-cl-list-main-right-author">
                {{$monthdate['relation_articles']['author']}}
              </p>

              <p class="i-cl-list-main-right-info">
                {{ str_limit($monthdate['relation_articles']['intro'], 200) }}
              </p>
              <div class="i-cl-list-main-right-tags">
                <div class="i-cl-list-main-right-tags-tag">{{$monthdate['relation_articles']['sort']}}</div>
              </div>

            </div>
          </a>
        </div>
      </li>
      @endforeach
    </ul>
  </section>
  @endif

  @if (count($updataBooks) > 0)
  <section class="i-up">
    <div class="i-up-header">
      <p class="i-up-header-title">
        最新更新
      </p>
    </div>
      <ul class="i-up-list Displayanimation">
        @foreach ($updataBooks as $updataBook)
        <li>
            <div class="i-up-list-main">
              <a href="{{$updataBook['link']}}">
                <div class="i-up-list-main-left">
                  <img src="{{ $updataBook['imgflag'] }}"/>
                  <p class="i-up-list-main-state">
                    {{$updataBook['fullflag']}}
                  </p>
                  <div class="i-up-list-main__order">{{$loop->iteration}}</div>
                </div>
                <div class="i-up-list-main-right">
                  <p class="i-up-list-main-right-bookname">
                    {{ $updataBook['articlename'] }}
                  </p>

                  <p class="i-up-list-main-right-author">
                    {{ $updataBook['author'] }}
                  </p>

                  <p class="i-up-list-main-right-info">
                    {{ str_limit($updataBook['intro'], 200) }}
                  </p>
                  <div class="i-up-list-main-right-tags">
                    <div class="i-up-list-main-right-tags-tag">{{$updataBook['sort']}}</div>
                  </div>

                </div>
              </a>
            </div>

        </li>
        @break($loop->iteration >= 1)
        @endforeach

        @foreach ($updataBooks as $updataBook)
        @continue($loop->iteration <=1)
        <li>
          <a href="{{ $updataBook['link'] }}">
            <div class="i-up-list-main i-up-list-mainnoimg">
              <span class="i-up-list-mainnoimg-left">0{{$loop->iteration}}</span>
              <div class="i-up-list-mainnoimg-right">
                <div class="i-up-list-mainnoimg-right-bookname">
                  {{$updataBook['articlename']}}
                </div>
              </div>
            </div>
          </a>
        </li>
        @break($loop->iteration >= 6)
        @endforeach
  </section>
  @endif
  @include('layouts.foot')
</div>
@endsection
