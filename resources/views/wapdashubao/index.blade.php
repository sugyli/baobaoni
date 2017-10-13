@extends('wapdashubao.layouts.default')

@section('content')

@include('wapdashubao.include.header')
<div style="padding-top: 45px;" v-bind:style="'width:'+ screen_width + 'px;'">
  @include('wapdashubao.include.index-top')
</div>




@endsection
