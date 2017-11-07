@extends('layouts.default')
@section('title')修改密码@endsection
@section('keywords')修改密码@endsection
@section('description')修改密码@endsection

@section('content')
<div class="header online" style="text-align: center;">
    修改密码
    <a class="header-left" href="{{$bkurl}}">
      <i class="iconfont icon-fanhui1"></i>
    </a>
</div>
<div style="padding-top: 45px;" class="container-warp" v-bind:style="'width:'+ screen_width + 'px;'">

  <form name="formtable" action="{{ route('novel.user.passedit') }}" method="post">
      {{ csrf_field() }}
      <div class="login">
        <p>原密码：<input class="login_name" type="password" name="pass" value="{{old('pass')}}"></p>
        {!! $errors->first('pass', '<p style="color:red;"> :message</p>') !!}
        <p>新密码：<input class="login_name" type="password" name="newpass" value=""></p>
        {!! $errors->first('newpass', '<p style="color:red;"> :message</p>') !!}
        <p>重复密码：<input class="login_name" type="password" name="newpass_confirmation" value=""></p>
        {!! $errors->first('newpass_confirmation', '<p style="color:red;"> :message</p>') !!}
        <input type="submit" class="login_btn" onclick="javascript:{this.disabled=true;this.value='提交中...';document.formtable.submit();}" value="保 存">
      </div>
    </form>

</div>
@endsection
