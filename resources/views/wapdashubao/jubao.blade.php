@extends('wapdashubao.layouts.default')
@section('title')发送邮件@endsection
@section('keywords')发送邮件@endsection
@section('description')发送邮件@endsection
@section('style')
<style>
.jubao-title {
    text-overflow: ellipsis;
    white-space: nowrap;
    overflow: hidden;
    border-bottom: 1px solid #eaeaea;
    padding-left: 32px;
    padding-right: 64px;
}
.jubao-title > h2 {
  text-overflow: ellipsis;
  white-space: nowrap;
  overflow: hidden;
  padding: 0;
  font-weight: 500;
  font-size: 22px;
  height: 64px;
  line-height: 64px;
}
.jubao-content {
    transform: none;
    opacity: 1;
    transition-property: transform, opacity;
    transition-duration: 0.3s;
    transition-delay: 0.09s;
    transition-timing-function: cubic-bezier(0.52, 0.02, 0.19, 1.02);
    display: flex;
    align-items: center;
    padding-left: 32px;
    padding-right: 32px;
    padding-top: 24px;
    padding-bottom: 24px;
    line-height: 1.5;
}
.jubao-content-content {
    flex-grow: 1;
}
</style>

@endsection
@section('content')
<div class="header online HeaderTitlePosition">
    发消息
    <a href="{{$bkurl}}" class="header-left">
      <i class="iconfont icon-fanhui1"></i>
    </a>
</div>

<div style="padding-top: 45px;" class="container-warp" v-bind:style="'width:'+ screen_width + 'px;'">
  <div class="jubao-title">
    <h2>举报错误</h2>
  </div>
  <form id="jubaoForm" name="frmnewmessage" action="{{ route('member.outboxs.store') }}" method="post">
    {{ csrf_field() }}
    <input type="hidden" name="from" value="{{ old($from) ?: $from }}">
    <input type="hidden" name="title" value="{{ old($title) ?: $title }}">
    <input type="hidden" name="redirect_url" value="{{ $bkurl }}">
    @if( $errors->any())
      @foreach($errors->all() as $error)
        <span style="padding-left:32px;height:35px;line-height:35px;color:red;">
          {{ $error }}
        </span>
      @endforeach
    @endif

    <div class="jubao-content">
      <div class="jubao-content-content">
          <textarea name="content" placeholder="输入举报内容 来源地址 我们已经记录了" class="textarea" :style="'width:100%;height:'+ (screen_height * 0.4)+ 'px;'" >{!! old('content') !!}</textarea>
          <div class="input_el">
            <input type="button" class="btn_small" onClick="javascript:{this.disabled=true;this.value='提交中...';document.frmnewmessage.submit();};" value="发 送"/>
          </div>
      </div>
    </div>
  </form>
</div>

@endsection
