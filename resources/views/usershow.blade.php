
@extends('layouts.default')

@section('title')用户中心@endsection
@section('keywords')用户中心@endsection
@section('description')用户中心@endsection
@section('style')
<style>
.clearfix:after {
    content: " ";
    display: block;
    height: 0;
    clear: both;
    visibility: hidden;
}
.center_header {
    background: url(/images/center_header.jpg) no-repeat;
    padding: 0 15px;
    overflow: hidden;
    height: 50px;
    background-color: #fff;
    position: relative;
    width: 100%;
    max-width: 720px;
}
.center_header .back {
    color: #fff;
    font-size: 1.8rem;
    position: relative;
    display: -webkit-box;
    display: -moz-box;
    display: -o-box;
    -webkit-box-align: center;
    -o-box-align: center;
    -moz-box-align: center;
    height: 50px;
    line-height: 50px;
}
.center_header .back i {
    background: url(/images/person_icon.png) 0 -238px no-repeat;
    background-size: 20px auto;
    width: 25px;
    height: 30px;
    display: inline-block;
    position: relative;
    top: 13px;
    font-style: normal;
}
.center_header .use {
    margin-right: 10px;
    position: absolute;
    right: 0;
    top: 0;
}
.center_header .use a {
    display: inline-block;
    width: 20px;
    height: 21px;
    margin: 15px 5px 15px 15px;
    overflow: hidden;
    background-size: 100%;
}
.center_header .search_white {
    background: url(/images/person_icon.png) 0 -214px no-repeat;
}
.center_header .home {
    background: url(/images/person_icon.png) 0 -96px no-repeat;
}

.home_login {
    height: 102px;
    background: url(/images/center_header2.jpg) no-repeat;
    background-size: 100%;
    padding: 1px 20px 0 15px;
    max-width: 720px;
}
.home_login a {
    width: 60px;
    height: 75px;
    float: right;
    margin-right: -20px;
}
.home_login .home_Avatar {
    float: left;
    width: 75px;
    height: 75px;
    border-radius: 50%;
    -webkit-border-radius: 50%;
    background: rgba(255,255,255,.1);
    margin: 3px 14px 0 0;
    position: relative;
}
.home_login .home_Avatar img {
    width: 67px;
    height: 67px;
    display: block;
    margin: 4px auto;
    -webkit-border-radius: 50%;
    border-radius: 50%;
    border: none;
}
.home_login .logged {
    float: left;
}
.home_login .logged h1 {
    margin: 15px 0 10px;
    color: #fff;
    font-size: 1.7rem;
    font-weight: 400;
}
.home_login .logged div p {
    float: left;
    width: 45px;
    height: 17px;
}
.home_login .logged div p img {
    width: 100%;
    height: 100%;
}
.home_login .logged div .home_lv {
    background: url(/images/home.png) -155px -25px no-repeat;
    background-size: 200px auto;
    text-align: center;
    line-height: 17px;
    color: #fff;
    font-size: .9rem;
}
.home_login a i {
    float: right;
    width: 7px;
    height: 13px;
    background: url(/images/arrow_right_sb.png) 100% no-repeat;
    margin: 36px 20px 0 0;
    font-style: normal;
}
.my-con {
    background-color: #f5f5f5;
}
.my-con .con_top {
    height: 55px;
    border-bottom: 1px solid #e7e7e7;
    padding: 0 15px;
    background-color: #fff;
}
.my-con .con_top p {
    float: left;
    font-size: 1.5rem;
    margin-top: 14px;
}
.my-con .con_top p span {
    color: #ff6a66;
    font-size: 1.8rem;
}
.my-con .con_taquan {
    border-top: none!important;
}
.my-con .con_column {
    background-color: #fff;
    border-top: 1px solid #e7e7e7;
    border-bottom: 1px solid #f1f1f1;
    padding: 0 15px;
}
.my-con .con_column a {
    width: 100%;
    height: 100%;
    display: block;
}
.my-con .con_column a p {
    font-size: 1.6rem;
    line-height: 55px;
    float: left;
}
.my-con .con_taquan a p span {
    color: #ff6a66;
    font-size: 1.8rem;
}
.my-con .con_column a b {
    width: 7px;
    height: 14px;
    background: url(/images/arrow_right_b.png) 100% no-repeat;
    float: right;
    margin-top: 22px;
}
.setfenge {
    height: 6px;
    background-color: #f5f5f5;
}
.my-con .con_Recent i {
    width: 22px;
    height: 21px;
    background: url(/images/home.png) no-repeat;
    background-size: 900%;
    float: left;
    margin: 18px 21px 0 0;
}
.my-con .con_bookrack i {
    width: 22px;
    height: 21px;
    background: url(/images/home.png) -26px 0 no-repeat;
    background-size: 900%;
    float: left;
    margin: 18px 21px 0 0;
}
.my-con .con_sign {
    border-top: none;
    position: relative;
}
.my-con .con_sign i {
    width: 22px;
    height: 18px;
    background: url(/images/center_sign.png) no-repeat;
    background-size: 100%;
    float: left;
    margin: 19px 21px 0 0;
}
.my-con .con_sign .sign_lj {
    width: 70px;
    height: 25px;
    font-size: 1.2rem;
    line-height: 23px;
    border: 1px solid #25c4a6;
    color: #25c4a6;
    position: absolute;
    right: 15px;
    text-align: center;
    top: 50%;
    margin-top: -12px;
    border-radius: 5px;
    -webkit-border-radius: 5px;
    z-index: 100;
}
.my-con .con_exit {
    border-top: 1px solid #e7e7e7;
    border-bottom: 1px solid #e7e7e7;
}
.my-con .con_exit i {
    width: 22px;
    height: 21px;
    background: url(/images/home.png) -156px 0 no-repeat;
    background-size: 900%;
    float: left;
    margin: 18px 21px 0 0;
}
.my-con .con_bar {
    border-top: none;
}

