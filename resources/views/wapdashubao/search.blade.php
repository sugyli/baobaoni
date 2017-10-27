@extends('wapdashubao.layouts.default')
@section('title')小说搜索@endsection
@section('keywords')小说搜索@endsection
@section('description')小说搜索@endsection
@section('content')
<scroll-search
  searchinput={{route('web.searchinput')}}
></scroll-search>

@endsection
