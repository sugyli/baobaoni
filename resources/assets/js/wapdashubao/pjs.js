(function () {

  var baobaoni = {
    init: function(){
        var self = this;
        self.vuefun();
    },
    vuefun:function(){

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

          	  },
          	  methods:{
                search:function() {

                    var keyword =  this.$refs.search_box.value;
                    keyword = $.trim(keyword);
                    if (keyword) {
                      console.log("kkk");
                      this.searchKeyword = keyword;
                      this.$refs.searchScroller.triggerPullToRefresh();
                      //this.isShowSearch = true;
                      //this.setStorageSearchItems(keyword);
                    //  this.infinite();
                    }

                },
                refresh (done) {
                  if (this.searchKeyword) {
                    console.log('dd');
                    axios.post('/searchinput', {
                          query: this.searchKeyword,
                      })
                      .then(function (response) {
                        console.log(response);


                      })
                      .catch(function (response) {
                          console.log(response);
                      });
                  }

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
                  }else{
                    this.position = (-windowWidth);
                    this.header_position = index_header_tab_width;
                    this.tab_2_class = "Swipe-tab__on";
                    this.tab_1_class = "";
                  }
                },



          	  }

          })

        },


  }

  window.baobaoni = baobaoni;
  baobaoni.init();
})()//闭包不影响全局
