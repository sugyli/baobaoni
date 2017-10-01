<!DOCTYPE html>
<html lang="zh">
@include('webdashubao.components.meta')
@yield('style')
<div id="app">
    @include('webdashubao.components.header')

    @yield('content')
    @include('webdashubao.components.footer')
  
</div>
@section('scripts')
<script src="{{ mix('/webdashubao/vue/app.js') }}"></script>
@show
@section('subscripts')

@show
</body>
</html>
