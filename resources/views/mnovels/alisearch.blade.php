@extends('mnovels.layouts.default')
@section('title')小说搜索@endsection
@section('keywords')小说搜索@endsection
@section('description')小说搜索@endsection
@section('style')
<link rel="stylesheet" type="text/css" href="/newcss/zujian.css" />
@endsection
@section('content')
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
              <a :href="item['fields']['link']">
                <div class="i-cl-list-main-left">
                  <img  :src="item['fields']['image']"/>

                </div>
                <div class="i-cl-list-main-right">
                  <p class="i-cl-list-main-right-bookname">
                    @{{item['fields']['title']}}
                  </p>

                  <p class="i-cl-list-main-right-author">
                      @{{item['fields']['author']}}
                  </p>
                </div>
              </a>
            </div>
          </li>
      </ul>
    </section>
    <div :class="{ishide:ishide}">
        <ul class="m-tag -color search-tag">
          <li v-for="(item, index) in storageSearchItems" class="u-tag">
          <a v-on:click.stop="tagclick(item)">@{{item}}</a>
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
@endsection
@section('scripts')
<script src="/js/vue-scroller.min.js"></script>
<script>

(function () {
var imagepath =
Vue.use(VueScroller)
new Vue({
      el:'#app',
      data:{
        screen_width:Util.windowWidth,
        screen_height:Util.windowHeight,
        searchItems: [],
        searchKeyword: '',
        storageSearchItems: [],
        url:  Config.alisearchurl,
        imagepath:'{{config('app.xsfmdir')}}',
        defimage: '{{config('app.dfxsfmdir')}}',
        noData: false,
        ishide: false,
        searchNoDataText: "没有更多数据",
        frist:0,
        jiazai: false
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
              }, 500)

          }else{
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
            if(this.jiazai){
              return;
            }
            var self = this;
            var searchKeyword = self.getKeyWord();

            if(searchKeyword){
                self.jiazai =true;
                axios.post(self.url, {
                      query: searchKeyword,
                  })
                  .then(function (response) {
                    if(response.data.error == 0){
                        var data = response.data.bakdata;

                        for (var i = 0; i < data.length; i++) {
                            if(data[i]['fields']['price'] == 'nopic'){
                                data[i]['fields']['image'] = self.defimage;

                             }else{
                                data[i]['fields']['image'] = self.imagepath + data[i]['fields']['price'];
                             }
                            //data[i]['fields']['update'] = self.DateToUnix(data[i]['fields']['create_timestamp']);
                            data[i]['fields']['link'] = '/info-' + data[i]['fields']['bookid'];
                            self.searchItems.push(data[i]);
                        }

                    }else{
                      self.searchNoDataText = "没有查询到数据";
                    }
                    self.noData = true;
                    self.jiazai =false;
                    self.$refs.searchScroller.finishInfinite(true);
                  })
                  .catch(function (response) {
                      self.jiazai =false;
                      console.log(response);
                      self.noData = true;
                      self.searchNoDataText = "请求出现故障稍后再试";
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
        },
      }
    });
})()//闭包不影响全局

</script>
@endsection
