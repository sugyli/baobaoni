@extends('wapdashubao.layouts.default')
@section('title')用户登录@endsection
@section('keywords')用户登录@endsection
@section('description')用户登录@endsection
@section('style')
<style>

.login-nav-bk ul li:first-child a{
    color: #f85959;
}
</style>

@endsection
@section('content')
<mheader
  left_icon = 'icon-fanhui1'
  left_href = '{{$redirect_url or '/'}}'
  right_icon = ''
  right_href =''
  title = '登录账户'
  title_position = 'HeaderTitlePosition'
></mheader>
<div style="padding-top: 45px;" class="container-warp" v-bind:style="'width:'+ screen_width + 'px;'">
  <div class="login-nav-bk">
    <ul>
      <li><a href="javascript:" >登陆账户</a></li>
      <li><a href="{{ $registerSubmitAddress }}" >注册账户</a></li>
      <li><a href="javascript:" >找回密码</a></li>
    </ul>
  </div>
  <form name="frmlogin" action="{{ $loginSubmitAddress }}" method="post">
      {{ csrf_field() }}
      <div class="login">
        <p>帐号：<input maxlength="30" value="{{ old('uname') }}" name="uname" autocomplete="off" onkeypress="javascript: if (event.keyCode==32) return false;" type="text" class="login_name"></p>
        {!! $errors->first('uname', '<p style="color:red;"> :message</p>') !!}
        <p>密码：<input maxlength="20" type="password" name="password" class="login_name"></p>
        {!! $errors->first('password', '<p style="color:red;"> :message</p>') !!}
        <input type="submit" class="login_btn" value="立即登陆" onclick="javascript:{this.disabled=true;this.value='提交中...';document.frmlogin.submit();}">
      </div>
    </form>

</div>
@endsection
