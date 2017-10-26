@extends('wapdashubao.layouts.default')
@section('title'){{get_sys_set('wapname')}}-{{get_sys_set('wapuri')}}@endsection
@section('keywords'){{get_sys_set('wapkeywords')}}@endsection
@section('description'){{get_sys_set('wapdes')}}@endsection

@section('content')

<mheader
  left_icon = ''
  left_href = ''
  right_icon = 'icon-huiyuan'
  right_href ='{{ route('web.login.create') }}'
  title = '书城'
  title_position = 'HeaderTitlePosition'
></mheader>
<div style="padding-top: 45px;" class="container-warp" v-bind:style="'width:'+ screen_width + 'px;'">
    @include('wapdashubao.include.index-top')
    @include('wapdashubao.include.index-hot')
    @include('wapdashubao.include.index-weeklist')
    @include('wapdashubao.include.index-monthlist')
    @include('wapdashubao.include.index-update')
    @include('wapdashubao.include.foot')
</div>

{{--
<div style="padding-top: 45px;" class="container-warp" v-bind:style="'width:'+ screen_width + 'px;'">




  @include('wapdashubao.include.index-update')
  @include('wapdashubao.include.foot')
</div>
--}}



@endsection
