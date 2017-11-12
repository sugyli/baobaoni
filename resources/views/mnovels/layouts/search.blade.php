@extends('mnovels.layouts.default')
@section('title')小说搜索@endsection
@section('keywords')小说搜索@endsection
@section('description')小说搜索@endsection
@section('content')
<scroll-search
></scroll-search>
<div style="padding-top:150px;text-align:center;" id="solist">
  <input type="button" style="font-size:20px" onclick="location.href= '/search'" value="被百度转码点击下切换">
</div>
@endsection
@section('subscripts')
<script>
$('#solist').hide();
</script>
@endsection
