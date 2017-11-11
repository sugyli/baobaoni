@extends('mnovels.layouts.default')
@section('title')小说目录列表_{{config('app.wap_name')}}-{{config('app.url_wap')}}@endsection
@section('keywords')小说目录列表@endsection
@section('description')小说目录列表@endsection
@section('content')
<scroll-mulu
  bid={{$bid}}
  from={{request()->url()}}
  ></scroll-mulu>
  <div style="padding-top:150px;text-align:center;" id="mululist">
    <input type="button" style="font-size:20px" onclick="location.href= '{{route('mnovels.mulu',['bid'=>$bid])}}'" value="被百度转码点击下切换">
  </div>
@endsection
@section('subscripts')
<script>
$('#mululist').hide();
</script>
@endsection
