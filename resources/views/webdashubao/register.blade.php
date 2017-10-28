@extends('webdashubao.layouts.default')
@section('title')用户注册@endsection
@section('keywords')用户注册@endsection
@section('description')用户注册@endsection
@section('content')
@include('webdashubao.packaging.logo-nav-jilu-qiandao')

<div class="main_tab re">
  <div class="tab ">
    <li class="log">注册通行证</li>
  </div>

  <div class="tab-d">
    <div class="tab-l">
      <form name="frmregister" action="{{ $registerSubmitAddress }}" method="post">
        {{ csrf_field() }}
        <ul>
          <li class="ckl">通行证账号：</li>
          <li class="ckz">
            <input type="text" value="{{ old('uname') }}" name="uname" maxlength="30" autocomplete="off" />
          </li>
          <li class="ckr">
            {!! $errors->first('uname', '<span><img border="0" height="13" width="13" src="/webdashubao/images/checkerror.gif"> :message</span>') !!}
          </li>
        </ul>

        <ul>
          <li class="ckl">密码：</li>
          <li class="ckz">
            <input type="password" name="pass" maxlength="20" />
          </li>
          <li class="ckr">
            {!! $errors->first('pass', '<span><img border="0" height="13" width="13" src="/webdashubao/images/checkerror.gif"> :message</span>') !!}
          </li>
        </ul>


        <ul>
          <li class="ckl">确认密码：</li>
          <li class="ckz">
            <input type="password" name="pass_confirmation" maxlength="20" />
          </li>
          <li class="ckr">
            {!! $errors->first('pass_confirmation', '<span><img border="0" height="13" width="13" src="/webdashubao/images/checkerror.gif"> :message</span>') !!}
          </li>
        </ul>

        <div class="button">
          <input type="submit" class="btn" value="注册通行证" onclick="javascript:{this.disabled=true;this.value='提交中...';document.frmregister.submit();}" />
          {{--<a href="{{ $passwordSubmitAddress }}" title="忘记密码">忘记密码?</a>--}}
          <a href="javascript:" title="忘记密码">忘记密码?</a>
        </div>
      </form>

    </div>


    <div class="tab-r">
      <dl>
        <dt>用户登陆</dt>
        <dd>已经有账号了？</dd>
        <dd><a href="{{ $loginSubmitAddress }}" title="登陆">立即登陆</a></dd>
      </dl>
    </div>





  </div>


</div>





@endsection
