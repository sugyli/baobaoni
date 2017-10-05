@extends('webdashubao.layouts.user')
@section('title')我的消息内容@endsection
@section('keywords')我的消息内容@endsection
@section('description')我的消息内容@endsection
@section('usercontent')
@section('substyle')
.case_right .msg_title{
    background: url(/webdashubao/images/case.png) repeat-x 0 -58px;
    height: 38px;
    line-height: 38px;
    padding-left: 10px;
    font-size: 14px;
    font-weight: bold;
    color: #208181;


}
.case_right .msg_left {
    padding-left: 10px;
    height: 40px;
    line-height: 40px;
    width: 100%;
    color: #666;
    border-bottom: 1px dashed #ddd;
}

.msg_neirong{
    clear:both;
    overflow:hidden;
    padding: 10px;
    font-size: 13px;
}
.msg_foot{
  color: #666;
  overflow: hidden;
  text-align: center;
  background: #eff;
  height: 38px;
  line-height: 38px;
  font-weight: bold;
}
.msg_foot .button {
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
<div class="msg_title">{{$messageData->title}}</div>
<div class="msg_left online">发送人：{{$messageData->fromname}}</div>
<div class="msg_left online">接收人：<font color="#FF0000">{{$messageData->toname}}</font></div>
<div class="msg_left online">发送时间：{{formatTime($messageData->postdate)}}</div>
<div class="msg_neirong">
{!! $messageData->content !!}
</div>
<form action="{{ Request::is('member/inboxs/*') ? route('member.inboxs.destroy') : route('member.outboxs.destroy') }}" method="post">
  {{ csrf_field() }}
  {{ method_field('DELETE') }}
  <div class="msg_foot">
    @if(Request::is('member/inboxs/*'))
    <input type="button" value="回复邮件" class="button" onclick="javascript:document.location='{{ route('member.outboxs.create') }}'">
    @endif
    <input type="button" value="{{ Request::is('member/inboxs/*') ? '返回收件箱' : '返回发件箱' }}" class="button" onclick="javascript:document.location='{{ Request::is('member/inboxs/*') ? route('member.inboxs.index') : route('member.outboxs.index') }}'">
    <input type="button" value="删除此消息" class="button" onclick="javascript:if(confirm('确实要删除此记录么？')){ this.disabled=true;this.value='提交中...'; this.form.submit();}">
    <input name="checkid" type="hidden" value="{{$messageData->messageid}}">
  </div>
</div>

@endsection
