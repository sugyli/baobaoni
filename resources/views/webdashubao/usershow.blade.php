@extends('webdashubao.layouts.user')
@section('title')用户中心@endsection
@section('keywords')用户中心@endsection
@section('description')用户中心@endsection
@section('substyle')
.case_right .yonghu {
    background: url(/webdashubao/images/casebg.png);
}
.case_right .yonghu li {
    height: 32px;
    line-height: 32px;
    padding: 0 15px;
    color: #666;
    overflow: hidden;

}
.case_right .yonghu li:hover{border-bottom:#dee1e6 1px solid;background:#eff;height:31px}

.case_right .yonghu li span{
  float: left;
  padding-right: 10px;
  overflow: hidden;
  text-overflow: ellipsis;/*单行溢出文本显示省略号*/
  white-space: nowrap;/*规定段落中的文本不进行换行*/

}

.case_right .yonghu li span.a{
  width: 80px;

}
.case_right .yonghu li span.b{
  width: 150px;

}
.case_right .yonghu li span.c{
  width: 100px;

}
.case_right .yonghu li span.d{
  width: 100px;

}
.case_right .yonghu li span:last-child{

  margin-right: 0px;

}

#isme{
  color: #ff6600;
}
@endsection

@section('usercontent')
<div class="case_title">用户信息</div>
<user-avatar
  avatar="{{ $user->portrait }}"
  updateavatar={{ route('member.user.updateavatar') }}
  _token="{{ csrf_token() }}"
  >
</user-avatar>
<ul class="yonghu">
<li>通行证： {{ $user->uname }}</li>
<li>昵称： {{ $user->name }}</li>
<li>手机： {{ $user->mobile }} (找回密码需要)</li>
<li>经验： {{ $user->score }}</li>
<li>等级： {{ $user->caption }}</li>
<li>书架容量：{{ $user->getUserHonor()->getBookcaseCount() }} 本</li>
<li>日推荐票：{{ $user->getUserHonor()->getDayRecommendCount() }} 次</li>
<li>注册日期：{{ $user->regdate }}</li>

@if($allHonors && $allHonors->count()>0 )
  <li style="text-align: center;">等级划分</li>
  @foreach($allHonors as $allHonor)
    @if($allHonor->caption == $user->caption)
    <li id="isme">
      <span class="a">等级：{{ $allHonor->caption }}</span>
      <span class="b">经验：{{ $allHonor->minscore }} 到 {{ $allHonor->maxscore }}</span>
      <span class="c">日票数：{{ $allHonor->getDayRecommendCount() }}/天</span>
      <span class="d">书架量：{{ $allHonor->getBookcaseCount() }}/本</span>
      <span class="e">收(发)箱量：{{ $allHonor->getMassageMaxCount() }}/封</span>
    </li>
    @else
    <li>
      <span class="a">等级：{{ $allHonor->caption }}</span>
      <span class="b">经验：{{ $allHonor->minscore }} 到 {{ $allHonor->maxscore }}</span>
      <span class="c">日票数：{{ $allHonor->getDayRecommendCount() }}/天</span>
      <span class="d">书架量：{{ $allHonor->getBookcaseCount() }}/本</span>
      <span class="e">收(发)箱量：{{ $allHonor->getMassageMaxCount() }}/封</span>
    </li>
    @endif
  @endforeach
@endif
</ul>
@endsection
