@extends('wapdashubao.layouts.default')
@section('title')用户签到@endsection
@section('keywords')用户签到@endsection
@section('description')用户签到@endsection
@section('style')
<style>
.qiandao{
    padding: 0 14px;
    position: relative;

}
.qiandao_ttl {
    padding: 24px 0;
    color: #999;
}
.qiandao_u-btn {
    background: #72add8;
    color: #fff;
    text-align: center;
    line-height: 41px;
    font-size: 14px;
}
</style>

@endsection
@section('content')
<div class="header online HeaderTitlePosition">
    用户签到
    <a href="/" class="header-left">
      <i class="iconfont icon-fanhui1"></i>
    </a>
</div>
<div style="padding-top: 45px;" class="container-warp" v-bind:style="'width:'+ screen_width + 'px;'">
<div class="qiandao">
  @if(session()->has('message'))
  <p style="color:red;padding-top;5px;">{{ session()->get('message') }}</p>
  @endif
  <p class="qiandao_ttl">每天签到领取经验</p>
  @if(!$isqiandao)
    <div class="qiandao_u-btn" onclick="javascript:{document.location='{{ route('member.qiandao.update') }}';}">我要签到</div>
  @else
    <div class="qiandao_u-btn">已经签到</div>
  @endif

</div>


</div>









@endsection
