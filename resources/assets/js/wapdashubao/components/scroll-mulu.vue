<template>
<div class="mulu__bd" :style="'height:'+screen_height+'px;background: #fff;'">
	<div class="mulu_header">
		<a class="top__back" href="/"></a>
		<span class="top__title online">标题</span>
		<a class="mulu-header-right iconfont" href="/">&#xe73d;</a>
	</div>

	<scroller
		style="top: 45px"
		ref="searchScroller"
		:on-refresh="refresh"
		:on-infinite="infinite"
		:no-data-text="searchNoDataText"
		:refresh-text = "refreshText"
		>
		<ul class="list-content list-content-hook Displayanimation">
			<li v-for="item in items">
				<a class="online" :href="item['chapterlink']">{{item['chaptername']}}</a><i></i>
			</li>
		</ul>
		</scroller>
</div>
</template>
<style>
.mulu__bd{
	position: relative;
	overflow: hidden;
}
</style>

<script type="text/ecmascript-6">
  import BScroll from 'better-scroll'
  export default {
    props:['bid','url'],
    data() {
      return {
				screen_height: Util.windowHeight,
				infinitePage: 1,
				refreshPage: 1,
				weizhi: '',
				searchNoDataText: "没有更多数据",
				noData: false,
				frist:0,
				items: [],
				refreshText: "下拉刷新",

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
								this.$refs.searchScroller.scrollTo(0, this.weizhi , true);
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
					console.log(page);
					if(page <= 0 && type > 0){
							console.log('1111');
							return;
					}
					if(this.noData && type ==  0){
							console.log('122222');
							return;
					}
					console.log('21');
          var self = this;
					console.log(self.url)
          axios.post(self.url, {
							bid: self.bid,
							page: page,
            })
            .then(function (response) {

              if(response.data.error == 0){
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
                self.noData = true;
                self.searchNoDataText = "请求出现故障";
                self.$refs.searchScroller.finishInfinite(true);

            });

      },
			isNotNullArray(t){
				return (t.constructor==Array) && t.length > 0;
			},

    },
  }
</script>
