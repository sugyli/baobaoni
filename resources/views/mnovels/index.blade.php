@extends('mnovels.layouts.default')
@section('title'){{config('app.wap_name')}}-{{config('app.url_wap')}}@endsection
@section('keywords'){{config('app.wap_keywords')}}@endsection
@section('description'){{config('app.wap_des')}}@endsection
@section('content')
<div class="header online" style="text-align: center;">
    大书包小说网
    <a class="header-left" href="{{ route('mnovels.hislogs') }}">
      <i class="iconfont icon-lishi"></i>
    </a>
    <a class="header-right" href="{{ route('mnovels.user.show') }}">
      <i class="iconfont icon-huiyuan"></i>
    </a>
</div>
<div id="root" class="container-warp">
  <section class="i-top">
    <a href="/newsearch">
  		<div class="i-top-search">输入书名/作者/关键字</div>
  	</a>
    <div class="i-top-nav">
      <a href="{{ route('mnovels.wapsort') }}">
        <div class="image">
            <i class="iconfont icon-leimupinleifenleileibie"></i>
        </div>
        <div class="title">
          分类
        </div>

      </a>
      <a href="{{ route('mnovels.waptop') }}">
        <div class="image">
            <i class="iconfont icon-paihang"></i>
        </div>
        <div class="title">
          排行
        </div>
      </a>
    </div>
  </section>

  @if ($newBookDatas->count() > 0)
    <section class="i-hot">
      <div class="i-hot-header">
        <h2 class="i-hot-header-title">重磅推出</h2>
      </div>
      <ul class="i-hot-list">
        @foreach ($newBookDatas as $newBookData)
        <li>
            <a href="{{$newBookData->link}}">
              <div class="i-hot-list-wrap">
                <div class="i-hot-list-wrap-cover">
                  <img src="{{ $newBookData->imgflag}}"/>
                  <div class="p-tag -word"></div>
                </div>

                <div class="i-hot-list-wrap-info">
                    <h3 class="i-hot-list-wrap-info-title">
                      {{$newBookData->articlename}}
                    </h3>
                </div>
              </div>
            </a>
        </li>
        @endforeach
      </ul>
    </section>
  @endif

  @if ($daydates->count() > 0)
  <section class="i-cl">
    <div class="i-cl-header">
      <p class="i-cl-header-title">
        会员推荐<i>日榜</i>
      </p>
    </div>
    <ul class="i-cl-list">
      @foreach ($daydates as $daydate)
      <li>
        <div class="i-cl-list-main">
          <a href="{{$daydate->relationArticles->link}}">
            <div class="i-cl-list-main-left">
              <img src="{{$daydate->relationArticles->imgflag}}"/>
              <p class="i-cl-list-main-left-state">
                {{$daydate->relationArticles->fullflag}}
              </p>
            </div>
            <div class="i-cl-list-main-right">
              <p class="i-cl-list-main-right-bookname">
                {{ $daydate->relationArticles->articlename }}
              </p>

              <p class="i-cl-list-main-right-author">
                {{ $daydate->relationArticles->author }}
              </p>

              <p class="i-cl-list-main-right-info">
                {{ $daydate->relationArticles->intro }}
              </p>
              <div class="i-cl-list-main-right-tags">
                <div class="i-cl-list-main-right-tags-tag">{{$daydate->relationArticles->sort}}</div>
              </div>

            </div>
          </a>
        </div>
      </li>
      @endforeach
    </ul>
  </section>
  @endif

  @if ($weekdates->count() > 0)
  <section class="i-cl">
    <div class="i-cl-header">
      <p class="i-cl-header-title">
        会员推荐<i>周榜</i>
      </p>
    </div>
    <ul class="i-cl-list">
      @foreach ($weekdates as $weekdate)
      <li>
        <div class="i-cl-list-main">
          <a href="{{$weekdate->relationArticles->link}}">
            <div class="i-cl-list-main-left">
              <img src="{{$weekdate->relationArticles->imgflag}}"/>
              <p class="i-cl-list-main-left-state">
                {{$weekdate->relationArticles->fullflag}}
              </p>
            </div>
            <div class="i-cl-list-main-right">
              <p class="i-cl-list-main-right-bookname">
                {{ $weekdate->relationArticles->articlename }}
              </p>

              <p class="i-cl-list-main-right-author">
                {{ $weekdate->relationArticles->author }}
              </p>

              <p class="i-cl-list-main-right-info">
                {{ $weekdate->relationArticles->intro }}
              </p>
              <div class="i-cl-list-main-right-tags">
                <div class="i-cl-list-main-right-tags-tag">{{$weekdate->relationArticles->sort}}</div>
              </div>

            </div>
          </a>
        </div>
      </li>
      @endforeach
    </ul>
  </section>
  @endif

  @if ($monthdates->count() > 0)
  <section class="i-cl">
    <div class="i-cl-header">
      <p class="i-cl-header-title">
        会员推荐<i>月榜</i>
      </p>
    </div>
    <ul class="i-cl-list">
      @foreach ($monthdates as $monthdate)
      <li>
        <div class="i-cl-list-main">
          <a href="{{$monthdate->relationArticles->link}}">
            <div class="i-cl-list-main-left">
              <img src="{{$monthdate->relationArticles->imgflag}}"/>
              <p class="i-cl-list-main-left-state">
                {{$monthdate->relationArticles->fullflag}}
              </p>
            </div>
            <div class="i-cl-list-main-right">
              <p class="i-cl-list-main-right-bookname">
                {{ $monthdate->relationArticles->articlename }}
              </p>

              <p class="i-cl-list-main-right-author">
                {{ $monthdate->relationArticles->author }}
              </p>

              <p class="i-cl-list-main-right-info">
                {{ $monthdate->relationArticles->intro }}
              </p>
              <div class="i-cl-list-main-right-tags">
                <div class="i-cl-list-main-right-tags-tag">{{$monthdate->relationArticles->sort}}</div>
              </div>

            </div>
          </a>
        </div>
      </li>
      @endforeach
    </ul>
  </section>
  @endif

  @if ($updataBooks->count() > 0)
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
              <a href="{{$updataBook->link}}">
                <div class="i-up-list-main-left">
                  <img src="{{ $updataBook->imgflag }}"/>
                  <p class="i-up-list-main-state">
                    {{$updataBook->fullflag}}
                  </p>
                  <div class="i-up-list-main__order">{{$loop->iteration}}</div>
                </div>
                <div class="i-up-list-main-right">
                  <p class="i-up-list-main-right-bookname">
                    {{ $updataBook->articlename }}
                  </p>

                  <p class="i-up-list-main-right-author">
                    {{ $updataBook->author }}
                  </p>

                  <p class="i-up-list-main-right-info">
                    {{ $updataBook->intro }}
                  </p>
                  <div class="i-up-list-main-right-tags">
                    <div class="i-up-list-main-right-tags-tag">{{$updataBook->sort}}</div>
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
          <a href="{{ $updataBook->link }}">
            <div class="i-up-list-main i-up-list-mainnoimg">
              <span class="i-up-list-mainnoimg-left">0{{$loop->iteration}}</span>
              <div class="i-up-list-mainnoimg-right">
                <div class="i-up-list-mainnoimg-right-bookname">
                  {{$updataBook->articlename}}
                </div>
              </div>
            </div>
          </a>
        </li>
        @break($loop->iteration >= 10)
        @endforeach
  </section>
  @endif
  @include('mnovels.layouts.foot')
</div>
@endsection
