@extends('wapdashubao.layouts.default')

@section('content')

@include('wapdashubao.include.header')
<div v-bind:style="'width:'+ double_screen_width +
                  'px;transition-duration:.5s;transform:translate3d('+
                  position + 'px,0px,0px);'">
  <div style="padding-top: 45px;" v-bind:style="'width:'+ screen_width + 'px;'">
    @include('wapdashubao.include.index-top')
  </div>
</div>



@endsection
