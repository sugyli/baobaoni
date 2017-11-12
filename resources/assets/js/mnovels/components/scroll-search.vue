<template>
  <div class="top__bd" :style="'height:'+screen_height+'px;'">
    <div class="right-search">
      <a href="javascript:history.back()" class="top__back"></a>
      <div id="search-input" class="search-input"> <b class="search-input__mi"></b>
        <input type="text" v-model="searchKeyword" placeholder="输入书名/作者/关键字" @keyup.13="search">
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
                <a :href="item['link']">
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
                      <div class="i-cl-list-main-right-tags-tag">{{item['sort']}}</div>
                    </div>
                  </div>
                </a>
              </div>
            </li>
        </ul>
      </section>
      <div :class="{ishide:ishide}">
          <ul class="m-tag -color search-tag">
            <li v-for="(item, index) in storageSearchItems" class="u-tag">
            <a v-on:click.stop="tagclick(item)">{{item}}</a>
            </li>
          </ul>

          <div class="his-dele" v-if="isNotNullArray(storageSearchItems)">
            <a v-on:click.stop="delStorageSearchItems">
            <img src="/images/icon_search_del.png" style="width:.98rem;height:.92rem;display: inline-block;">清除记录
            </a>
          </div>
      </div>
    </scroller>
  </div>
</template>
<style>
.top__bd {
  position: relative;
  overflow: hidden;
}
.top__bd .search-tag {
    padding: 17px;
}
.top__bd .m-tag {
    line-height: 1;
    overflow: hidden;
}
.m-tag .u-tag {
    display: inline-block;
    width: auto;
    line-height: 1.8em;
    padding: 0 20px;
    color: #766d5d;
    border-radius: 4px;
    background: #909da8;
    font-size: 14px;
    text-align: center;
    border: 1px solid #d3d3d3;
    margin: 0 10px 5px 0;
}
.his-dele {
  width: 142px;
  height: 2.5rem;
  line-height: 2.5rem;
  color: rgb(0, 0, 0);
  text-align: center;
  font-family: 微软雅黑;
  box-sizing: border-box;
  display: block;
  background: rgb(255, 255, 255);
  border-width: 1px;
  border-style: solid;
  border-color: black;
  border-image: initial;
  margin: 1rem auto;
}
.right-search {
    height: 44px;
    background: #efeff0;
    border-bottom: 1px solid #ddd;
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    font: 15px/45px a;
    color: rgba(0,0,0,0.7);
    z-index: 999;
}
    .right-search .top__back {
      float: left;
      width: 42px;
      height: 44px;
    }
    .right-search .top__back:before {
        content: '';
        display: block;
        margin: 15px 0 0 16px;
        width: 10px;
        height: 16px;
        background: url(/images/back.png) no-repeat;
        background-size: 10px 16px;
    }
    .right-search .search-input {
        position: relative;
        margin: 5px 20px 5px 42px;
        height: 35px;
        box-shadow: 0 0 0 1px rgba(0, 0, 0, 0.08);
    }

    .right-search .search-input .search-input__mi {
        background: url(/images/PP13pEqhpChuay.png) no-repeat center;
        background-size: 16px 16px;
        position: absolute;
        left: 0;
        top: 0;
        width: 36px;
        height: 35px;
        border-right: 1px solid rgba(0, 0, 0, 0.1);
    }
    .right-search .search-input input {
        border: none;
        box-sizing: border-box;
        display: block;
        width: 100%;
        height: 100%;
        padding: 8px 52px 8px 42px;
        font-size: 14px;
        color: rgba(0, 0, 0, 0.8);
        background: #fff;

    }
    .right-search .search-input .search-input__btn {
        display: block;
        line-height: 36px;
        position: absolute;
        right: 0;
        top: 0;
        border-left: 1px solid #ddd;
        padding: 0 8px;
        font-size: 14px;
        color: #666;
    }
    .i-cl-list{
      padding: 0 13px;

    }
    .i-cl-list li{
      padding: 17px 0;
      border-bottom: 1px solid #f0f0f0;
    }
    .i-cl-list li:last-child {
        border: none;
    }
    .i-cl-list-main{
      overflow: hidden;
    }

    .i-cl-list-main-left{
      position: relative;
      float: left;
      width: 85px;
      height: 113px;
      background-color: #eeece9;/*书没加载出来有个背景色*/
      border: 1px solid #f0f0f0;
      border-radius: 1px;
      overflow: hidden;
    }
    .i-cl-list-main-left img {
        width: 100%;
        height: 100%;
        border-radius: 1px;
    }
    .i-cl-list-main-left-state{
      position: absolute;
      bottom: 0;
      width: 100%;
      box-sizing: border-box;/* border和padding计算入width之内*/
      font: 10px/10px a;
      padding: 25px 7px 6px;
      color: #fff;
      background: -webkit-linear-gradient(top,rgba(0,0,0,0),rgba(0,0,0,0.3));

    }
    .i-cl-list-main-right{
        margin-left: 100px;
        padding-top: 6px;
        background: #fff;
    }
    .i-cl-list-main-right-bookname{
      margin-bottom: 4px;
      font: 16px/17px a;
      color: rgba(0, 0, 0, 0.9);
      overflow: hidden;
      text-overflow: ellipsis;/*单行溢出文本显示省略号*/
      white-space: nowrap;/*规定段落中的文本不进行换行*/
    }
    .i-cl-list-main-right-author{
      margin-top: 8px;
      font: 12px/12px a;
      color: rgba(0, 0, 0, 0.7);
      overflow: hidden;
      text-overflow: ellipsis;
      white-space: nowrap;
    }
    .i-cl-list-main-right-info{
      margin: 8px 0 0;
      height: 2.8em;
      font: 12px/1.4em a;
      color: rgba(0, 0, 0, 0.6);
      overflow: hidden;
      text-overflow: ellipsis;
      /*下面3个控制多行*/
      display: -webkit-box;/*多行文字溢出*/
      -webkit-line-clamp: 2;/*多行文字几行*/
      -webkit-box-orient: vertical;/*溢出就用...*/
    }

    .i-cl-list-main-right-tags{
      margin-top: 10px;
      padding-top: 3px;
      overflow: hidden;
    }
    .i-cl-list-main-right-tags-tag{
      float: left;
      margin: -3px 7px 0 0;
      padding: 3px 6px 2px;
      font: 10px/11px a;
      color: #53ac7d;
      border-radius: 3px;
      border: 1px solid #53ac7d;
      overflow: hidden;
      text-overflow: ellipsis;
      white-space: nowrap;
      max-width: 6em;
    }
    .i-cl-list-main-right-tags-tag:last-child {
        margin-right: 0;
    }
    .m-tag.-color .u-tag:nth-child(3n+1) {
        background-color: #fbebe8;
    }
    .m-tag.-color .u-tag:nth-child(3n+2) {
        background-color: #fcedda;
    }
    .m-tag.-color .u-tag:nth-child(3n+3) {
        background-color: #e8f9db;
    }

