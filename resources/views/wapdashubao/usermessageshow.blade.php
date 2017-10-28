@extends('wapdashubao.layouts.default')
@section('title')查看信息@endsection
@section('keywords')查看信息@endsection
@section('description')查看信息@endsection
@section('style')
<style>
.showMess{
  background: #fff;
}
.showMess li {
    position: relative;
    padding: 0px 10px;
		border-bottom: 1px solid #eee;
}
.showMess li p{
  margin-bottom: 15px;
}

</style>


@endsection
@section('content')
<div class="header online HeaderTitlePosition">
    信件内容
    <a href="{{$bkurl}}" class="header-left">
      <i class="iconfont icon-fanhui1"></i>
    </a>
</div>
<div style="padding-top: 45px;" class="showMess container-warp" v-bind:style="'width:'+ screen_width + 'px;'">
  <ul class="Displayanimation">
    <li>
      <p>{{$messageData->title}}</p>
      <p>
        发送人：{{$messageData->fromname}}
      </p>
      <p>
        接收人：<font color="#FF0000">{{$messageData->toname}}</font>
      </p>
      <p>
        发送时间：{{formatTime($messageData->postdate)}}
      </p>
      <p style="border-top: 1px dashed #ddd;">
        {!! $messageData->content !!}
      </p>

    </li>

  </ul>

</div>

@endsection
