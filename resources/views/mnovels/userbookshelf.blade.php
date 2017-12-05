@extends('mnovels.layouts.default')
@section('title')我的书架@endsection
@section('keywords')我的书架@endsection
@section('description')我的书架@endsection
@section('style')
<style>
.shujia li {
    position: relative;
    padding: 0px 10px;
		border-bottom: 1px solid #eee;
}

.shujia li p {
	line-height: 32px;
	height: 32px;
	overflow: hidden;
	text-overflow: ellipsis;/*单行溢出文本显示省略号*/
	white-space: nowrap;/*规定段落中的文本不进行换行*/

}

.shujia .red-bg{
	color:red;
}
</style>
@endsection
@section('content')
<div class="shujia" id="reader" style="background: #fff; padding-bottom: 20px;">
  <div class="header online" style="text-align: center;">
      我的书架
      <a class="header-left" href="javascript:history.back()">
        <i class="iconfont icon-fanhui1"></i>
      </a>
  </div>
  <div id="root" class="container-warp">
    <ul class="Displayanimation" id="shujia">
    </ul>
  </div>
</div>
@endsection

@section('subscripts')
<script>
$(document).ready(function()
{
    showshujia("{{route('mnovels.clickbookshelf')}}" , "{{ $user->getBookcaseCount() }}");
});
</script>
@endsection
