@section('style')
<style>
.mulu_header {
    top: 0;
    height: 44px;
    background: #efeff0;
    border-bottom: 1px solid #ddd;
    font: 15px/45px a;
    color: rgba(0,0,0,0.7);
    position: fixed;
    z-index: 999;
    left: 0;
    display: flex;
    width: 100%;
}
.mulu_header .top__title{
  flex: 1;
  line-height: 44px;
  text-align: center;
}
.mulu-header-right {
    float: right;
    height: 44px;
    width: 42px;
    text-align: center;
    font-size: 22px;

}

.list-wrapper {
    position: fixed;
    z-index: 1;
    top: 44px;
    bottom: 50px;
    left: 0;
    width: 100%;
    background: #fff;
    overflow: hidden;
}
.top-tip {
    position: absolute;
    top: -40px;
    left: 0;
    bottom: 50px;
    z-index: 1;
    width: 100%;
    height: 40px;
    line-height: 40px;
    text-align: center;
    color: #555;
}

.mulu__bd li {
    position: relative;
    padding: 0px 10px;
}

.mulu__bd li a {
    display: block;
    line-height: 40px;
    height: 40px;
    border-bottom: 1px solid #eee;
}


.mulu__bd li i {
    position: absolute;
    top: 0px;
    right: 5px;
    width: 15px;
    height: 40px;
    background: center url(/wapdashubao/images/list.png) no-repeat;
}

</style>
@endsection
@extends('wapdashubao.layouts.default')
@section('content')

<scroll-mulu
  bid={{$bid}}
  url={{route('webajax.articles.getmulu')}}
  ></scroll-mulu>

@endsection
