@extends('webdashubao.layouts.default')
@section('style')
<style>
.case_main {
  margin: 10px auto;
  width: 960px;
  overflow: hidden;

}
.case_left {
    float: left;
    width: 222px;
    overflow: hidden;
}
.case_left dl {
    width: 220px;
    border: #dee1e6 1px solid;
    overflow: hidden;
    margin-bottom: 15px;
}
.case_left dt {
    background: url(/webdashubao/images/case.png) no-repeat;
    height: 32px;
    font-size: 14px;
    font-weight: bold;
    color: #208181;
    padding-left: 10px;
    line-height: 32px;
}
.case_left dd {
    margin: 10px;
    background: url(/webdashubao/images/case.png) no-repeat 0 -32px;
    border-bottom: #dee1e6 1px dashed;
    height: 25px;
    line-height: 25px;
    padding-left: 20px;
}
.case_main .case_left a:hover{
  color: red;
}
@yield('substyle')
</style>
@endsection

@section('content')
@include('webdashubao.packaging.logo-nav-jilu-qiandao')
@if(session()->has('message'))
<div class="jilu main re f-cb" style="margin:8px auto;background-color: #FF00FF;">
  <div class="jilu_l">
    {{ session()->get('message') }}
  </div>
</div>
@endif

<div class="case_main re f-cb">

  <div class="case_left">
    <dl>
      <dt>会员中心</dt>
      <dd>
        <a {{ Request::is('member/user') ? " href=javascript: class=active " : 'href='.route('member.show').' ' }} title="会员资料">会员资料</a>
      </dd>
      <dd>
        <a {{ Request::is('member/bookshelf') ? " href=javascript: class=active " : 'href='.route('bookshelf.show').' ' }} title="我的书架">我的书架</a>
      </dd>
      <dd>
        <a {{ Request::is('member/user/edit') ? " href=javascript: class=active " : 'href='.route('member.edit').' ' }} title="修改资料">修改资料</a>
      </dd>
      <dd>
        <a {{ Request::is('member/user/passedit') ? " href=javascript: class=active " : 'href='.route('member.passedit').' ' }} title="修改密码">修改密码</a>
      </dd>
      <dd>
        <a href="{{ route('login.destroy') }}" title="退出登录">退出登录</a>
      </dd>
    </dl>

    <dl>
      <dt>消息中心</dt>
      <dd>
        <a {{ Request::is('member/inboxs') ? " href=javascript: class=active " : 'href='.route('inboxs.index').' ' }} title="收件箱">收件箱</a>
      </dd>
      <dd>
        <a {{ Request::is('member/outboxs') ? " href=javascript: class=active " : 'href='.route('outboxs.index').' ' }} title="发件箱">发件箱</a>
      </dd>
      <dd>
        <a {{ Request::is('member/outboxs/create') ? " href=javascript: class=active " : 'href='.route('outboxs.create').' ' }} title="联系管理员">联系管理员</a>
      </dd>
    </dl>

  </div>


<div class="case_right re">
{{--
  @if(session()->has('message'))
  <div class="case_msg">{{ session()->get('message') }}</div>
  @endif
--}}
  @yield('usercontent')
</div>

</div>

@endsection
