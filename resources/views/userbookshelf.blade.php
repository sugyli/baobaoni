
@extends('layouts.default')
@section('title')我的书架@endsection
@section('keywords')我的书架@endsection
@section('description')我的书架@endsection

@section('content')

<scroll-shujia
  redurl={{route('novel.bookshelf.clickbookshelf')}}
  bkurl={{$bkurl}}
  destroyurl="{{ route('novel.bookshelf.destroy') }}"
  bookcasecount = "{{ $user->getUserHonor()->getBookcaseCount() }}"
  ></scroll-shujia>

@endsection
