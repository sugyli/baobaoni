<template>
<form :action="a" method="post" name="checkform" class="Displayanimation" id="checkform">
  <div class="case_title">您的书架可收藏  {{ c }} 本，已收藏 {{ d }} 本。 如越界请清理才能继续添加</div>
  <input type="hidden" name="_token" :value="b">
  <ul style="min-height:300px;">
    <li class="top">
      <span class="fk">
        <input class="input" type="checkbox" id="checkall" name="checkall" value="checkall" />
      </span>
      <span class="wz">文章名称</span>
      <span class="zx">最新章节</span>
      <span class="zx">书签</span>
      <span class="gx">更新</span>
      <span class="cz">操作</span>
    </li>
    <div v-if="loading" class="loading"></div>
    <li v-for="item in items" >
      <span class="fk">
        <input class="input" type="checkbox" name="checkid[]" :value="item.caseid">
      </span>
      <span class="wz">
        <img src="/webdashubao/images/new.gif" v-if="item.relation_articles && item.relation_articles.lastupdate > item.lastvisit">

        <a v-if="item.relation_articles" :href="e +'/' + item.relation_articles.articleid" target="_blank" :title="item.relation_articles.articlename + '作者：' + item.relation_articles.author">{{item.relation_articles.articlename}}</a>

        <label v-else>{{ item.articlename }} <em style="color:red;">丢失</em></label>
      </span>

      <span class="zx">

        <a v-if="item.relation_articles && item.relation_articles.lastchapterid > 0" :href="e +'/' + item.relation_articles.articleid +'/'+ item.relation_articles.lastchapterid" target="_blank" :title="item.relation_articles.lastchapter">{{item.relation_articles.lastchapter}}</a>
        <label v-else>无最新章节</label>

      </span>

      <span class="zx">
        <a v-if="item.chapterid > 0" :href="e +'/' + item.articleid +'/'+ item.chapterid" target="_blank" :title="item.chaptername">{{item.chaptername}}</a>
        <label v-else>无书签</label>
      </span>


      <span class="gx">
        <label v-if="item.relation_articles">{{ get_Date(item.relation_articles.lastupdate) }}</label>
        <label v-else>无</label>
      </span>

      <span class="cz"><a v-on:click.stop="deljump(item.caseid)">移除</a>
      </span>
     </li>

     <li class="bottom" v-if="items.length > 0">
       <input id="bookcasebnt" type="button" value="批量删除" class="button" v-on:click.stop="delpiliang()">
     </li>
  </ul>
</form>
</template>

<script>
    import Toasted from 'vue-toasted';
    Vue.use(Toasted);
    export default {
        props:['getdataurl','destroyurl','token','bookcasecount','redurl'],
        data() {
            return {
              loading: true,
              items: [],
              a: this.destroyurl,//删除地址
              b: this.token,
              c: this.bookcasecount,
              d: "计算中...",
              e: this.redurl,

            }
        },
        //created 比 mounted早 钩子方法
        created(){
            var self = this;
            axios.post(self.getdataurl, {
              })
              .then(function (response) {
                //console.log(response);
                self.toggleShow();
                if(response.data.error == 0 ){
                  self.d = response.data.bakdata.length;
                  self.items = response.data.bakdata;
                }else{
                  self.d = 0;
                  self.msg('没有获取到您的收藏,可能您还没有收藏！');
                }
              })
              .catch(function (response) {
                  console.log(response);
                  self.toggleShow();
                  self.msg('网络故障,稍后刷新页面再试验！');
              });

        },
        computed: {

        },
        mounted() {

        },
        components: {

        },
        methods: {
            toggleShow: function() {
                this.loading = !this.loading;
            },
            get_Date: function(tm) {
                var d = new Date(tm * 1000);    //根据时间戳生成的时间对象
                var date = (d.getMonth() + 1) + "-" +
                           (d.getDate());
                return date;
            },
            msg: function (msg ,t = 3000) {
              this.$toasted.show(msg, {
                   theme: "bubble",
                   position: "top-center",
                   duration : t
                });
            },
            deljump: function (caseid) {
              if(confirm('确实要将本书移出书架么？')){
                  this.msg('正在删除,请稍后...');
                  document.location= this.a + "/" + caseid;

              }
            },
            delpiliang: function(){
                var flag = false;
                var bookshelfform = document.getElementById('checkform');
                for (var i=0;i< bookshelfform.elements.length;i++){
                  if (bookshelfform.elements[i].name != 'checkkall' && bookshelfform.elements[i].checked){
                      flag = true;
                   }
                }
                if(!flag) {
                  this.msg('请选择要删除的数据');
                  return false;
                }

                if(confirm('确实要将本书移出书架么？')){
                    document.getElementById('bookcasebnt').disabled=true;
                    document.getElementById('bookcasebnt').value='提交中...';
                    this.msg('正在批量删除,请稍后...');
                    //document.checkform.submit();
                    bookshelfform.submit();
                }

            }
        }
    }
</script>
