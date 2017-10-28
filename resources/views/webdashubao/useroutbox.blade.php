@extends('webdashubao.layouts.user')
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
    width: 145px;
}
.case_right .bt {
    width: 407px;
}
.case_right .rq {
    width: 145px;
    border-right: medium none;
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
<form action="{{ route('member.outboxs.destroy') }}" method="post" name="checkform" id="checkform">
  {{ csrf_field() }}
  {{-- method_field('DELETE') --}}
  <div class="case_title">发件箱（您的等级只显示发件箱数：{{$user->getUserHonor()->getMassageMaxCount()}}，现有消息数：{{$user->relationOutboxs->count()}}条） </div>
  <ul>
    <li class="top">
      <span class="fk">
        <input class="input" type="checkbox" id="checkall" name="checkall" value="checkall" />
      </span>
      <span class="wz">发送给</span>
      <span class="bt">标题</span>
      <span class="rq">日期</span>
    </li>
    @if($user->relationOutboxs->count() > 0)
    @foreach($user->relationOutboxs as $message)
    <li>
      <span class="fk">
        <input class="input" type="checkbox" name="checkid[]" value="{{$message->messageid}}">
      </span>
      <span class="wz">
        <font color="#FF0000">{{ $message->toname }}</font>
      </span>
      <span class="bt">
        <a href="{{ route('member.outboxs.show',['id'=> $message->messageid ]) }}" title="{{$message->title}}">{{$message->title}}</a>
      </span>
      <span class="rq">{{ formatTime($message->postdate) }}</span>
    </li>
    @endforeach
    @endif
    <li class="bottom">
      <input type="button" id="allcheck" name="allcheck" value="全部选中" class="button" />
      <input type="button" id="nocheck" name="nocheck" value="全部取消" class="button" />
      <input type="button" id="delcheck" name="delcheck" value="删除选中记录" class="button" />
    </li>
  </ul>
</form>
@endsection
