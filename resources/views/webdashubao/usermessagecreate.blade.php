@extends('webdashubao.layouts.user')
@section('title')发邮件@endsection
@section('keywords')发邮件@endsection
@section('description')发邮件@endsection
@section('substyle')
.case_right .msg_button {
    margin-left: 40px;
    line-height: 25px;
    padding: 0 5px;
    border: #dee1e6 1px solid;
    height: 25px;
    cursor: pointer;
    color: #000;
    background: #e6f5e2;
    margin-bottom: 10px;
}
.msg_foot{
  color: #666;
  overflow: hidden;
  text-align: center;
  background: #eff;
  height: 38px;
  line-height: 38px;
  font-weight: bold;
}
.msg_foot .button {
    margin-left: 5px;
    line-height: 25px;
    padding: 0 5px;
    border: #dee1e6 1px solid;
    height: 25px;
    cursor: pointer;
    color: #000;
    background: #e6f5e2;
}
.case_right .msg_arr {
  width:650px;
  margin:0 auto;
}
.case_right .msg_arr p{
  line-height: 20px;
  color: red;
  height: 20px;
  font-size: 14px;
  padding-top: 5px;
}
.case_right .title{
    margin:0 auto;
    text-align:center;
    padding-top: 10px;
}
.case_right .title input{
  height: 30px;
  line-height: 30px;
  border: #c3e0c3 1px solid;
  width:640px;
  padding-left:10px;

}
@endsection
@section('usercontent')
<div class="case_title">给管理员发消息</div>
<form name="frmnewmessage" action="{{ route('member.outboxs.store') }}" method="post">
  {{ csrf_field() }}
  <input type="hidden" name="from" value="{{ old($from) ?: $from }}">
  <textarea id="content" name="content" style="display:none"></textarea>
  @if( $errors->any())
    @foreach($errors->all() as $error)
      <div class="msg_arr">
        <p>
        {{ $error }}
        </p>
      </div>
    @endforeach
  @endif
  <div class="title online">
    <input type="text" name="title" value="{{ old($title) ?: $title }}">
  </div>

  <div id="editor" style="width:650px; margin:0 auto; padding:20px">
    {!! old('content') !!}
  </div>
  <div class="msg_foot">
    <input type="button" class="button" value="返 回" onClick="javascript:history.back(-1);"/>
    <input type="button" class="button" value="发 送" onClick="javascript:{document.getElementById('content').value = editor.txt.html();localforage.removeItem('editor_content');this.disabled=true;this.value='提交中...';document.frmnewmessage.submit();};"/>
  </div>
</form>
@endsection

@section('subscripts')
<script src="/js/localforage.min.js"></script>
<script type="text/javascript" src="/js/wangEditor.min.js"></script>
<script type="text/javascript">
var E = window.wangEditor;
var editor = new E('#editor');
// 或者 var editor = new E( document.getElementById('#editor') )
// 配置服务器端地址
editor.customConfig.uploadImgServer = '{{ route('member.user.imageupload') }}';
editor.customConfig.uploadImgParams = {

};
editor.customConfig.uploadFileName = 'imageFile';
// 将图片大小限制为 3M 默认限制图片大小是 5M
//editor.customConfig.uploadImgMaxSize = 3 * 1024 * 1024;
editor.customConfig.uploadImgHeaders = {
    'X-CSRF-TOKEN': "{{ csrf_token() }}",
}

//editor.customConfig.uploadImgShowBase64 = true   // 使用 base64 保存图片
editor.create();
$(function(){
  localforage.getItem('editor_content', function(err, value) {
    if (editor.txt.html() == '<p><br></p>' && !err) {
        editor.txt.html(value);
    };
  });

  $('#editor').keyup(function(){
    localforage.setItem('editor_content', editor.txt.html());
  });
});

/*
$("#message-create-form").submit(function(event){
    document.getElementById('content').value = editor.txt.html();
    localforage.removeItem('editor_content');
    $("#is-submit-bnt").attr("disabled",true);
    alert('r');
    return false;
  //  this.disabled=true;
    //this.value='提交中...';
  //onClick="javascript:{document.getElementById('content').value = editor.txt.html();localStorage.removeItem('editor_content');this.disabled=true;this.value='提交中...';document.frmnewmessage.submit();};"
});
*/
</script>
@endsection
