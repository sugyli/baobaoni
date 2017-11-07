<template>
	<div class="shujia" :style="'height:'+screen_height+'px;background: #fff;'">
		<div class="header online" style="text-align: center;">
				我的书架
				<a class="header-left" :href="bkurl">
					<i class="iconfont icon-fanhui1"></i>
				</a>
		</div>
		<scroller
			style="top: 45px"
			ref="searchScroller"
			:on-refresh="refresh"
			:on-infinite="infinite"
			:no-data-text="searchNoDataText"
			>
			<ul class="Displayanimation">
				<li v-if="isNotNullArray(items)" style="padding:10px 0;">
				<span class="red-bg">您的等级只能显示 {{bookcasecount}} 本 如果越界请删除不要的收藏才能显示更多</span>
				</li>
				<li v-for="item in items" :id="item.caseid">
						<p>书名：<img src="/images/new.gif" v-if="item.relation_articles && item.relation_articles.lastupdate > item.lastvisit">
						<a v-if="item.relation_articles" :href="redurl +'/' + item.relation_articles.articleid">
							<span v-if="item.relation_articles && item.relation_articles.lastupdate > item.lastvisit" class="red-bg">
							{{item.relation_articles.articlename}}
							</span>
							<span v-else style="color:#0000FF">{{item.relation_articles.articlename}}</span>
						</a>
						<span v-else>{{ item.articlename }} <em style="color:red;">丢失</em></span>
						</p>

						<p>作者：{{ item.relation_articles.author ? item.relation_articles.author : '未知'}}</p>

						<p>书签：
							<a v-if="item.chapterid > 0" :href="redurl +'/' + item.articleid +'/'+ item.chapterid">{{item.chaptername}}</a>
							<label v-else>无书签</label>
						</p>
						<p>最新章节：
							<a v-if="item.relation_articles && item.relation_articles.lastchapterid > 0" :href="redurl +'/' + item.relation_articles.articleid +'/'+ item.relation_articles.lastchapterid">{{item.relation_articles.lastchapter}}</a>
							<label v-else>无最新章节</label>
						</p>

						<p v-if="item.relation_articles">更新时间：{{ item.relation_articles.updatetime }}</label>
						<p v-else>更新时间：无</p>

						<p><a v-on:click.stop="case_del(item.caseid)"><span class="red-bg">删除本书</span></a></p>
				</li>
			</ul>
			</scroller>
	</div>
</template>
<style>

.shujia li {
    position: relative;
    padding: 0px 10px;
		border-bottom: 1px solid #eee;
}

.shujia li p {
	line-height: 32px;
	height: 32px;
	overflow: hidden;
	text-overflow: ellipsis;/*单行溢出文本显示省略号*/
	white-space: nowrap;/*规定段落中的文本不进行换行*/

}

.shujia .red-bg{
	color:red;
}

</style>

<script type="text/ecmascript-6">
  import BScroll from 'better-scroll'
  export default {
    props:['redurl','destroyurl','bookcasecount','bkurl'],
    data() {
      return {
				num:'获取中...',
				items: [],
				searchNoDataText: "没有更多数据",
				screen_height: Util.windowHeight,
				frist:0,
				isrefresh:0,
      }
    },
		computed: {

    },
    mounted() {
    },
    methods: {
			refresh(done){
					this.items = [];
					this.isrefresh = 1;
					this.$refs.searchScroller.finishInfinite(false);
					this.$refs.searchScroller.finishPullToRefresh();
					return;
			},
      infinite(done) {
					if(this.frist == 0){
							this.getData();
							this.frist = 1;
					}else if(this.isrefresh > 0){
							this.getData();
					}else{
							this.searchNoDataText = "加载完毕了！";
							this.$refs.searchScroller.finishInfinite(true);

					}
      },
			getData(){
          var self = this;
          axios.post(Config.shujiaurl, {
            })
            .then(function (response) {
								console.log(response);
								if(response.data.error == 0 ){
									self.num = response.data.bakdata.length;
									self.items = response.data.bakdata;
									self.searchNoDataText = "最后一页了";

								}else{
									self.num = 0;
									self.searchNoDataText = "没有数据";


								}
								self.$refs.searchScroller.finishInfinite(true);
            })
            .catch(function (response) {
								console.log(response);
                self.searchNoDataText = "请求出现故障";
                self.$refs.searchScroller.finishInfinite(true);

            });

      },
			get_Date: function(nS) {
					return new Date(parseInt(nS) * 1000).toLocaleString().replace(/:\d{1,2}$/,' ');
			},
			isNotNullArray(t){
				return (t.constructor==Array) && t.length > 0;
			},
			case_del(id){
				var self = this;
				//var url = self.destroyurl +"/"+id;
				var url = self.destroyurl;
				this.$dialog.confirm('确认将本书移除吗')
						.then(function () {

								axios.post(url, {
									caseid: id
									})
									.then(function (response) {
											if (response.data.error == 0) {
												$("#"+id).html("<li><p class='red-bg'>已经删除!</p></li>");
												//self.$toast.center($.trim(unescape(response.message)));
												self.$toast.center(response.data.message);
												self.num = Number(self.num) -1;
												self.num = self.num <= 0 ? 0 : self.num;
												return;
											}else{
													self.$toast.center('删除失败了');
													return;
											}
									})
									.catch(function (response) {
											console.log(response);
											self.$toast.center('服务器维护稍后再试');
											return;

									});

								/*
								$.get(url, '', function(response) {
										if (response && response.error == 0) {
												$("#"+id).html("<li><p class='red-bg'>已经删除!</p></li>");
												self.$toast.center($.trim(unescape(response.message)));
												self.num = Number(self.num) -1;
												self.num = self.num <= 0 ? 0 : self.num;
												return;
										}else{
												self.$toast.center('删除失败了');
												return;
										}

								}).error(function(xhr,errorText,errorType){
										console.log(errorText);
										self.$toast.center('服务器维护稍后再试');
										return;
								});
								*/
						})
						.catch(function () {

						});

			},

    },
  }
</script>
