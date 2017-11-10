@extends('mnovels.layouts.default')
@section('title')用户登录@endsection
@section('keywords')用户登录@endsection
@section('description')用户登录@endsection
@section('content')
<div class="header online" style="text-align: center;">
    用户登录
    <a class="header-left" href="{{$redirect_url or '/'}}">
      <i class="iconfont icon-fanhui1"></i>
    </a>
    <a class="header-right" href="/">
      <i class="iconfont icon-shouye1"></i>
    </a>
</div>
<div v-bind:style="'width:'+ screen_width + 'px;'" class="container-warp">
  <form name="frmlogin" action="{{$loginSubmitAddress}}" method="post" id="frmlogin">
    {{ csrf_field() }}
    <div class="login">
  		<p>帐号：<input maxlength="30" value="{{ old('uname') }}" name="uname" autocomplete="off" onkeypress="javascript: if (event.keyCode==32) return false;" type="text" class="login_name"></p>
      {!! $errors->first('uname', '<p style="color:red;"> :message</p>') !!}
      <p>密码：<input maxlength="30" type="password" name="password" class="login_name"></p>
      {!! $errors->first('password', '<p style="color:red;"> :message</p>') !!}
      <input type="submit" class="login_btn" value="立即登陆" onclick="javascript:{this.disabled=true;this.value='提交中...';document.frmlogin.submit();}">
      <a class="login_btn" href='{{$registerSubmitAddress}}'>没有账号？点击注册</a>
  	</div>
  </form>
</div>
@endsection
