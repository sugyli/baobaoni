@extends('webdashubao.layouts.user')
@section('title')收件箱@endsection
@section('keywords')收件箱@endsection
@section('description')收件箱@endsection
@section('usercontent')
@section('substyle')
.top {
    width: 100%;
    height: 35px;
    line-height: 35px;
    border-bottom: 1px solid #dee1e6;
}
.case_right li {
    height: 31px;
    color: #666;
    overflow: hidden;
}
.case_right li.top {
    background: #eff;
    height: 31px;
    font-weight: bold;
    overflow: hidden;
}
.case_right span {
    float: left;
    line-height: 30px;
    height: 30px;
    color: #333;
    overflow: hidden;
    border-right: #dee1e6 1px solid;
    text-align: center;
    border-bottom: #dee1e6 1px solid;
}
.case_right .fk {
    width: 28px;
}
.case_right li .input {
    width: 15px;
    height: 15px;

}
.case_right .wz {
    width: 135px;
}
.case_right .bt {
    width: 365px;
}
.case_right .rq {
    width: 85px;
}
.case_right .sc {
    width: 110px;
    border-right: medium none;
}

.case_right .sc img {
    padding-top: 10px;
}

.case_right li.bottom {
    text-align: center;
    background: #eff;
    height: 38px;
    line-height: 38px;
    font-weight: bold;
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
<form action="{{ route('member.inboxs.destroy') }}" method="post" name="checkform" id="checkform">
  {{ csrf_field() }}
  {{ method_field('DELETE') }}
  <div class="case_title">收件箱（您的等级只显示收件箱数：{{$user->getUserHonor()->getMassageMaxCount()}}，现有消息数：{{$user->relationInboxs->count()}}条） </div>
  <ul>
    <li class="top">
      <span class="fk">
        <input class="input" type="checkbox" id="checkall" name="checkall" value="checkall" onclick="javascript: for(var i=0;i<this.form.elements.length;i++){ if(this.form.elements[i].name != 'checkkall') this.form.elements[i].checked = form.checkall.checked; }">
      </span>
      <span class="wz">发件人</span>
      <span class="bt">标题</span>
      <span class="rq">日期</span>
      <span class="sc">状态</span>
    </li>
    @if($user->relationInboxs->count() > 0)
      @foreach($user->relationInboxs as $message)
      <li>
        <span class="fk">
          <input class="input" type="checkbox" id="checkid[]" name="checkid[]" value="{{$message->messageid}}">
        </span>
        <span class="wz">
          <font color="#FF0000">{{ $message->fromname }}</font>
        </span>
        <span class="bt">
          <a href="{{ route('member.inboxs.show',['id'=> $message->messageid ]) }}" title="{{$message->title}}">{{$message->title}}</a>
        </span>
        <span class="rq">{{formatTime($message->postdate)}}</span>
        <span class="sc">
          @if($message->isread <= 0)
          <img src="/webdashubao/images/new.gif">
          @else
          已读
          @endif
        </span>
      </li>
      @endforeach
    @endif
    <li class="bottom">
      <input type="button" name="allcheck" value="全部选中" class="button" onclick="javascript: for (var i=0;i<this.form.elements.length;i++){ this.form.elements[i].checked = true; }">
      <input type="button" name="nocheck" value="全部取消" class="button" onclick="javascript: for (var i=0;i<this.form.elements.length;i++){ this.form.elements[i].checked = false; }">
      <input type="button" name="delcheck" value="删除选中记录" class="button" onclick="javascript:var flag = false;for (var i=0;i<this.form.elements.length;i++){ if (this.form.elements[i].name != 'checkkall' && this.form.elements[i].checked){ flag = true; } } if(!flag) { alert('请选择需要删除的数据！'); return false;} if(confirm('确实要删除选中记录么？')){ this.disabled=true;this.value='提交中...'; this.form.submit();}">
    </li>
  </ul>
</form>
@endsection