.my-con .con_bar i {
    width: 21px;
    height: 22px;
    background: url(/images/center_bar.png) no-repeat;
    background-size: 100%;
    float: left;
    margin: 16px 21px 0 0;
}
</style>

@endsection
@section('content')
<header class="center_header" >
    <span class="back" name="">
      <i onclick="javascript:window.location.href='{{$bkurl}}';"></i>个人中心
    </span>

    <div class="use">
      <a href="/" class="home"></a>
      <a href="/search" class="search_white"></a>
    </div>
</header>
<section class="home_login clearfix">
  <div>
    <a href="javascript:" class="home_Avatar">
        <img src="{{ $user->portrait }}">
    </a>
  </div>
  <!-- 登录 注册 -->
  <!-- <div class="login">
      <a href="#">登录</a>
      <a href="#">注册</a>
  </div> -->
  <!-- 已登录 -->
  <div class="logged">
      <h1 class="online">{{ $user->uname }}</h1>
      <div class="clearfix">
        <p class="home_lv">{{$user->getUserHonor()->caption}}</p>
      </div>
  </div>
  <a href="{{ route('novel.user.edit') }}?redirect_url={{request()->url()}}"><i></i></a>
</section>

  <section class="my-con setHeight" :style="'min-height:' + screen_height-150 + 'px;max-width: 720px;'">
    <div class="con_column con_taquan">
        <a href="javascript:" class="clearfix">
            <p><span>0</span> 书币</p>
            <b></b>
        </a>
    </div>
    <div class="setfenge"></div>
    <div class="con_Recent con_column clearfix">
        <a href="javascript:" class="clearfix">
            <i></i>
            <p>最近阅读</p>
            <b></b>
        </a>
    </div>
    <div class="con_Recent con_column clearfix">
        <a href="{{route('novel.user.passedit')}}?redirect_url={{request()->url()}}" class="clearfix">
            <i></i>
            <p>修改密码</p>
            <b></b>
        </a>
    </div>
    <div class="con_bookrack con_column clearfix">
      <a href="{{route('novel.bookshelf.index')}}?redirect_url={{request()->url()}}" class="clearfix">
        <i></i>
        <p>我的书架</p>
        <b></b>
      </a>
    </div>
    <div class="setfenge"></div>
    <div class="con_sign con_column clearfix">
        <a href="javascript:;" class="clearfix">
          <i></i>
          <p>每日签到</p>
        </a><a href="javascript:;" class="sign_lj">未开放</a>
    </div>
    <div class="con_bar con_column">
        <a href="{{route('novel.inboxs.index')}}?redirect_url={{request()->url()}}" class="clearfix">
            <i></i>
            <p>收件箱</p>
            <b></b>
        </a>
    </div>
    <div class="con_bar con_column">
        <a href="{{route('novel.outboxs.index')}}?redirect_url={{request()->url()}}" class="clearfix">
            <i></i>
            <p>发件箱</p>
            <b></b>
        </a>
    </div>
    <div class="setfenge"></div>

    <div class="con_exit con_column clearfix">
        <a href="{{ route('novel.login.destroy') }}" class="clearfix">
            <i></i>
            <p>退出登录</p>
            <b></b>
        </a>
    </div>
  </section>



