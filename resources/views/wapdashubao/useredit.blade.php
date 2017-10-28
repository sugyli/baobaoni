@extends('wapdashubao.layouts.default')
@section('title')编辑资料@endsection
@section('keywords')编辑资料@endsection
@section('description')编辑资料@endsection

@section('content')
<div class="header online HeaderTitlePosition">
    编辑资料
    <a href="{{$bkurl}}" class="header-left">
      <i class="iconfont icon-fanhui1"></i>
    </a>
</div>
<div style="padding-top: 45px;" class="container-warp" v-bind:style="'width:'+ screen_width + 'px;'">

  <form name="formtable" action="{{ route('member.user.show') }}" method="post" id="useredit">
      {{ csrf_field() }}
      <div class="login">
        <p>修改昵称：<input name="name" value="{{ old('name') ?: $user->name }}" autocomplete="off" onkeypress="javascript: if (event.keyCode==32) return false;" type="text" class="login_name"></p>
        {!! $errors->first('name', '<p style="color:red;"> :message</p>') !!}
        <p>修改手机：<input name="mobile" value="{{ old('mobile') ?: $user->mobile }}" autocomplete="off" onkeypress="javascript: if (event.keyCode==32) return false;" type="text" class="login_name"></p>
        {!! $errors->first('mobile', '<p style="color:red;"> :message</p>') !!}
        <input type="submit" class="login_btn" onclick="javascript:{this.disabled=true;this.value='提交中...';document.getElementById('useredit').submit();}" value="保 存">
      </div>
    </form>

</div>
@endsection
