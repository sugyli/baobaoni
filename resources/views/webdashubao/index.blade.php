@extends('webdashubao.layouts.default')

@section('title'){{get_sys_set('webname')}}-{{get_sys_set('weburi')}}@endsection
@section('keywords'){{get_sys_set('webkeywords')}}@endsection
@section('description'){{get_sys_set('webdes')}}@endsection

@section('content')

@include('webdashubao.packaging.logo-nav-jilu-qiandao')



@include('webdashubao.components.fentui')


@include('webdashubao.components.tuijian-week')
@include('webdashubao.components.tuijian-month')

@include('webdashubao.components.update',['updateTitle' => '最新更新'])


@include('webdashubao.components.link')

@endsection
