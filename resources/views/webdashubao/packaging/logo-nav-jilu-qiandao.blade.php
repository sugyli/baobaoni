@include('webdashubao.components.logo')
@include('webdashubao.components.nav')
@include('webdashubao.components.jilu')
@if(!Request::is('member/qiandao'))
@include('webdashubao.components.qiandao')
@endif
