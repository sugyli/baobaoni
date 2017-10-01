@extends('webdashubao.layouts.default')
@section('title')用户签到@endsection
@section('keywords')用户签到@endsection
@section('description')用户签到@endsection
@section('style')
<style>
.qd_today {
    width: 930px;
    border: 1px solid #e3efde;
    margin: 10px auto;
    overflow: hidden;
    padding: 15px;
}
.qd_left {
    float: left;
    width: 505px;
    overflow: hidden;
}
.qd_left .title {
    background: url(/webdashubao/images/qiandao.png) no-repeat;
    width: 505px;
    height: 87px;
    text-align: center;
}
.qd_left .title span {
    font-size: 14px;
    padding-top: 40px;
    display: block;
    color: #fff;
    font-weight: bold;
}
.qd_left .qd_rili {
    border-left: 1px solid #b2babd;
    width: 505px;
    overflow: hidden;
    font-family: 'Microsoft YaHei';
}
.qd_rili li {
    background-color: #f0f4f7;
    float: left;
    border-right: 1px solid #b2babd;
    border-bottom: 1px solid #b2babd;
    width: 71px;
    height: 35px;
    line-height: 35px;
    text-align: center;
}
.qd_rili li.today {
    background-color: #fff;
    color: red;
    font-weight: bold;
    font-size: 14px;
}
.qd_right {
    color: #666;
    padding: 10px 15px;
    float: left;
    width: 370px;
    height: 215px;
    margin-top: 30px;
    background-color: #f0f4f7;
    border: 1px solid #b2babd;
    border-left: none;
}
.qd_right li {
    height: 24px;
    line-height: 25px;
}
.qd_right em {
    color: red;
    padding: 0 5px;
}
.qd_check {
    margin: 0px auto;
    padding-top: 30px;
    overflow: hidden;
    width: 930px;
    clear: both;
    text-align:center;
}
.qd_check .btn {
    background: url(/webdashubao/images/loginbg.png) no-repeat -150px -114px;
    width: 150px;
    height: 39px;
    line-height: 39px;
    font-size: 16px;
    color: #fff;
    border: none;
    cursor: pointer;
    font-weight: bold;
}

</style>

@endsection

@section('content')
@include('webdashubao.packaging.logo-nav-jilu-qiandao')
@if(session()->has('message'))
<div class="jilu main re f-cb" style="margin:8px auto;background-color: #FF00FF;">
  <div class="jilu_l">
    {{ session()->get('message') }}
  </div>
</div>
@endif
<section class="qd_today">
  <div class="qd_left">
    <div class="title">
      <span>{{ $title }}</span>
    </div>
    <div class="qd_rili">
      <ul>
        @foreach($date_arr as $value)
          @foreach($value as $v)
            @if($v)
              @if($v == $date['mday'])
                <li class="today">{{$v}}</li>
              @else
                <li>{{$v}}</li>
              @endif
            @else
              <li> </li>
            @endif
          @endforeach

        @endforeach
      </ul>
    </div>
  </div>

  <div class="qd_right">
    <ul>
      <li>您已连续签到：<em>{{ $qiandao['lianxu_days'] or 0 }}</em> 天</li>
      <li>本月您已签到：<em>{{ $qiandao['month_days'] or 0 }}</em> 天</li>
      <li>您总共已签到：<em>{{ $qiandao['alldays'] or 0 }}</em>天</li>
      <li>您最近一次签到时间：{{ $qiandao->last_date or "您还没有签到过"}}</li>
      @if(empty($qiandao))
      <li>新用户初次签到将获得<em>{{ $jifenNums }}</em> 积分</li>
      @else
      <li>您明天继续签到将获得<em>{{ $jifenNums }}</em> 积分</li>
      @endif
    </ul>
  </div>
  <div class="qd_check">
    @if(!$isqiandao)
    <input type="button" value="开始签到" onclick="javascript:{this.disabled=true;this.value='签到中...';document.location='{{ route('qiandao.update') }}';}" class="btn">
    @else
    <input type="button" value="已经签到" disabled="disabled" class="btn">
    @endif
  </div>
</section>

@endsection
