<template>
<div class="mulu" :style="'height:'+screen_height+'px;background: #fff;'">
	<div class="header online" style="text-align: center;">
			{{bookname}}
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
				<a class="online" :href="item['link']" :class="{'red-bg': item['chapterid'] == cid}" >{{item['chaptername']}}</a><i></i>
			</li>
		</ul>
		</scroller>
</div>

</template>
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

<script type="text/ecmascript-6">
  //import BScroll from 'better-scroll'
  export default {
    props:['bid','from'],
    data() {
      return {
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

      }
    },
		computed: {

    },
    mounted() {
        var pageItem = Util.StorageGetter('muluobj_'+this.bid);

        if(pageItem){
           this.infinitePage = Number(pageItem.page) <= 0 ? 1 : pageItem.page;
           this.refreshPage =  Number(pageItem.page) <= 0 ? 1 : pageItem.page;
					 this.weizhi = pageItem.weizhi;
					 this.cid = pageItem.cid;
        }
    },
    methods: {
      refresh(done){
					this.refreshPage = Number(this.refreshPage) - 1;
					if(this.refreshPage <= 0){
						 this.refreshText = "已经是第一页了";
						 this.$refs.searchScroller.finishPullToRefresh();
						 return;
					}else{

						setTimeout(() => {
							this.getData(this.refreshPage , 1);
							done()
						}, 1500)

					}

      },
      infinite(done) {
				if(this.frist > 0){
					this.infinitePage = Number(this.infinitePage) + 1;
				}else{
					this.frist = 1;
				}
				if(!this.noData){
						setTimeout(() => {
							this.getData(this.infinitePage);
							if(this.isNotNullArray(this.items) && this.weizhi){
								var weizhi = this.weizhi;

								setTimeout(() => {
									this.$refs.searchScroller.scrollTo(0, weizhi , true);
								}, 500)

								this.weizhi = '';
							}
							done()
						}, 1500)

				}else{
						this.searchNoDataText = "没有搜索到数据了";
						this.$refs.searchScroller.finishInfinite(true);
				}
      },
			getData(page ,type=0){
					if(page <= 0 && type > 0){
							return;
					}
					if(this.noData && type ==  0){
							return;
					}

          var self = this;

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

									}else{
										for (var i = (datas.length-1); i >= 0; i--) {
												self.items.splice(0, 0, datas[i]);
										}

									}

              }else{
								if(type == 0){
									self.searchNoDataText = "没有数据了";
									self.$refs.searchScroller.finishInfinite(true);
									self.noData = true;

								}else{
									self.refreshText = "没有数据了";
									self.$refs.searchScroller.finishPullToRefresh();
								}

              }

            })
            .catch(function (response) {
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
  }
</script>
