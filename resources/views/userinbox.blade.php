@extends('layouts.default')
@section('title')收件箱@endsection
@section('keywords')收件箱@endsection
@section('description')收件箱@endsection
@section('style')
<style>
.shoujian li {
    position: relative;
    padding: 0px 10px;
		border-bottom: 1px solid #eee;
}

.shoujian li p {
	line-height: 32px;
	height: 32px;
	overflow: hidden;
	text-overflow: ellipsis;/*单行溢出文本显示省略号*/
	white-space: nowrap;/*规定段落中的文本不进行换行*/

}

.shoujian .red-bg{
	color:red;
}

</style>

@endsection
@section('content')
<div class="header online" style="text-align: center;">
    收件箱已存({{$user->relationInboxs->count()}})封
    <a class="header-left" href="{{$bkurl}}">
      <i class="iconfont icon-fanhui1"></i>
    </a>
</div>

<div style="padding-top: 45px;" class="container-warp" v-bind:style="'width:'+ screen_width + 'px;'">
  <ul class="shoujian Displayanimation">
    @if($user->relationInboxs->count() > 0)
      <li style="padding:10px 0;">
      <span class="red-bg">您的等级只能显示 {{$user->getUserHonor()->getMassageMaxCount()}} 封 如果越界请删除不要的收藏才能显示更多</span>
      </li>
      @if(session()->has('message'))
      <li style="padding:10px 5px;">
        <span style="color:blue;">{{ session()->get('message') }}</span>
      </li>
      @endif

      @foreach($user->relationInboxs as $message)
      <li>
        <p>发件人：{{ $message->fromname }}</p>
        <p>标题：<a href="{{ route('novel.inboxs.show',['id'=> $message->messageid ]) }}?redirect_url={{request()->url()}}">{{$message->title}}</a></p>
        <p>日期：{{formatTime($message->postdate)}}</p>
        <p>
          状态：
          @if($message->isread <= 0)
              <font color="red">未读</font>
          @else
              已读
          @endif
        </p>
        <p><a class="red-bg" href="{{ route('novel.inboxs.destroy',['id'=>$message->messageid]) }}">删除消息</a></p>
      </li>
      @endforeach

    @endif
  </ul>
</div>

@endsection
