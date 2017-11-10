
@extends('mnovels.layouts.default')
@section('title')我的书架@endsection
@section('keywords')我的书架@endsection
@section('description')我的书架@endsection

@section('content')

<scroll-shujia
  redurl={{route('mnovels.clickbookshelf')}}
  destroyurl="{{ route('ajax.destroy') }}"
  bookcasecount = "{{ $user->getBookcaseCount() }}"
  from={{request()->url()}}
  ></scroll-shujia>

@endsection
