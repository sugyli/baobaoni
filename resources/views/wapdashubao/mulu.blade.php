
@extends('wapdashubao.layouts.default')
@section('content')

<scroll-mulu
  bid={{$bid}}
  url={{route('webajax.articles.getmulu')}}
  from={{request()->url()}}
  ></scroll-mulu>

@endsection
