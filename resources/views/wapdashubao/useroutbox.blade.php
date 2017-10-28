@extends('wapdashubao.layouts.default')
@section('title')发件箱@endsection
@section('keywords')发件箱@endsection
@section('description')发件箱@endsection
@section('style')
<style>
.fajian li {
    position: relative;
    padding: 0px 10px;
		border-bottom: 1px solid #eee;
}

.fajian li p {
	line-height: 32px;
	height: 32px;
	overflow: hidden;
	text-overflow: ellipsis;/*单行溢出文本显示省略号*/
	white-space: nowrap;/*规定段落中的文本不进行换行*/

}

.fajian .red-bg{
	color:red;
}


</style>


@endsection
@section('content')
<div class="header online HeaderTitlePosition">
    发件箱已存({{$user->relationInboxs->count()}})封
    <a href="{{$bkurl}}" class="header-left">
      <i class="iconfont icon-fanhui1"></i>
    </a>
</div>
<div style="padding-top: 45px;" class="container-warp" v-bind:style="'width:'+ screen_width + 'px;'">
<ul class="fajian Displayanimation">
  @if($user->relationOutboxs->count() > 0)
    <li style="padding:10px 0;">
    <span class="red-bg">您的等级只能显示 {{$user->getUserHonor()->getMassageMaxCount()}} 封 如果越界请删除不要的收藏才能显示更多</span>
    </li>
    @if(session()->has('message'))
    <li style="padding:10px 5px;">
      <span style="color:blue;">{{ session()->get('message') }}</span>
    </li>
    @endif
    @foreach($user->relationOutboxs as $message)
    <li>
      <p>发送给：{{ $message->toname }}</p>
      <p>标题：<a href="{{ route('member.outboxs.show',['id'=> $message->messageid ]) }}?redirect_url={{request()->url()}}">{{$message->title}}</a></p>
      <p>日期：{{ formatTime($message->postdate) }}</p>
      <p><a class="red-bg" href="{{ route('member.outboxs.destroy',['checkid'=>$message->messageid]) }}">删除消息</a></p>
    </li>
    @endforeach
  @endif
</ul>
</div>

@endsection
