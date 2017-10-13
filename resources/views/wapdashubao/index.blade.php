@extends('wapdashubao.layouts.default')

@section('content')

@include('wapdashubao.include.header')

<div v-bind:style="'width:'+ double_screen_width +
                  'px;transition-duration:.5s;transform:translate3d('+
                  position + 'px,0px,0px);'">
  <div style="padding-top: 45px;" class="container-warp"
        v-bind:style="'width:'+ screen_width + 'px;float:left'">
          <div v-bind:class="{ ishide: !ishide}">
            @include('wapdashubao.include.index-top')
            @include('wapdashubao.include.index-hot')
            @include('wapdashubao.include.index-weeklist')
            @include('wapdashubao.include.index-monthlist')
            @include('wapdashubao.include.index-update')
          </div>
          @include('wapdashubao.include.foot')
  </div>
  <div class="container-warp" v-bind:style="'overflow: hidden;width:'+ screen_width +'px;float:left;'">
    {{--<div class="topbox" v-bind:class="{ ishide: ishide }">
      <a class="top__back" v-on:click.stop="tabSwitch(3)"></a>
      <span class="top__title">返回</span>
    </div>
    --}}
        <div class="right-search" v-bind:class="{ ishide: ishide}">
          <a v-on:click.stop="tabSwitch(3)" class="top__back"></a>
          <div id="search-input" class="search-input"> <b class="search-input__mi"></b>
            <input type="text" value="" ref="search_box" placeholder="输入书名/作者/关键字">
            <div class="search-input__btn" v-on:click="search">搜索</div>
          </div>
        </div>
        <div class="top__bd" :style="'height:'+(screen_height-45)+'px;'">
          <scroller
            v-if="isShowSearch"
            ref="searchScroller"
            :on-refresh="refresh"
            :on-infinite="infinite"
            :no-data-text="searchNoDataText"
            >

            <div v-for="(item, index) in searchItems" class="row" :class="{'grey-bg': index % 2 == 0}">
              @{{ item }}
            </div>



          </scroller>
            <div v-if="!isShowSearch">
              <ul class="m-tag -color search-tag" >
                <li v-for="(item, index) in storageSearchItems" class="u-tag" id="Tag__128">@{{item}}</li>
              </ul>
              <div  v-if="isArray(storageSearchItems)" class="his-dele">
                <a v-on:click.stop="delStorageSearchItems">
                <img src="/wapdashubao/images/icon_search_del.png" style="width:.98rem;height:.92rem;display: inline-block;">清除记录
                </a>
              </div>
          </div>
        </div>









{{--

    <div class="right-search">
			<div class="top">
        <a href="javascript:history.back()" class="top__back"></a>
				<div id="search-input" class="search-input"> <b class="search-input__mi"></b>
					<input type="text" value="" id="search_box" placeholder="输入书名/作者/关键字">
					<div class="search-input__btn">搜索</div>
				</div>
			</div>
		</div>
    <div class="top__bd">
										<div>
											<ul class="m-tag -color search-tag">
												<li class="u-tag" id="Tag__128">我的绝美女神老婆</li>
												<li class="u-tag" id="Tag__129">复仇千金</li>
												<li class="u-tag" id="Tag__130">盗墓</li>
												<li class="u-tag" id="Tag__131">豪门小老婆</li>
												<li class="u-tag" id="Tag__132">庶女</li>
												<li class="u-tag" id="Tag__133">神医</li>
												<li class="u-tag" id="Tag__134">魔兽</li>
												<li class="u-tag" id="Tag__135">我的老婆是双胞胎</li>
                        <li class="u-tag" id="Tag__128">我的绝美女神老婆</li>
                        <li class="u-tag" id="Tag__129">复仇千金</li>
                        <li class="u-tag" id="Tag__130">盗墓</li>
                        <li class="u-tag" id="Tag__131">豪门小老婆</li>
                        <li class="u-tag" id="Tag__132">庶女</li>
                        <li class="u-tag" id="Tag__133">神医</li>
                        <li class="u-tag" id="Tag__134">魔兽</li>
                        <li class="u-tag" id="Tag__135">我的老婆是双胞胎</li>
                        <li class="u-tag" id="Tag__128">我的绝美女神老婆</li>
                        <li class="u-tag" id="Tag__129">复仇千金</li>
                        <li class="u-tag" id="Tag__130">盗墓</li>
                        <li class="u-tag" id="Tag__131">豪门小老婆</li>
                        <li class="u-tag" id="Tag__132">庶女</li>
                        <li class="u-tag" id="Tag__133">神医</li>
                        <li class="u-tag" id="Tag__134">魔兽</li>
                        <li class="u-tag" id="Tag__135">我的老婆是双胞胎</li>
                        <li class="u-tag" id="Tag__128">我的绝美女神老婆</li>
                        <li class="u-tag" id="Tag__129">复仇千金</li>
                        <li class="u-tag" id="Tag__130">盗墓</li>
                        <li class="u-tag" id="Tag__131">豪门小老婆</li>
                        <li class="u-tag" id="Tag__132">庶女</li>
                        <li class="u-tag" id="Tag__133">神医</li>
                        <li class="u-tag" id="Tag__134">魔兽</li>
                        <li class="u-tag" id="Tag__135">我的老婆是双胞胎</li>
                        <li class="u-tag" id="Tag__128">我的绝美女神老婆</li>
                        <li class="u-tag" id="Tag__129">复仇千金</li>
                        <li class="u-tag" id="Tag__130">盗墓</li>
                        <li class="u-tag" id="Tag__131">豪门小老婆</li>
                        <li class="u-tag" id="Tag__132">庶女</li>
                        <li class="u-tag" id="Tag__133">神医</li>
                        <li class="u-tag" id="Tag__134">魔兽</li>
                        <li class="u-tag" id="Tag__135">我的老婆是双胞胎</li>
                        <li class="u-tag" id="Tag__128">我的绝美女神老婆</li>
                        <li class="u-tag" id="Tag__129">复仇千金</li>
                        <li class="u-tag" id="Tag__130">盗墓</li>
                        <li class="u-tag" id="Tag__131">豪门小老婆</li>
                        <li class="u-tag" id="Tag__132">庶女</li>
                        <li class="u-tag" id="Tag__133">神医</li>
                        <li class="u-tag" id="Tag__134">魔兽</li>
                        <li class="u-tag" id="Tag__135">我的老婆是双胞胎</li>
                        <li class="u-tag" id="Tag__128">我的绝美女神老婆</li>
                        <li class="u-tag" id="Tag__129">复仇千金</li>
                        <li class="u-tag" id="Tag__130">盗墓</li>
                        <li class="u-tag" id="Tag__131">豪门小老婆</li>
                        <li class="u-tag" id="Tag__132">庶女</li>
                        <li class="u-tag" id="Tag__133">神医</li>
                        <li class="u-tag" id="Tag__134">魔兽</li>
                        <li class="u-tag" id="Tag__135">我的老婆是双胞胎</li>

                        <li class="u-tag" id="Tag__128">我的绝美女神老婆</li>
                        <li class="u-tag" id="Tag__129">复仇千金</li>
                        <li class="u-tag" id="Tag__130">盗墓</li>
                        <li class="u-tag" id="Tag__131">豪门小老婆</li>
                        <li class="u-tag" id="Tag__132">庶女</li>
                        <li class="u-tag" id="Tag__133">神医</li>
                        <li class="u-tag" id="Tag__134">魔兽</li>
                        <li class="u-tag" id="Tag__135">我的老婆是双胞胎</li>
											</ul>
										</div>
									</div>
--}}

  </div>
</div>




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
