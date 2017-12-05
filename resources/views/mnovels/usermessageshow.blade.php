@extends('mnovels.layouts.default')
@section('title')查看信息@endsection
@section('keywords')查看信息@endsection
@section('description')查看信息@endsection
@section('content')
<div class="header online" style="text-align: center;">
    信件内容
    <a class="header-left" href="javascript:history.back()">
      <i class="iconfont icon-fanhui1"></i>
    </a>
</div>
<div style="padding-top: 45px;" class="showMess container-warp" id="root">
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
