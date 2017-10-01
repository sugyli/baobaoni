@extends('webdashubao.layouts.default')
@section('title')用户登录@endsection
@section('keywords')用户登录@endsection
@section('description')用户登录@endsection
@section('content')
@include('webdashubao.packaging.logo-nav-jilu-qiandao')

<div class="main_tab re">
  <div class="tab ">
    <li class="log">注册通行证</li>
  </div>

  <div class="tab-d">
    <div class="tab-l">
      <form name="frmlogin" action="{{ $loginSubmitAddress }}" method="post">
        {{ csrf_field() }}
        <ul>
          <li class="ckl">通行证账号：</li>
          <li class="ckz">
            <input type="text" value="{{ old('uname') }}" name="uname" maxlength="30" />
          </li>
          <li class="ckr">
            {!! $errors->first('uname', '<span><img border="0" height="13" width="13" src="/webdashubao/images/checkerror.gif"> :message</span>') !!}
          </li>
        </ul>

        <ul>
          <li class="ckl">密码：</li>
          <li class="ckz">
            <input type="password" name="password" maxlength="20" />
          </li>
          <li class="ckr">
            {!! $errors->first('password', '<span><img border="0" height="13" width="13" src="/webdashubao/images/checkerror.gif"> :message</span>') !!}
          </li>
        </ul>

        <div class="button">
          <input type="submit" class="btn" value="注册通行证" onclick="javascript:{this.disabled=true;this.value='提交中...';document.frmlogin.submit();}">
          <a href="{{ $passwordSubmitAddress }}" title="忘记密码">忘记密码?</a>
        </div>

      </form>

    </div>


    <div class="tab-r">
      <dl>
        <dt>用户注册</dt>
        <dd>已经有账号了？</dd>
        <dd><a href="{{ $registerSubmitAddress }}" title="登陆">立即注册</a></dd>
      </dl>
    </div>
  </div>
</div>





@endsection
