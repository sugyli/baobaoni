@extends('mnovels.layouts.default')
@section('title')收件箱@endsection
@section('keywords')收件箱@endsection
@section('description')收件箱@endsection
@section('content')
<div class="header online" style="text-align: center;">
    收件箱已存({{$user->relationInboxs->count()}})封
    <a class="header-left" href="{{$bkurl}}">
      <i class="iconfont icon-fanhui1"></i>
    </a>
</div>

<div style="padding-top: 45px;" class="container-warp" id="root">
  <ul class="message Displayanimation">
    @if($user->relationInboxs->count() > 0)
      <li style="padding:10px 0;">
      <span class="red-bg">您的等级只能显示 {{$user->getMassageMaxCount()}} 封 如果越界请删除不要的收藏才能显示更多</span>
      </li>
      @if(session()->has('message'))
      <li style="padding:10px 5px;">
        <span style="color:blue;">{{ session()->get('message') }}</span>
      </li>
      @endif

      @foreach($user->relationInboxs as $message)
        <li>
          <a href="{{ route('mnovels.inboxs.show',['id'=> $message->messageid ]) }}">
            <p>发件人：{{ $message->fromname }}</p>
            <p>标题：{{$message->title}}</p>
            <p>日期：{{formatTime($message->postdate)}}</p>
            <p>
              状态：
              @if($message->isread <= 0)
                  <font color="red">未读</font>
              @else
                  已读
              @endif
            </p>
          </a>
          <p><a class="red-bg" href="{{ route('mnovels.inboxs.destroy',['id'=>$message->messageid]) }}">删除消息</a></p>
        </li>

      @endforeach
      @include('mnovels.layouts.foot')
    @endif
  </ul>
</div>

@endsection
