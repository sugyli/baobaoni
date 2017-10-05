<template>
<div class="main .re">
    <div class="lf f-cb" v-if="show">
      <a :href="a" title="用户登录">用户登录</a> | <a :href="b" title="用户注册">用户注册</a>
    </div>
    <ul class="lf f-cb" v-else>
      <li><a :href="c" target='_top'>{{items.loginname}}</a></li>
      <li>等级：<span class="caption">{{items.caption}}</span></li>
      <li><a :href='d' target='_top'>我的书架</a></li>
      <li class="nav-link" v-if="items.adminemail > 0"><a :href='e' style="color:red;" target='_top'>查看短信</a><div class="nav-counter nav-counter-blue">{{items.adminemail}}</div></li>
      <li v-else><a :href='e' target='_top'>查看短信</a></li>
      <li><a :href="f" target='_self'>退出登录</a></li>
    </ul>
</div>
</template>

<script>
    export default {
        props:['getdataurl','loginurl','registerurl','memberurl','bookshelfurl','inboxurl','destroyurl'],
        data() {
            return {
              show: true,
              items: '',
              a: this.loginurl,
              b: this.registerurl,
              c: this.memberurl,
              d: this.bookshelfurl,
              e: this.inboxurl,
              f: this.destroyurl,
            }
        },
        //created 比 mounted早 钩子方法
        created(){
            var self = this;
            axios.post(self.getdataurl, {
              })
              .then(function (response) {
                //console.log(response);
                if(response.data.error == 0){
                  self.toggleShow();
                  self.items = response.data.bakdata;
                }
              })
              .catch(function (response) {
                  console.log(response);
              });

        },
        mounted() {

        },
        components: {

        },
        methods: {
            toggleShow: function() {
                this.show = !this.show;
            },
            jump: function(url) {
                var redirect_url = window.location.href;
                if(redirect_url.toLowerCase().indexOf(url)>= 0 || redirect_url.toLowerCase().indexOf('redirect_url=')>= 0){
                    document.location = url;
                }else{
                    document.location = url + "?redirect_url=" + redirect_url;

                }

            },
        }
    }
</script>
