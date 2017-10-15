<template>
<div>
  <div class="right-search">
    <a  href="javascript:history.back()" class="top__back"></a>
    <div id="search-input" class="search-input"> <b class="search-input__mi"></b>
      <input type="text" v-model="searchKeyword" ref="search_box" placeholder="输入书名/作者/关键字">
      <div class="search-input__btn" v-on:click="search">搜索</div>
    </div>
  </div>
  <div class="top__bd" :style="'height:'+screen_height+'px;'">
      <scroller
        style="top: 45px"
        ref="searchScroller"
        :on-refresh="refresh"
        :on-infinite="infinite"
        :no-data-text="searchNoDataText"
        >

        <section class="i-cl" v-if="isArray(searchItems)">
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
        <div v-else>
            <ul class="m-tag -color search-tag">
              <li v-for="(item, index) in storageSearchItems" class="u-tag" id="Tag__128">@{{item}}</li>
            </ul>

            <div class="his-dele" v-if="isArray(storageSearchItems)">
              <a v-on:click.stop="delStorageSearchItems">
              <img src="/wapdashubao/images/icon_search_del.png" style="width:.98rem;height:.92rem;display: inline-block;">清除记录
              </a>
            </div>
        </div>
      </scroller>
  </div>
</div>
</template>

<script>

  export default {
    data() {
      return {
        screen_height: Util.windowHeight,
        storageSearchItems: [],
        searchItems: [],
        searchNoDataText: "没有更多数据",
        searchKeyword: "",
        url: '/searchinput',
      }
    },

    mounted() {

    },
    methods: {
      getStorageSearchItems(){
          var storageSearchItems = Util.StorageGetter('StorageSearchItems');
          if(storageSearchItems){
             this.storageSearchItems =  JSON.parse(storageSearchItems);
          }else{
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
      isArray(t){
        return (t.constructor==Array) && t.length > 0;
      },
      search:function() {
          var keyword =  this.getKeyWord();
          keyword = $.trim(keyword);
          if (keyword) {
              this.$refs.searchScroller.finishInfinite(false);
          }

      },
      getKeyWord(){

        return $.trim(this.searchKeyword);

      },
      refresh (done) {

          this.$refs.searchScroller.finishPullToRefresh();

          return;
      },
      infinite (done) {
          console.log("kaishi--");
          this.getData();
          done();
      },
      getData(){
          var self = this;
          var searchKeyword = self.getKeyWord();
          console.log(self.url);
          if(searchKeyword && self.url){

              axios.post(self.url, {
                    query: searchKeyword,
                })
                .then(function (response) {
                  console.log(response);
                  if(response.data.error == 0){
                      var data = response.data.bakdata.data;
                      for (var i = 0; i < data.length; i++) {
                          self.searchItems.push(data[i]);
                      }
                      if(response.data.bakdata.next_page_url){
                          console.log('0000000000000')
                          self.url = response.data.bakdata.next_page_url;
                      }else{
                          console.log('1111111111111111')
                          self.url = '';
                          self.searchNoDataText = "已经最后一页了";
                          self.$refs.searchScroller.finishInfinite(true);
                      }
                      console.log("jiesu--");
                      self.setStorageSearchItems(searchKeyword);
                      //self.$refs.searchScroller.resize();
                  }else{
                        console.log('2222222222222')
                      self.searchItems = [];
                      self.storageSearchItems = [];
                      self.searchNoDataText = "抱歉，没有找到相关内容";
                      self.$refs.searchScroller.finishInfinite(true);
                      //self.$refs.searchScroller.finishPullToRefresh();
                  }

                })
                .catch(function (response) {
                    console.log(response);
                    self.storageSearchItems = [];
                    self.searchItems = [];
                    //self.getStorageSearchItems();
                    self.searchNoDataText = "搜索出现了故障";
                    self.$refs.searchScroller.finishInfinite(true);
                    //self.$refs.searchScroller.finishPullToRefresh();

                });

          }else{

              self.searchItems = [];
              self.storageSearchItems = [];
              self.getStorageSearchItems();
              self.searchNoDataText = "没有相应的搜索结果";
              self.$refs.searchScroller.finishInfinite(true);

          }


      }




    }
  }
</script>
