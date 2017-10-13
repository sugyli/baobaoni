@extends('wapdashubao.layouts.default')

@section('content')

@include('wapdashubao.include.header')
<div style="padding-top: 45px;" class="container-warp" v-bind:style="'width:'+ screen_width + 'px;'">
  @include('wapdashubao.include.index-top')
  @include('wapdashubao.include.index-hot')
  @include('wapdashubao.include.index-weeklist')
  @include('wapdashubao.include.index-monthlist')
  @include('wapdashubao.include.index-update')
  @include('wapdashubao.include.foot')  
</div>




@endsection
