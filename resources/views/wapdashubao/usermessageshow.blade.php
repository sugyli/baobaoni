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

<div class="showMess">
  <div class="mulu_header">
		<a class="top__back" href="/"></a>
		<span class="top__title online">查看消息</span>
		<div class="mulu-header-right"></div>
	</div>
  <div style="padding-top:45px;">
  		<ul class="Displayanimation">
            @if(session()->has('message'))
            <li style="padding:10px 5px;">
              <span style="color:blue;">{{ session()->get('message') }}</span>
            </li>
            @endif

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

</div>

@endsection
