<template>
<div>
  <a href="#footer" rel="nofollow">直达底部</a>
  <a v-on:click.stop="addbookcase(a,b)" rel="nofollow">加入书架</a>
  <a :href="d" target="_blank" rel="nofollow">错误举报</a>
  <a v-on:click.stop="openModel('voteAlert')" rel="nofollow">投推荐票</a>
  <sweet-modal title="提交推荐票" ref="voteAlert">
          <form id="tuijianForm">
              <ul class="tuijianwrapper">
                  <li>
                      <input type="radio" name="num" id="num" value="1" checked="checked">1张
                      <input type="radio" name="num" id="num" value="2">2张
                      <input type="radio" name="num" id="num" value="5">5张
                      <input type="radio" name="num" id="num" value="8">8张
                      <input type="radio" name="num" id="num" value="10">10张
                      <input type="radio" name="num" id="num" value="15">15张
                  </li>
              </ul>
          </form>
    <p slot="button"><vm-button type="primary" v-on:click="onSubmit" :disabled="isloading">{{ isloading ? '提交中' : '提交' }}</vm-button></p>

  </sweet-modal>
</div>
</template>

<script>

    import {SweetModal , SweetModalTab} from 'sweet-modal-vue';
    import { Button } from 'vue-multiple-button';
    import 'vue-multiple-button/lib/button.css'
    export default {
        props:['bid','cid','addbookcaseurl','newmessageurl','recommend'],
        data() {
            return {
              a: this.bid,
              b: this.cid,
              c: this.addbookcaseurl,
              d: this.newmessageurl,
              e: 0,
              f: 0,
              g: this.recommend,
              isloading: false,
            }
        },
        components: {
            SweetModal,
            SweetModalTab,
            'vm-button': Button
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
          openModel(ref) {
            if (this.$refs[ref]) {
              this.$refs[ref].open()
            } else {
              throw new Error('openModel Ref not defined: ' + ref)
            }
          },
          closeModel(ref) {
            if (this.$refs[ref]) {
              this.$refs[ref].close()
            } else {
              throw new Error('openModel Ref not defined: ' + ref)
            }
          },
          onSubmit(){
            this.closeModel('voteAlert');
            //var jsonData = $("form").serialize();
            var jsonData = $("#tuijianForm").serializeArray();
            //console.log(jsonData[0].value)
            var self = this;

            if(self.f > 0){
              self.msg('你是不是癫痫发作了,反复点',3500);
              return;
            }else{
                self.msg('请求中请稍等...',3500);
                self.f = 1;
                axios.post(self.g, {
                      bid: self.a,
                      num: jsonData[0].value,
                  })
                  .then(function (response) {
                    //console.log(response);
                    self.f = 0;
                    if(response.data.message){

                      self.msg(response.data.message);

                    }else{

                      self.msg('返回数据出错了');
                    }

                  })
                  .catch(function (response) {
                      self.f = 0;
                      console.log(response);
                      self.msg('网络故障稍后再试');
                  });

          }

        },
      }
    }
</script>
