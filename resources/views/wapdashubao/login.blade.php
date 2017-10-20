@extends('wapdashubao.layouts.default')
@section('title')用户登录@endsection
@section('keywords')用户登录@endsection
@section('description')用户登录@endsection
@section('style')
<style>
.login-header {
    color: #fff;
    height: 44px;
    line-height: 44px;
    background-color: #1ABC9C;
    font: 15px/45px a;
    width: 100%;
}
.login-left{
  float: left;
  width: 42px;
  height: 44px;
}
.login-left:before {
    content: '';
    display: block;
    margin: 15px 0 0 16px;
    width: 10px;
    height: 16px;
    background: url(/wapdashubao/images/back.png) no-repeat;
    background-size: 10px 16px;
}
.login-nav-bk {
    border-bottom-width: 1px;
    border-bottom-style: solid;
    background-color: #fff;
    border-color: #CCC;
    height: 42px;
}
.login-nav-bk ul li {
    float: left;
    width: 33.33%;
    margin: 10px 0px;
    text-align: center;
}
.login-nav-bk ul li:first-child a{
    color: #f85959;
}


.login {
    margin: 10px;
    line-height: 35px;
    font-weight: bold;
}
.login input.login_name {
    border: 1px solid #ddd;
    height: 40px;
    line-height: 40px;
    width: 100%;
    border-radius: 4px;
    font-size: 16px;
    padding-left: 5px;
    -moz-box-sizing: border-box;
    -webkit-box-sizing: border-box;
    -o-box-sizing: border-box;
    -ms-box-sizing: border-box;
    box-sizing: border-box;
    outline: 0;
}
.login_btn {
  width: 100%;
  border: 0;
  display: block;
  text-align: center;
  color: #fff;
  font-weight: bold;
  height: 30px;
  line-height: 30px;
  margin-top: 20px;
  background-color: #1ABC9C;
}

</style>

@endsection
@section('content')
<div :style="'height:'+screen_height+'px;background: #fff;'">
  <div class="login-header">
      <div class="login-left" onclick="javascript:history.go(-1);"></div>
      返回
  </div>

  <div class="login-nav-bk">
    <ul>
      <li><a href="javascript:;" >登陆账户</a></li>
      <li><a href="{{ $registerSubmitAddress }}" >注册账户</a></li>
      <li><a href="{{ $passwordSubmitAddress }}" >找回密码</a></li>
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