{{--
<div class="user-box">
  <div class="center-header">
    <div class="user_header">
      <a href="{{$bkurl}}" class="user__back iconfont icon-fanhui1"></a>
      用户中心
    </div>
    <img src="{{ $user->portrait }}" class="center-header-img" />
    <p class="center-header-p online">账户:{{ $user->uname }}</p>
  </div>
  <div class="user-module">

    <a href="#" class="center-pay">
        <ul>
          <li style="padding-top:5px;">
            <i class="iconfont icon-qianbao" style="font-size:20px;"></i>
          </li>
          <li>
            充值
          </li>
        </ul>
    </a>

    <div class="cell">
        <ul class="btn-group">
            <li class="btn-group-cell center-acc-li" role="link">
                <a href="javascript:" role="option">
                    <output>{{ $user->getUserHonor()->getDayRecommendCount() }}</output>
                    <p class="gray">日票</p>
                </a>
            </li>
            <li class="btn-group-cell center-acc-li" role="link">
                <a href="javascript:" role="option">
                    <output>{{ $user->getUserHonor()->getBookcaseCount() }}</output>
                    <p class="gray">书架</p>
                </a>
            </li>
            <li class="btn-group-cell center-acc-li" role="link">
                <a href="javascript:" role="option">
                    <output>15</output>
                    <p class="gray">等级</p>
                </a>
            </li>

        </ul>
    </div>

  </div>
  <div class="user-module-nav">
    <ul class="center-nav-ol">
        <li class="book-li" role="link">
            <a href="{{route('member.bookshelf.index')}}?redirect_url={{request()->url()}}" class="book-layout" role="option">
                <h3 class="book-title"><i class="iconfont icon-weibiaoti3zhuanhuan" style="color:#d4237a;"></i>会员书架</h3>
                <span class="book-author">
                    <i class="iconfont icon-fanhui-copy"></i>
                </span>
            </a>
        </li>
        <li class="book-li" role="link">
            <a href="{{route('member.inboxs.index')}}?redirect_url={{request()->url()}}" class="book-layout" role="option">
                <h3 class="book-title"><i class="iconfont icon-shoujianxiang" style="color:#1296db;"></i>收件箱 {{ $user->adminemail>0 ? "( <font color='red'>$user->adminemail</font> )" : "" }}</h3>
                <span class="book-author">
                    <i class="iconfont icon-fanhui-copy"></i>
                </span>
            </a>
        </li>
        <li class="book-li" role="link">
            <a href="{{route('member.outboxs.index')}}?redirect_url={{request()->url()}}" class="book-layout" role="option">
                <h3 class="book-title"><i class="iconfont icon-fajianxiang" style="color:#13227a;"></i>发件箱</h3>
                <span class="book-author">
                    <i class="iconfont icon-fanhui-copy"></i>
                </span>
            </a>
        </li>
        <li class="book-li" role="link">
            <a href="{{route('member.user.edit')}}?redirect_url={{request()->url()}}" class="book-layout" role="option">
                <h3 class="book-title"><i class="iconfont icon-bianji" style="color:#1296db;"></i>编辑资料</h3>
                <span class="book-author">
                    <i class="iconfont icon-fanhui-copy"></i>
                </span>
            </a>
        </li>
        <li class="book-li" role="link">
            <a href="{{route('member.user.passedit')}}?redirect_url={{request()->url()}}" class="book-layout" role="option">
                <h3 class="book-title"><i class="iconfont icon-buchongiconsvg06" style="color:#f4ea2a;"></i>修改密码</h3>
                <span class="book-author">
                    <i class="iconfont icon-fanhui-copy"></i>
                </span>
            </a>
        </li>
    </ul>
  </div>
  <div class="user-logout">
    <a href="{{ route('web.login.destroy') }}" class="center-logout">退出登录</a>
  </div>


</div>
--}}
@endsection
