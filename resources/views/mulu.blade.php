@extends('layouts.default')
@section('title')小说目录列表@endsection
@section('keywords')小说目录列表@endsection
@section('description')小说目录列表@endsection

@section('content')
<scroll-mulu
  bid={{$bid}}
  from={{request()->url()}}
  ></scroll-mulu>
@endsection
