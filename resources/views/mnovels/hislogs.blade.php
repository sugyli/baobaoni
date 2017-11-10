@extends('mnovels.layouts.default')
@section('title')阅读记录_{{config('app.wap_name')}}-{{config('app.url_wap')}}@endsection
@section('keywords')阅读记录@endsection
@section('description')阅读记录@endsection
@section('style')
<style>
.mulu li {
    position: relative;
    padding: 0px 10px;
}

.mulu li a {
    display: block;
    line-height: 40px;
    height: 40px;
    border-bottom: 1px solid #eee;
}

.mulu li i {
    position: absolute;
    top: 0px;
    right: 5px;
    width: 15px;
    height: 40px;
    background: center url(/images/list.png) no-repeat;
}
</style>
@endsection
@section('content')
<div class="header online" style="text-align: center;">
    阅读记录
    <a class="header-left" href="javascript:" onclick="javascript:history.go(-1);">
      <i class="iconfont icon-fanhui1"></i>
    </a>
</div>
<div v-bind:style="'width:'+ screen_width + 'px;'" class="container-warp" id="sotitle">
</div>
@endsection
@section('subscripts')
<script src="/js/jquery.cookie.js"></script>
<script>
var str = $.cookie("hislogs");
if (str !=null){
    var hislogs = JSON.parse(str);
    var lengths=hislogs.length;
    //翻转数组
    hislogs=$.map(hislogs,function(v,i){// map方法匿名函数传的值v是值、i是索引。
        return hislogs[lengths-1-i];
    });
    var html = '<ul class="Displayanimation mulu">';
    $.each(hislogs, function(i,val){
        html += '<li>';
        html += '<a class="online" href="'+ val.url + '">'+ val.bookName +'</a><i></i>';
        html += '</li>';
    });
    html += '</ul>';
    $("#sotitle").html(html);
}else{
    var html =  '<div style="text-align:center; padding:50px 0;">没有阅读记录</div>';
    $("#sotitle").html(html);

}
</script>
@endsection
