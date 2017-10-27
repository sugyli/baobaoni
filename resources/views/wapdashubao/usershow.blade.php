
@extends('wapdashubao.layouts.default')

@section('title')用户中心@endsection
@section('keywords')用户中心@endsection
@section('description')用户中心@endsection
@section('style')
<style>
.user-box{
  min-height: calc(100vh - (84rem / 16));
  background-color: #f6f7f9;
  box-shadow: 0 200px #fff;
  overflow: hidden;
  padding-bottom: .1px;
}
.user_header{
    height: 44px;
    font: 15px/45px a;
    width: 100%;
    text-align: left;
    font-size: 14px;
}
.user__back {
    float: left;
    width: 42px;
    height: 44px;
    color: #fff;
    font-size: 22px;
    text-align: center;
}

.center-header {
    font-size: 14px;
    overflow: hidden;
    min-height: 135px;
    text-align: center;
    color: #fff;
    background: #ed424b url(/wapdashubao/images/center-header-bg.c36bb.jpg) no-repeat center;
    background-size: cover;

}
.center-header-img {
    width: 58px;
    height: 58px;
    vertical-align: bottom;
    border: 1px solid rgba(255,255,255,.4);
    border-radius: 4rem;
    margin-top: 8px;
}
.center-header-p {
    margin-top: 5px;
    word-break: break-all;
    margin-bottom: 20px;

}
.user-module{
  background-color: #fff;
  margin: 0;
}
.user-module .cell {
    display: table-cell;
    width: 101vw;
}
.user-module .cell .btn-group {
    display: table;
    width: 100%;
    margin-right: auto;
    margin-left: auto;
    table-layout: fixed;
}
.btn-group-cell {
    font-size: 100%;
    font-weight: 400;
    display: table-cell;
}
.center-acc-li {
    font-size: .75rem;
    height: 4rem;
    text-align: center;
}

.center-acc-li output {
    font-size: 16px;
    display: block;
    margin: .75rem 0 -1px;
}
output {
    speak: digits;
}
.gray {
    color: #969ba3;

}
p {
    word-break: break-all;
    font-size: 14px;
}
.center-pay {
    font-size: .75rem;
    position: relative;
    float: right;
    width: 25%;
    height: 4rem;
    text-align: center;
    color: #ed424b;
    border-left: 1px solid #f0f1f2;
}
.center-pay::before {
    position: absolute;
    top: 50%;
    left: -3px;
    width: 5px;
    height: 5px;
    margin-top: -3px;
    content: '';
    -webkit-transform: rotate(45deg);
    transform: rotate(45deg);
    color: #f0f1f2;
    border-top: 1px solid;
    border-right: 1px solid;
    background-color: #fff;
}
.user-module-nav{
  margin: .75rem 0;
  background-color: #fff;
}
.center-nav-ol {
    line-height: 1.25rem;

}
.center-nav-ol li {
    display: list-item;
    text-align: -webkit-match-parent;
}
.book-li::after {
    display: block;
    margin-top: -1px;
    margin-left: 1rem;
    content: '';
    -webkit-transition: margin-left .15s;
    transition: margin-left .15s;
    border-bottom: 1px solid #f0f1f2;
}
.center-nav-ol li:last-child:after {
    border-bottom: none;
}
.book-layout {
    text-decoration: none;
    color: inherit;
    outline: 0;
    position: relative;
    display: block;
    overflow: hidden;
    padding: 1rem;
    -webkit-transition: padding-left .15s;
    transition: padding-left .15s;
}
.book-title {
    line-height: 1.4;
    overflow: hidden;
    white-space: nowrap;
    text-overflow: ellipsis;
    float: left;
}
.book-title i{
  margin-right:10px;
}

.center-nav-ol .book-author {
    float: right;
    font-size: .8125rem;
    display: block;
    overflow: hidden;
    max-width: 10em;
    max-width: calc(100vw - 2rem - (176rem / 16));
    white-space: nowrap;
    text-overflow: ellipsis;
    color: #969ba3;
}
.book-author {
    line-height: 1.4;
    font-size: .8125rem;
    display: block;
    overflow: hidden;
    max-width: 10em;
    max-width: calc(100vw - 2rem - (176rem / 16));
    white-space: nowrap;
    text-overflow: ellipsis;
    color: #969ba3;
    float: right;
}
.user-logout {
    margin: .75rem 0;
    background-color: #fff;
}
.center-logout {
    line-height: 3rem;
    text-align: center;
    font-size: 14px;
    display: block;
    color: #ed424b;
    background: 0 0;
}
</style>

@endsection
@section('content')

<div class="user-box">
  <div class="center-header">
    <div class="user_header">
      <a href="javascript:" onclick="javascript:history.go(-1);" class="user__back iconfont icon-fanhui1"></a>
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
                <a href="/user/ticket/month" role="option">
                    <output>{{ $user->getUserHonor()->getDayRecommendCount() }}</output>
                    <p class="gray">日票</p>
                </a>
            </li>
            <li class="btn-group-cell center-acc-li" role="link">
                <a href="/user/ticket/recomm" role="option">
                    <output>{{ $user->getUserHonor()->getBookcaseCount() }}</output>
                    <p class="gray">书架</p>
                </a>
            </li>
            <li class="btn-group-cell center-acc-li" role="link">
                <a href="/user/ticket/recomm" role="option">
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
            <a href="{{route('member.bookshelf.index')}}" class="book-layout" role="option">
                <h3 class="book-title"><i class="iconfont icon-weibiaoti3zhuanhuan" style="color:#d4237a;"></i>会员书架</h3>
                <span class="book-author">
                    <i class="iconfont icon-fanhui-copy"></i>
                </span>
            </a>
        </li>
        <li class="book-li" role="link">
            <a href="/user/msg/sys" class="book-layout" role="option">
                <h3 class="book-title"><i class="iconfont icon-xiaoxi" style="color:#1296db;"></i>消息中心</h3>
                <span class="book-author">
                    <i class="iconfont icon-fanhui-copy"></i>
                </span>
            </a>
        </li>
        <li class="book-li" role="link">
            <a href="/user/msg/sys" class="book-layout" role="option">
                <h3 class="book-title"><i class="iconfont icon-xiaoxi" style="color:#1296db;"></i>消息中心</h3>
                <span class="book-author">
                    <i class="iconfont icon-fanhui-copy"></i>
                </span>
            </a>
        </li>
        <li class="book-li" role="link">
            <a href="/user/msg/sys" class="book-layout" role="option">
                <h3 class="book-title"><i class="iconfont icon-xiaoxi" style="color:#1296db;"></i>消息中心</h3>
                <span class="book-author">
                    <i class="iconfont icon-fanhui-copy"></i>
                </span>
            </a>
        </li>
        <li class="book-li" role="link">
            <a href="/user/msg/sys" class="book-layout" role="option">
                <h3 class="book-title"><i class="iconfont icon-xiaoxi" style="color:#1296db;"></i>消息中心</h3>
                <span class="book-author">
                    <i class="iconfont icon-fanhui-copy"></i>
                </span>
            </a>
        </li>
    </ul>
  </div>
  <div class="user-logout">
    <a href="javascript:" class="center-logout">退出登录</a>
  </div>


</div>

@endsection
