@extends('wapdashubao.layouts.default')

@section('content')

<test-view></test-view>



@endsection











{{--


  <div id="app" v-bind:style="{overflow:'hidden' , width:screen_width + 'px'}">
    @include('wapdashubao.include.header')
    <div class="tow-warp" v-bind:style="{
          width: double_screen_width + 'px',
          'transition-duration':'.5s',
          transform:'translate3d('+ position +'px,0px,0px)'
        }">

        <div class="container-warp"
            v-bind:style="{width: screen_width + 'px',float:'left'}">

              @include('wapdashubao.include.index-top')

              @include('wapdashubao.include.index-hot')

              @include('wapdashubao.include.index-clicklist')

              @include('wapdashubao.include.index-update')

              @include('wapdashubao.include.foot')
        </div>
  </div>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no" />
    <meta name="format-detection" content="telephone=no" />
    <meta name="applicable-device" content="mobile" />
    <meta http-equiv="Cache-Control" content="no-transform" />
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <link rel="stylesheet" type="text/css" href="/wapdashubao/css/reset.css">
		<link rel="stylesheet" type="text/css" href="/wapdashubao/css/index.css">
    <title>标题</title>
    <meta name="keywords" content="关键词" />
    <meta name="description" content="描述" />
  </head>
  <body>

    <style>
        .app{
          height: 100%;
          overflow: hidden;
          position: relative;
        }

        .container-scroll{
    			position: absolute;
    			top:45px;
    			bottom:0px;
    			left:0px;
    			right: 0px;
    			overflow-y:scroll;
    		}




    </style>



  </body>
  <script src="/wapdashubao/js/vue.js"></script>
  <script src="/wapdashubao/js/zepto.js"></script>
  <script src="/wapdashubao/js/index.js"></script>
</html>
--}}
