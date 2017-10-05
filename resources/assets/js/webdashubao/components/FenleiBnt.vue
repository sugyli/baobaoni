<template>
<span class="shujia">
  <a v-on:click.stop="addbookcase(a,b)">加入书架</a>
</span>
</template>

<script>
    export default {
        props:['bid','cid','addbookcaseurl'],
        data() {
            return {
              a: this.bid,
              b: this.cid,
              c: this.addbookcaseurl,
              e: 0,
            }
        },
        components: {
        },
        //每次变化触发函数
        computed: {

        },
        //created 比 mounted早 钩子方法
        created(){


        },
        mounted() {

        },
        methods: {
          msg: function (msg ,t = 3000) {
            this.$toasted.show(msg, {
                 theme: "bubble",
                 position: "top-center",
                 duration : t
              });
          },
          addbookcase(cid ,bid){
              var self = this;
              if(self.e > 0){
                self.msg('你是不是癫痫发作了,反复点',3500);
                return;
              }else{
                  self.msg('请求中请稍等...',3500);
                  self.e = 1;
                  axios.post(self.c, {
                        bid: self.a,
                        cid: self.b,
                    })
                    .then(function (response) {
                      //console.log(response);
                      self.e = 0;
                      if(response.data.message){

                        self.msg(response.data.message);

                      }else{

                        self.msg('返回数据出错了');
                      }

                    })
                    .catch(function (response) {
                        self.e = 0;
                        console.log(response);
                        self.msg('网络故障稍后再试');
                    });
              }

          },
      }
    }
</script>
