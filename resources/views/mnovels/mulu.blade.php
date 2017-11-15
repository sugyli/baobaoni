@extends('mnovels.layouts.default')
@section('title')小说目录列表_{{config('app.wap_name')}}-{{config('app.url_wap')}}@endsection
@section('keywords')小说目录列表@endsection
@section('description')小说目录列表@endsection
@section('style')
<style>
.mulu li {
    position: relative;
    padding: 0px 10px;
}

.mulu li a {
    display: block;
    line-height: 40px;
    height: 40px;
    border-bottom: 1px solid #eee;
}

.mulu li i {
    position: absolute;
    top: 0px;
    right: 5px;
    width: 15px;
    height: 40px;
    background: center url(/images/list.png) no-repeat;
}

.mulu .red-bg{
	color:red;
}

</style>
@endsection
@section('content')
<div class="mulu" :style="'height:'+screen_height+'px;background: #fff;'">
	<div class="header online" style="text-align: center;">
			@{{bookname}}
			<a class="header-left" href="javascript:" onclick="javascript:history.go(-1);">
				<i class="iconfont icon-fanhui1"></i>
			</a>
			<a class="header-right" v-on:click.stop="delStorage()">
				<i class="iconfont icon-shuaxin1"></i>
			</a>
	</div>
	<scroller
		style="top: 45px"
		ref="searchScroller"
		:on-refresh="refresh"
		:on-infinite="infinite"
		:no-data-text="searchNoDataText"
		:refresh-text = "refreshText"
		>
		<ul class="Displayanimation">
			<li v-for="item in items">
				<a class="online" :href="item['link']" :class="{'red-bg': item['chapterid'] == cid}" >@{{item['chaptername']}}</a><i></i>
			</li>
		</ul>
		</scroller>
</div>
  <div style="padding-top:150px;text-align:center;" id="mululist">
    <input type="button" style="font-size:20px" onclick="location.href= '{{route('mnovels.mulu',['bid'=>$bid])}}'" value="被百度转码点击下切换">
  </div>
@endsection
@section('scripts')
<script src="/js/vue-scroller.min.js"></script>
<script>
(function () {
    $('#mululist').hide();
    Vue.use(VueScroller);
    Vue.use(Toast, {
        defaultType: 'center',
        duration: 2000,
        wordWrap: true,//换行
        width: 'auto'
    });
    new Vue({
          el:'#app',
          data:{
            screen_width:Util.windowWidth,
            screen_height:Util.windowHeight,
            bid: {{$bid}},
            from: '{{request()->url()}}',
            url: Config.muluurl,
            screen_height: Util.windowHeight,
            infinitePage: 1,
            refreshPage: 1,
            weizhi: '',
            searchNoDataText: "没有更多数据",
            noData: false,
            frist:0,
            items: [],
            refreshText: "下拉刷新",
            cid: 0,
            bookname: '',
            jiazai: false
          },
          mounted() {
              var pageItem = Util.StorageGetter('muluobj_'+this.bid);

              if(pageItem){
                 this.infinitePage = pageItem.page;
                 this.refreshPage =  pageItem.page;
      					 this.weizhi = pageItem.weizhi;
      					 this.cid = pageItem.cid;
              }
          },
          methods: {
            refresh(done){
      						if(this.refreshPage <= 0){
      							 this.refreshText = "没有上一页了";
      							 this.$refs.searchScroller.finishPullToRefresh();
      							 return;
      						}else{
      								setTimeout(() => {
      									this.getData(1);
      									done()
      								}, 1000)
      						}
            },
            infinite(done) {
      					if(!this.noData){
      							setTimeout(() => {
      								this.getData(0);
      								if(this.isNotNullArray(this.items) && this.weizhi){
      									var weizhi = this.weizhi;
      									setTimeout(() => {
      										this.$refs.searchScroller.scrollTo(0, weizhi , true);
      									}, 300)
      									this.weizhi = '';
      								}
      								done()
      							}, 1000)
      					}else{
      							this.searchNoDataText = "最后一页了";
      							this.$refs.searchScroller.finishInfinite(true);
      					}
            },
      			getData(type=0){
      					if(this.jiazai){
      						return;
      					}
      					if(this.noData && type ==  0){
      							return;
      					}

      					var page;
      					if(type ==  0 && this.frist > 0){
      							page = this.infinitePage = Number(this.infinitePage) + 1;
      					}
      					if(type ==  0 && this.frist == 0){
      							this.frist = 1;
      							page = this.infinitePage;
      					}
      					if(type > 0){
      						  page = this.refreshPage = Number(this.refreshPage) - 1;
      							if(page <= 0){
      									this.refreshText = "已经是第一页了";
      									this.$refs.searchScroller.finishPullToRefresh();
      									return;
      							}
      					}

                var self = this;
      					self.jiazai =true;
                axios.post(self.url, {
      							bid: self.bid,
      							page: page,
                  })
                  .then(function (response) {
                    if(response.data.error == 0){
      									if(!self.bookname){
      											self.bookname = response.data.bookName;
      									}
                        var datas = response.data.bakdata;
      									if(type == 0){
      										//上拉
      										for (var i = 0; i < datas.length; i++) {
      												self.items.push(datas[i]);
      										}
      										if(page >= response.data.lastpage){
      												self.noData = true;
      										}

      									}else{
      										for (var i = (datas.length-1); i >= 0; i--) {
      												self.items.splice(0, 0, datas[i]);
      										}

      									}
                    }else if(response.data.error == 3){
      									self.delStorage();
      							}else{
      								if(type == 0){
      									self.noData = true;

      								}else{
      									self.refreshText = "没有数据了";
      									self.$refs.searchScroller.finishPullToRefresh();
      								}

                    }
      							self.jiazai =false;
                  })
                  .catch(function (response) {
      								self.jiazai =false;
      								console.log(response);
      								//self.delStorage();
      								self.bookname = '有问题点击右边按钮刷新';
                      self.noData = true;
                      self.searchNoDataText = "请求出现故障,刷新下页面看看";
                      self.$refs.searchScroller.finishInfinite(true);

                  });

            },
      			delStorage(){
      				var key = 'muluobj_' + this.bid;
      				Util.StorageDel(key);
      				location.href = window.location.href;
      			},
      			isNotNullArray(t){
      				return (t.constructor==Array) && t.length > 0;
      			},
          },
    });
})()//闭包不影响全局
</script>
@endsection
