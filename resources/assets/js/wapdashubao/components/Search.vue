<template>
<div>
  <div class="right-search">
    <a  href="javascript:history.back()" class="top__back"></a>
    <div id="search-input" class="search-input"> <b class="search-input__mi"></b>
      <input type="text" value="" ref="search_box" placeholder="输入书名/作者/关键字">
      <div class="search-input__btn" v-on:click="search">搜索</div>
    </div>
  </div>
  <div class="top__bd" :style="'height:'+(screen_height-45)+'px;'">
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

          var keyword =  this.$refs.search_box.value;
          keyword = $.trim(keyword);
          if (keyword) {
            this.searchKeyword = keyword;
            this.$refs.searchScroller.finishInfinite(false);
          }

      },
      refresh (done) {
      console.log('fff');
      this.$refs.searchScroller.finishInfinite(false);
      },
      infinite (done) {
        if(this.searchKeyword){
            var self = this;
            axios.post('/searchinput', {
                  query: this.searchKeyword,
              })
              .then(function (response) {
                console.log(response);

                if(response.data.error == 0){
                    self.searchItems = response.data.bakdata.data;



                }



              })
              .catch(function (response) {
                  console.log(response);
              });



        }else{
            this.getStorageSearchItems();
            this.searchNoDataText = "没有相应的搜索结果";
            this.$refs.searchScroller.finishInfinite(true);

        }




      }
    }
  }
</script>
