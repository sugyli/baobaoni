@extends('mnovels.layouts.default')
@section('title')小说目录列表_{{config('app.wap_name')}}-{{config('app.url_wap')}}@endsection
@section('keywords')小说目录列表@endsection
@section('description')小说目录列表@endsection

@section('content')
<scroll-mulu
  bid={{$bid}}
  from={{request()->url()}}
  ></scroll-mulu>
@endsection
