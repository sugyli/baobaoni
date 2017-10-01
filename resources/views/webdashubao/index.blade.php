@extends('webdashubao.layouts.default')
@section('title'){{config('app.title_index')}}@endsection
@section('keywords'){{config('app.keywords_index')}}@endsection
@section('description'){{config('app.des_index')}}@endsection

@section('content')

@include('webdashubao.packaging.logo-nav-jilu-qiandao')



@include('webdashubao.components.fentui')


@include('webdashubao.components.tuijian-week')
@include('webdashubao.components.tuijian-month')

@include('webdashubao.components.update',['updateTitle' => '最新更新'])


@include('webdashubao.components.link')

@endsection