</style>
<script>
  import Vue from 'vue'
  import VueScroller from 'vue-scroller'
  Vue.use(VueScroller)
  export default {
    //props:['searchinput'],
    data() {
      return {
        screen_height: Util.windowHeight,
        searchItems: [],
        searchKeyword: '',
        storageSearchItems: [],
        url: Config.searchurl +  '?page=',
        page: 0,
        noData: false,
        ishide: false,
        searchNoDataText: "没有更多数据",
        frist:0,
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
          this.storageSearchItems = this.getStorageSearchItems();
          if (!this.$refs.searchScroller) {
              return;
          }
          this.searchNoDataText = "没有相应的搜索结果";
          this.$refs.searchScroller.finishInfinite(true);

      },

      getStorageSearchItems(){
          var storageSearchItems = Util.StorageGetter('StorageSearchItems');
          var itme = [];
          if(storageSearchItems){
             itme =  storageSearchItems;

          }else{
             itme = [];
          }

          return itme;
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
        var storageSearchItems = this.getStorageSearchItems();
        storageSearchItems.splice(0, 0,keyword);
        storageSearchItems = storageSearchItems.unique3();
        //this.storageSearchItems.push(keyword)
        Util.StorageSetter('StorageSearchItems',storageSearchItems);

      },
      delStorageSearchItems(){
        Util.StorageDel('StorageSearchItems');
        this.storageSearchItems = [];
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
            this.searchNoDataText = "没有搜索到数据";
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
              this.setStorageSearchItems(keyword);
              this.$refs.searchScroller.finishInfinite(false);

          }

      },
      getData(){
          if(this.noData){
              return;
          }
          var self = this;
          var searchKeyword = self.getKeyWord();

          if(searchKeyword){
              self.page = self.page + 1;
              var url  = self.url + self.page;
              axios.post(url, {
                    query: searchKeyword,
                })
                .then(function (response) {
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
                    console.log(response);
                    self.noData = true;
                    self.searchNoDataText = "请求出现延迟请稍等";
                    self.$refs.searchScroller.finishInfinite(true);

                });

          }else{
              self.noData = true;
              self.searchNoDataText = "搜索词不能为空";
              self.$refs.searchScroller.finishInfinite(true);

          }

      },
      tagclick(v){
          this.searchKeyword = v;
          this.search();
      }

    }
  }
</script>
