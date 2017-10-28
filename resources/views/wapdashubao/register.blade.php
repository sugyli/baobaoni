@extends('wapdashubao.layouts.default')
@section('title')用户注册@endsection
@section('keywords')用户注册@endsection
@section('description')用户注册@endsection

@section('content')
<mheader
  left_icon = 'icon-fanhui1'
  left_href = '{{$redirect_url or '/'}}'
  right_icon = ''
  right_href =''
  title = '注册账户'
  title_position = 'HeaderTitlePosition'
></mheader>
<div style="padding-top: 45px;" class="container-warp" v-bind:style="'width:'+ screen_width + 'px;'">
  <div class="login-nav-bk">
    <ul>
      <li><a href="{{ $loginSubmitAddress }}" >登陆账户</a></li>
      <li><a href="javascript:"  style="color:#f85959;">注册账户</a></li>
      <li><a href="javascript:" >找回密码</a></li>
    </ul>
  </div>
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
      </div>
    </form>
</div>

@endsection
