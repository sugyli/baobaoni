<template>
  <div class="top__bd" :style="'height:'+screen_height+'px;'">
    <div class="right-search">
      <a  href="javascript:history.back()" class="top__back"></a>
      <div id="search-input" class="search-input"> <b class="search-input__mi"></b>
        <input type="text" v-model="searchKeyword" ref="search_box" placeholder="输入书名/作者/关键字">
        <div class="search-input__btn" v-on:click="search">搜索</div>
      </div>
    </div>
    <scroller
      style="top: 45px"
      ref="searchScroller"
      :on-refresh="refresh"
      :on-infinite="infinite"
      :no-data-text="searchNoDataText"
      >
      <section class="i-cl" v-if="isNotNullArray(searchItems)">
        <ul class="i-cl-list Displayanimation">
            <li v-for="(item, index) in searchItems">
              <div class="i-cl-list-main">
                <a href="/">
                  <div class="i-cl-list-main-left">
                    <img :src="item['imgflag']"/>
                    <p class="i-cl-list-main-left-state">
                      {{item['fullflag']}}
                    </p>
                  </div>
                  <div class="i-cl-list-main-right">
                    <p class="i-cl-list-main-right-bookname">
                      {{item['articlename']}}
                    </p>

                    <p class="i-cl-list-main-right-author">
                        {{item['author']}}
                    </p>

                    <p class="i-cl-list-main-right-info">
                      {{item['intro']}}
                    </p>
                    <div class="i-cl-list-main-right-tags">
                      <div class="i-cl-list-main-right-tags-tag">{{item['articlefenlei']}}</div>
                    </div>
                  </div>
                </a>
              </div>
            </li>
        </ul>
      </section>
      <div :class="{ishide:ishide}">
          <ul class="m-tag -color search-tag">
            <li v-for="(item, index) in storageSearchItems" class="u-tag" id="Tag__128">{{item}}</li>
          </ul>

          <div class="his-dele" v-if="isNotNullArray(storageSearchItems)">
            <a v-on:click.stop="delStorageSearchItems">
            <img src="/wapdashubao/images/icon_search_del.png" style="width:.98rem;height:.92rem;display: inline-block;">清除记录
            </a>
          </div>
      </div>
    </scroller>
  </div>
</template>
<style>

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
        url:'/searchinput?page=',
        page: 0,
        noData: false,
        ishide: false,
        searchNoDataText: "没有更多数据",
        frist:0
      }
    },
    computed: {
      // 计算属性的

    },
    mounted() {
      setTimeout(() => {
          this._initScroll();
      }, 20)
    },

    methods: {
      _initScroll() {
          this.getStorageSearchItems();
          if (!this.$refs.searchScroller) {
              return;
          }
          this.searchNoDataText = "没有相应的搜索结果";
          this.$refs.searchScroller.finishInfinite(true);

      },

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
        this.$refs.searchScroller.finishPullToRefresh();

        return;
      },

      infinite (done) {

        if(this.frist <=0){
          return;
        }
        if(this.frist > 0 && !this.noData){
            setTimeout(() => {
              this.getData();
              done()
            }, 1500)

        }else{
            this.searchNoDataText = "没有数据了";
            this.$refs.searchScroller.finishInfinite(true);

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
              this.frist = 1;
              this.page = 0;
              this.noData = false;
              this.storageSearchItems = [];
              this.searchItems = [];
              this.ishide = true;
              this.setStorageSearchItems(searchKeyword);
              this.$refs.searchScroller.finishInfinite(false);

          }

      },
      getData(){

          var self = this;
          var searchKeyword = self.getKeyWord();
          self.page = self.page + 1;
          var url  = self.url + self.page;
          if(searchKeyword){
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
                      if(Number(response.data.bakdata.last_page) <= self.page){
                        self.searchNoDataText = "没有数据了";
                        self.$refs.searchScroller.finishInfinite(true);
                        self.noData = true;
                      }

                  }else{
                    self.searchNoDataText = "没有数据了";
                    self.$refs.searchScroller.finishInfinite(true);
                    self.noData = true;
                  }

                })
                .catch(function (response) {
                    self.noData = true;
                    self.searchNoDataText = "请求出现故障";
                    self.$refs.searchScroller.finishInfinite(true);

                });

          }else{
              self.noData = true;
              self.searchNoDataText = "搜索词不能为空";
              self.$refs.searchScroller.finishInfinite(true);

          }
      }

    }
  }
</script>
