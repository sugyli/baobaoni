@extends('mnovels.layouts.default')
@section('title'){{$sortname}}_{{config('app.wap_name')}}-{{config('app.url_wap')}}@endsection
@section('keywords'){{$sortname}}@endsection
@section('description'){{$sortname}}@endsection
@section('content')
<div class="header online" style="text-align: center;">
    {{$sortname}}
    <a class="header-left" href="javascript:history.back()">
      <i class="iconfont icon-fanhui1"></i>
    </a>
    <a class="header-right" href="/">
      <i class="iconfont icon-shouye1"></i>
    </a>
</div>
<div id="root" class="container-warp">
  @include('mnovels.layouts.search')
  @if ($bookDatas->count() > 0)
  <div class="cover">
    @foreach ($bookDatas as $bookData)
    <div class="block">
      <a href="{{$bookData->link}}">
          <div class="block_img">
            <img src="{{$bookData->imgflag}}" onerror="this.src='{{config('app.dfxsfmdir')}}'">
          </div>
          <div class="block_txt">
             <h2>{{$bookData->articlename}}</h2>

            <p>
              作者：{{$bookData->author}}
            </p>
            <p>
              更新：{{$bookData->updatetime}}
            </p>
            <p>
                {{$bookData->intro}}
            </p>
          </div>
       </a>
    </div>
    @endforeach
  </div>

   <div class="pagelink" style="display: none;">
      @if ($bookDatas->nextPageUrl())
      <a href="{{$bookDatas->nextPageUrl()}}">下一页</a>
      @endif
   </div>
   @include('mnovels.layouts.foot')
   @else
     <div style="padding:40px;text-align: center; font-size: 16px;">
      没有相关数据
     </div>
   @endif
</div>
@endsection

@section('subscripts')
<script src="/js/jquery.ias.min.js"></script>
<script>
var ias = $.ias({
    container: ".cover", //包含所有文章的元素
    item: ".block", //文章元素
    pagination: ".pagelink", //分页元素
    next: ".pagelink a",
});
ias.extension(new IASTriggerExtension({
    text: '<div style="padding: 10px;">点击加载更多</div>', //此选项为需要点击时的文字
  //  offset: 2, //设置此项后，到 offset-1 页之后需要手动点击才能加载，取消此项则一直为无限加载
}));
ias.extension(new IASSpinnerExtension());
ias.extension(new IASNoneLeftExtension({
    text: '<div style="padding: 10px;">加载完成！</div>', // 加载完成时的提示
}));

/*
ias.on('rendered', function(items) {
    $(".content img").lazyload({
        effect: "fadeIn",
        failure_limit : 10
    }); //这里是你调用Lazyload的代码
})
*/
</script>
@endsection
