@extends('mnovels.layouts.default')
@section('title')用户注册@endsection
@section('keywords')用户注册@endsection
@section('description')用户注册@endsection

@section('content')
<div class="header online" style="text-align: center;">
    用户注册
    <a class="header-left" href="{{$redirect_url or '/'}}">
      <i class="iconfont icon-fanhui1"></i>
    </a>
    <a class="header-right" href="/">
      <i class="iconfont icon-shouye1"></i>
    </a>
</div>
<div v-bind:style="'width:'+ screen_width + 'px;'" class="container-warp">
  <form name="frmregister" action="{{ $registerSubmitAddress }}" method="post">
      {{ csrf_field() }}
      <div class="login">
        <p>帐号：<input maxlength="30" value="{{ old('uname') }}" name="uname" autocomplete="off" onkeypress="javascript: if (event.keyCode==32) return false;" type="text" class="login_name"></p>
        {!! $errors->first('uname', '<p style="color:red;"> :message</p>') !!}
        <p>密码：<input maxlength="20" type="password" name="pass" class="login_name"></p>
        {!! $errors->first('pass', '<p style="color:red;"> :message</p>') !!}
        <p>确认密码：<input maxlength="20" type="password" name="pass_confirmation" class="login_name"></p>
        {!! $errors->first('pass_confirmation', '<p style="color:red;"> :message</p>') !!}
        <input type="submit" class="login_btn" value="注册用户" onclick="javascript:{this.disabled=true;this.value='提交中...';document.frmregister.submit();}" />
        <a class="login_btn" href='{{$loginSubmitAddress}}'>已有账号？点击登录</a>
      </div>
    </form>
</div>

@endsection
