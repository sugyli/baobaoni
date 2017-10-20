<template>
<div>
  <div class="shuqian">
    <a v-on:click.stop="addbookcase" rel="nofollow">添加书签</a>
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
      <p slot="button"><vm-button type="primary" v-on:click="onSubmit" :disabled="isloading" id="subBnt">{{ isloading ? '提交中' : '提交' }}</vm-button></p>

    </sweet-modal>

  </div>

  <div class="bgs">
    <ul>
      <li>
        <input type="text" class="textm" id="screen" value="滚屏">
        <input type="hidden" class="textm" id="screen2" value="滚屏">
        <span class="btn" id="screen1"></span>
      </li>

      <li class="select" style="display: none;">
        <p>0</p>
        <p>1慢</p>
        <p>2</p>
        <p>3</p>
        <p>4</p>
      </li>
    </ul>
  <ul>
    <li>
      <input type="text" class="textm" id="background" value="背景">
      <input type="hidden" id="background2" value="#000">
      <span class="btn" id="background1"></span>
    </li>

    <li class="select" style="display: none;">
      <p class="bg_huang">明黄</p>
      <p class="bg_lan">淡蓝</p>
      <p class="bg_lv">淡绿</p>
      <p class="bg_fen">红粉</p>
      <p class="bg_bai">白色</p>
      <p class="bg_hui">灰色</p>
      <p class="bg_hei">漆黑</p>
      <p class="bg_cao">草绿</p>
      <p class="bg_cha">茶色</p>
      <p class="bg_yin">银色</p>
      <p class="bg_mi">米色</p>
    </li>
  </ul>

  <ul>
    <li>
      <input type="text" class="textm" id="fontSize" value="字号">
      <input type="hidden" id="fontSize2" value="16px">
      <span class="btn" id="fontSize1"></span>
    </li>

    <li class="select" style="display: none;">
      <p class="fon_12">12px</p>
      <p class="fon_14">14px</p>
      <p class="fon_16">16px</p>
      <p class="fon_18">18px</p>
      <p class="fon_20">20px</p>
      <p class="fon_24">24px</p>
      <p class="fon_30">30px</p>
    </li>
  </ul>

  <ul>
    <li>
      <input type="text" class="textm" id="fontColor" value="字色">
      <input type="hidden" id="fontColor2" value="z_mo">
      <span class="btn" id="fontColor1"></span>
    </li>

    <li class="select" style="display: none;">
      <p class="z_hei">黑色</p>
      <p class="z_red">红色</p>
      <p class="z_lan">蓝色</p>
      <p class="z_lv">绿色</p>
      <p class="z_hui">灰色</p>
      <p class="z_li">栗色</p>
      <p class="z_wu">雾白</p>
      <p class="z_zi">暗紫</p>
      <p class="z_he">玫褐</p>
    </li>
  </ul>

  <ul>
    <li>
      <input type="text" class="textm" id="fontFamily" value="字体">
      <input type="hidden" id="fontFamily2" value="fam_song">
      <span class="btn" id="fontFamily1"></span>
    </li>

    <li class="select">
      <p class="fam_song">宋体</p>
      <p class="fam_hei">黑体</p>
      <p class="fam_kai">楷体</p>
      <p class="fam_qi">启体</p>
      <p class="fam_ya">雅黑</p>
    </li>
  </ul>

    <input type="button" class="ud_but2" onmousemove="this.className='ud_but22'" onmouseout="this.className='ud_but2'" value="保存" id="saveButton">
    <input type="button" class="ud_but1" onmousemove="this.className='ud_but11'" onmouseout="this.className='ud_but1'" value="恢复" id="recoveryButton">
  </div>
</div>
</template>

<script>

    import {SweetModal , SweetModalTab} from 'sweet-modal-vue';
    import { Button } from 'vue-multiple-button';
    import 'vue-multiple-button/lib/button.css';
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
          addbookcase(){
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
            //var jsonData = $("#tuijianForm").serialize();
            var jsonData = $("#tuijianForm").serializeArray();
            console.log(jsonData)
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
