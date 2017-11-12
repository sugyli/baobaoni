
@extends('mnovels.layouts.default')
@section('title')用户中心@endsection
@section('keywords')用户中心@endsection
@section('description')用户中心@endsection
@section('style')


@endsection
@section('content')
<header class="center_header" v-bind:style="'width:'+ screen_width + 'px;'">
  <span class="back">
    <i onclick="javascript:window.location.href='{{$bkurl}}';"></i>个人中心
  </span>

  <div class="use">
    <a href="/" class="home"></a>
    <a href="/search" class="search_white"></a>
  </div>
</header>

<section class="home_login clearfix">
  <a href="javascript:" class="home_Avatar">
      <img src="{{ $user->portrait }}">
  </a>
  <div class="logged">
      <h1 class="online">{{ $user->uname }}</h1>
      <div class="clearfix">
        <p class="home_lv">{{$user->getCaption()}}</p>
      </div>
  </div>
</section>
<section class="my-con" :style="'min-height:' + screen_height-150 + 'px;max-width: 720px;'">
  <div class="con_column con_taquan">
      <a href="javascript:" class="clearfix">
          <p>经验 <span>{{$user->score}}</span></p>
      </a>
  </div>
  <div class="con_column con_taquan">
      <a href="javascript:" class="clearfix">
          <p>书架容量 <span>{{$user->getBookcaseCount()}}</span> 已用 <span>{{$user->relationBookcasesUse()}}</span></p>
      </a>
  </div>
  <div class="con_column con_taquan">
      <a href="javascript:" class="clearfix">
          <p>日推荐票 <span>{{$user->getDayRecommendCount()}}</span> 今日剩余 <span>{{$user->shenyuDayRecommendCount()}}</span></p>
      </a>
  </div>
  <div class="con_column con_taquan">
      <a href="javascript:" class="clearfix">
          <p>收发件最大存储 <span>{{$user->getMassageMaxCount()}}</span></p>
      </a>
  </div>
  <div class="setfenge"></div>
  <div class="con_column clearfix">
      <a href="{{route('mnovels.user.passedit')}}?redirect_url={{request()->url()}}" class="clearfix">
          <p>修改密码</p>
          <b></b>
      </a>
  </div>
  <div class="con_column clearfix">
      <a href="{{ route('mnovels.hislogs') }}" class="clearfix con_rack">
          <p>历史浏览</p>
          <b></b>
      </a>
  </div>
  <div class="con_column clearfix">
      <a href="{{route('mnovels.bookshelf.index')}}" class="clearfix con_rack">
          <p>我的书架</p>
          <b></b>
      </a>
  </div>
  <div class="con_column clearfix">
      <a href="{{route('mnovels.inboxs.index')}}?redirect_url={{request()->url()}}" class="clearfix con_rack">
          <p>收件箱</p>
          <b></b>
          @if($user->adminemail > 0)
          <span></span>
          @endif
      </a>
  </div>
  <div class="con_column clearfix">
      <a href="{{route('mnovels.outboxs.index')}}?redirect_url={{request()->url()}}" class="clearfix con_rack">
          <p>发件箱</p>
          <b></b>
      </a>
  </div>
  <div class="setfenge"></div>
  <div class="con_sign con_column clearfix">
      <a href="javascript:;" class="clearfix">
        <p>每日签到</p>
      </a>
      <a href="javascript:;" class="sign_lj">未开放</a>
  </div>
  <div class="setfenge"></div>

  <div class="con_exit con_column clearfix">
      <a href="{{ route('mnovels.login.destroy') }}" class="clearfix">
          <p style="color:red;">退出登录</p>
          <b></b>
      </a>
  </div>
</section>
@include('mnovels.layouts.foot')
@endsection
