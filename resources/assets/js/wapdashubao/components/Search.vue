<template>
  <div class="top__bd" :style="'height:'+screen_height+'px;'" ref="scroll_wrapper">
    <div class="right-search">
      <a  href="javascript:history.back()" class="top__back"></a>
      <div id="search-input" class="search-input"> <b class="search-input__mi"></b>
        <input type="text" v-model="searchKeyword" ref="search_box" placeholder="输入书名/作者/关键字">
        <div class="search-input__btn" v-on:click="search">搜索</div>
      </div>
    </div>
    <scroller
      :style="ishide"
      :on-refresh="refresh"
      :on-infinite="infinite">
      <div v-for="(item, index) in searchItems">
        {{ item }}
      </div>
    </scroller>
    <div class="tag" :style="ishidetag">
      <ul class="m-tag -color search-tag">
        <li v-for="(item, index) in storageSearchItems" class="u-tag" id="Tag__128">{{item}}</li>
      </ul>
      <div class="his-dele" v-if="isNotNullArray(storageSearchItems)">
        <a v-on:click.stop="delStorageSearchItems">
        <img src="/wapdashubao/images/icon_search_del.png" style="width:.98rem;height:.92rem;display: inline-block;">清除记录
        </a>
      </div>
    </div>
  </div>
</template>
<style>
.top__bd .tag{
  padding-top: 45px;
}

</style>
<script>
  import Vue from 'vue'
  import VueScroller from 'vue-scroller'
  Vue.use(VueScroller)

  export default {
    data() {
      return {
        screen_height: Util.windowHeight,
        searchItems: [],
        searchKeyword: '',
        items: [],
        storageSearchItems: [],
        ishide: "display:none;",
        ishidetag: "",
        url:'/searchinput?page=',
        page: 1,
      }
    },
    computed: {
      // 计算属性的

    },
    mounted() {
      setTimeout(() => {
          this.getStorageSearchItems();
      }, 20)
    },

    methods: {
      getStorageSearchItems(){
          var storageSearchItems = Util.StorageGetter('StorageSearchItems');
          if(storageSearchItems){
             this.ishidetag = "";
             this.storageSearchItems =  JSON.parse(storageSearchItems);
          }else{
            this.ishidetag ="display:none;";
            this.storageSearchItems = [];
          }
      },
      setStorageSearchItems(keyword){
          Array.prototype.unique3 = function(){
            var res = [];
            var json = {};
            for(var i = 0; i < this.length; i++){
              if(!json[this[i]]){
                res.push(this[i]);
                json[this[i]] = 1;
              }
            }
            return res;
          }

        this.storageSearchItems.splice(0, 0,keyword);
        this.storageSearchItems = this.storageSearchItems.unique3();
        //this.storageSearchItems.push(keyword)
        Util.StorageSetter('StorageSearchItems',JSON.stringify(this.storageSearchItems));

      },
      delStorageSearchItems(){
        Util.StorageDel('StorageSearchItems');
        this.getStorageSearchItems();
      },
      refresh (done) {
        setTimeout(() => {
          var start = this.top - 1
          for (var i = start; i > start - 10; i--) {
            this.items.splice(0, 0, i + ' - keep walking, be 2 with you.')
          }
          this.top = this.top - 10
          done()
        }, 1500)
      },

      infinite (done) {

        if(this.isNotNullArray(this.searchItems)){


            setTimeout(() => {
              var start = this.bottom + 1
              for (var i = start; i < start + 3; i++) {
                this.items.push(i + ' - keep walking, be 2 with you.')
              }
              console.log('ff')
              this.bottom = this.bottom + 3
              done()
            }, 1500)




        }


      },
      isNotNullArray(t){
        return (t.constructor==Array) && t.length > 0;
      },
      getKeyWord(){
        return $.trim(this.searchKeyword);
      },
      search:function() {
          var keyword =  this.getKeyWord();
          keyword = $.trim(keyword);
          if (keyword) {
              this.ishide = "";
              this.getData();

          }

      },
      getData(){
          this.ishidetag ="display:none;";
          this.storageSearchItems = [];
          var self = this;
          var searchKeyword = self.getKeyWord();
          var url  = self.url + self.page;
          if(searchKeyword && url){
              axios.post(url, {
                    query: searchKeyword,
                })
                .then(function (response) {
                  console.log(response);
                  if(response.data.error == 0){
                      var data = response.data.bakdata.data;
                      for (var i = 0; i < data.length; i++) {
                          self.searchItems.push(data[i]);
                      }
                  }else{
                    self.searchNoDataText = "没有数据了";
                    self.$refs.searchScroller.finishInfinite(true);

                  }

                })
                .catch(function (response) {
                    self.searchNoDataText = "请求出现故障";
                    self.$refs.searchScroller.finishInfinite(true);

                });

          }else{
              self.searchNoDataText = "搜索词不能为空";
              self.$refs.searchScroller.finishInfinite(true);

          }
      }

    }
  }
</script>
