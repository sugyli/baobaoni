window.jQuery = $;

(function($){

  var baobaoni = {
        initForm: function(){
          $(document).on('click', '[form-bnt]', function() {

            if ($(this).attr('form-bnt') == 'sub') {
                swal({
                    title: "",
                    text: "你确定要删除此内容吗？",
                    type: "warning",
                    showCancelButton: true,
                    cancelButtonText: "取消",
                    confirmButtonText: "删除"
                }).then(function(){
                  return true;
                }).catch(swal.noop);
            }




          });

        },
        getNav: function(){

            var url = Config.routes.getUser;
            //必须用GET因为有跨脚本验证
            $.get(url, function(html){
              if(html){
                $("#header").html(html);
              }
            });
            /*
            var header = new Vue({
                  el: '#header',
                  props:['registerUrl'],
                  data: {
                    html: '<a href="/getpass.php" title="忘记密码">忘记密码</a> | <a href="'+ this.registerUrl +'" title="用户注册">用户注册</a>'
                  },
                  computed: {
                    headHtml: function(){
                      return this.html;
                    }


                  },
                  methods: {

                  },
                  mounted:function(){
                    $.get(url, function(user){


                    },'json');
                  }
                })
                */



        },




  }


  window.baobaoni = baobaoni;

})(jQuery);


$(function() {

  baobaoni.getNav();
  baobaoni.initForm();
});
