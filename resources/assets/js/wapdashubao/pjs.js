(function () {
  var Util = (function () {
      //本地存储 加prefix区别
      var prefix = 'html5_'
      var StorageGetter = function (key) {
          return localStorage.getItem(prefix + key);
      }
      var StorageSetter = function (key, val) {
          return localStorage.setItem(prefix + key, val)
      }
      var StorageDel = function (key) {
          localStorage.removeItem(prefix + key);
      }
      var windowWidth = $(window).width();
      if(windowWidth<320){
         windowWidth = 320;
      }
      var windowHeight =$(window).height();

      //暴露方法
      return {
          windowWidth: windowWidth,
          windowHeight: windowHeight,
          StorageGetter: StorageGetter,
          StorageSetter: StorageSetter,
          StorageDel: StorageDel,
      }
  })();
  var baobaoni = {
    init: function(){
        var self = this;
        self.vuefun();
    },
    vuefun:function(){
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

          var windowWidth = Util.windowWidth;
          //var offset = $($('.Swipe-tab').find('a')[0]).offset();
          //var index_header_tab_width = offset.width;
          var index_header_tab_width = $($('.Swipe-tab').find('a')[0]).width();
          new Vue({
          	  el:'#app',
          	  data :{
          	  	  screen_width:windowWidth,
                  double_screen_width:windowWidth*2,
                  screen_height:Util.windowHeight,
                  index_header_tab_width:index_header_tab_width,
                  header_duration:0,
                  header_position:0,
                  position:0,
                  tab_1_class:'Swipe-tab__on',
                  tab_2_class:'',
                  ishide: true,
                  searchItems: [],
                  isShowSearch: true,
                  storageSearchItems: [],
                  searchNoDataText: "没有更多数据",
                  searchKeyword: "",
          	  },
          	  methods:{
                getStorageSearchItems(){
                    var searchItems = Util.StorageGetter('StorageSearchItems');
                    if(searchItems){
                       this.storageSearchItems =  JSON.parse(searchItems);
                    }else{
                      this.storageSearchItems = [];
                    }
                },
                setStorageSearchItems(keyword){
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
                      //this.isShowSearch = true;
                      this.setStorageSearchItems(keyword);
                    //  this.infinite();
                    }

                },
                refresh (done) {
                  setTimeout(function () {
                    console.log("0000");
                    done();
                  }, 1500)

                },
                infinite (done) {

                  if (this.searchKeyword) {
                    axios.post('/searchinput', {
                          query: this.searchKeyword,
                      })
                      .then(function (response) {
                        console.log(response);


                      })
                      .catch(function (response) {
                          console.log(response);
                      });



                  }else{

                    this.isShowSearch = false;


                  }







                  if (keyword) {
                        axios.post('/searchinput', {
                              query: keyword,
                          })
                          .then(function (response) {
                            console.log(response);


                          })
                          .catch(function (response) {
                              self.e = 0;
                              console.log(response);
                          });
                  }
                //  this.$refs.searchScroller.finishInfinite(true);

                },
                tabSwitch:function(pos){
                  //this.duration = 0.5;
                  this.header_duration = 0.5;
                  if(pos == 0){
                    this.position = 0;
                    this.header_position = 0;
                    this.tab_1_class = "Swipe-tab__on";
                    this.tab_2_class = "";
                  }else if (pos == 1) {
                    this.position = (-windowWidth);
                    this.header_position = index_header_tab_width;
                    this.tab_2_class = "Swipe-tab__on";
                    this.tab_1_class = "";
                  }else if (pos == 2) {
                    this.ishide = false;
                    this.position = (-windowWidth);
                    this.getStorageSearchItems();
                  }else if (pos == 3) {
                    this.ishide = true;
                    this.position = 0;
                  }
                },



          	  }

          })

        },


  }

  window.baobaoni = baobaoni;
  baobaoni.init();
})()//闭包不影响全局
