
(function () {
Vue.use(VueScroller)
new Vue({
      el:'#app',
      data:{
        screen_width:Util.windowWidth,
        screen_height:Util.windowHeight,
        searchItems: [],
        searchKeyword: '',
        storageSearchItems: [],
        url:  Config.searchurl  +  '?page=',
        page: 0,
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
              this.searchNoDataText = "第一次搜索有点慢,多确认几次,没有就是没有";
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
            if(this.jiazai){
              return;
            }
            var self = this;
            var searchKeyword = self.getKeyWord();

            if(searchKeyword){
                self.page = self.page + 1;
                var url  = self.url + self.page;
                self.jiazai =true;

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

                          self.noData = true;
                        }

                    }else{

                      self.noData = true;
                    }
                    self.jiazai =false;
                  })
                  .catch(function (response) {
                      self.jiazai =false;
                      console.log(response);
                      self.noData = true;
                      self.searchNoDataText = "请求出现延迟请再点一次搜索";
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
    });
})()//闭包不影响全局
