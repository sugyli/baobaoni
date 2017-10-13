@extends('webdashubao.layouts.user')
@section('title')修改密码@endsection
@section('keywords')修改密码@endsection
@section('description')修改密码@endsection
@section('substyle')
.msg_left {
    float: left;
    text-align: right;
    height: 40px;
    line-height: 40px;
    width: 200px;
    color: #666;
}
.msg_right {
    height: 40px;
    line-height: 40px;
    width: 500px;
    float: left;
}
.msg_right .input {
    float: left;
    height: 25px;
    line-height: 25px;
    margin-top: 8px;
    width: 250px;
    border: #dee1e6 1px solid;
    padding-left: 5px;
}
.case_right label{
  float: left;
  height: 25px;
  line-height: 25px;
  font-size: 12px;
  padding-top: 8px;
  padding-left: 5px;
}
.case_right img{
  /*vertical-align:text-bottom;*/
  padding-right: 5px;
}
.case_right .button {
    margin-left: 5px;
    line-height: 25px;
    padding: 0 5px;
    border: #dee1e6 1px solid;
    height: 25px;
    cursor: pointer;
    color: #000;
    background: #e6f5e2;
}
@endsection
@section('usercontent')
<div class="case_title">修改密码</div>
<form name="formtable" action="{{ route('member.user.passedit') }}" method="post">
  {{ csrf_field() }}
  <div class="msg_left">原密码：</div>
  <div class="msg_right">
    <input type="password" class="input" name="pass" value="{{old('pass')}}">
    {!! $errors->first('pass', '<label><img border="0" height="13" width="13" src="/webdashubao/images/checkerror.gif"> :message</label>') !!}
  </div>
  <div class="msg_left">新密码：</div>
  <div class="msg_right">
    <input type="password" class="input" name="newpass" value="">
    {!! $errors->first('newpass', '<label><img border="0" height="13" width="13" src="/webdashubao/images/checkerror.gif"> :message</label>') !!}
  </div>
  <div class="msg_left">重复密码：</div>
  <div class="msg_right">
    <input type="password" class="input" name="newpass_confirmation" value="">
    {!! $errors->first('newpass_confirmation', '<label><img border="0" height="13" width="13" src="/webdashubao/images/checkerror.gif"> :message</label>') !!}
  </div>
  <div class="msg_left"></div>
  <div class="msg_right">
    <input type="button" class="button" onclick="javascript:{this.disabled=true;this.value='提交中...';document.formtable.submit();}" value="保 存">
  </div>
</form>

@endsection
