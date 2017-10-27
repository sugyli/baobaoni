@extends('wapdashubao.layouts.default')
@section('title'){{get_sys_set('wapname')}}-{{get_sys_set('wapuri')}}@endsection
@section('keywords'){{get_sys_set('wapkeywords')}}@endsection
@section('description'){{get_sys_set('wapdes')}}@endsection

@section('content')
<div class="header online HeaderTitlePosition">
    书城
    <a class="header-right" href="{{ route('web.login.create') }}">
      <i class="iconfont icon-huiyuan"></i>
    </a>
</div>
<div style="padding-top: 45px;" class="container-warp" v-bind:style="'width:'+ screen_width + 'px;'">
    @include('wapdashubao.include.index-top')
    @include('wapdashubao.include.index-hot')
    @include('wapdashubao.include.index-weeklist')
    @include('wapdashubao.include.index-monthlist')
    @include('wapdashubao.include.index-update')
    @include('wapdashubao.include.foot')
</div>
@endsection
