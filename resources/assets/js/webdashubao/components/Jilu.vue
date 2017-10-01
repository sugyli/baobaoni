<template>
  <div class="jilu_l" v-if="loading">您近期没有阅读，超级精彩的新内容等着您来阅读。</div>
  <div class="jilu_l" v-else>
    您上次已阅读到<a :href="a" target="_blank" class="sm">《{{c}}》</a>的 <a :href="b" target="_blank" class="zj"> {{d}}</a>!
  </div>
</template>

<script>
    export default {
        data() {
            return {
              loading: true,
              a:'',
              b:'',
              c:'',
              d:''
            }
        },
        components: {

        },
        //每次变化触发函数
        computed: {

        },
        //created 比 mounted早 钩子方法
        created(){
            var CI = document.cookie.match(new RegExp("(^| )BLR=([^;]*)(;|$)"));
            if(CI!=null)
            {
              CI = unescape(CI[2]);
              var LR = CI.split("#");
              //console.log(LR);
              if(LR[0]!=null && LR[1]!=null && LR[2]!=null && LR[3]!=null){
                this.a = LR[0];
                this.b = LR[1];
                this.c = LR[2];
                this.d = LR[3];
                this.toggleShow();
              }
            }

        },
        mounted() {

        },
        methods: {
          toggleShow: function() {
              this.loading = !this.loading;
          },

        },
    }
</script>
