@extends('wapdashubao.layouts.default')
@section('content')

<scroll-mulu
  bid={{$bid}}
  url={{route('webajax.articles.getmulu')}}
  ></scroll-mulu>

@endsection
