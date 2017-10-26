<template>
<div class="mulu__bd" :style="'height:'+screen_height+'px;background: #fff;'">
	<div class="mulu_header">
		<a class="top__back" href="/"></a>
		<span class="top__title online">{{bookname}}</span>
		<a class="mulu-header-right iconfont icon-warning"  v-on:click.stop="openModel('voteAlert')"></a>
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
				<a class="online" :href="item['chapterlink']" :class="{'red-bg': item['chapterid'] == cid}" >{{item['chaptername']}}</a><i></i>
			</li>
		</ul>
		</scroller>
		<sweet-modal title="举报错误" ref="voteAlert">
				<form id="jubaoForm">
					<textarea name="content" v-model="content" @keyup.13="onSubmit" class="textarea" :style="'width:100%;height:'+ (screen_height * 0.4)+ 'px;'" placeholder="输入举报内容 来源地址 我们已经记录了"></textarea>
					<div class="input_el">
		          <button type="button" class="btn_small" value="submit" v-on:click="onSubmit">提　　交</button>
		      </div>
				</form>
    </sweet-modal>
</div>
</template>
<style>

.mulu__bd li {
    position: relative;
    padding: 0px 10px;
}

.mulu__bd li a {
    display: block;
    line-height: 40px;
    height: 40px;
    border-bottom: 1px solid #eee;
}

.mulu__bd li i {
    position: absolute;
    top: 0px;
    right: 5px;
    width: 15px;
    height: 40px;
    background: center url(/wapdashubao/images/list.png) no-repeat;
}

.mulu__bd .red-bg{
	color:red;
}


</style>

<script type="text/ecmascript-6">
	import {SweetModal , SweetModalTab} from 'sweet-modal-vue';
  import BScroll from 'better-scroll'
  export default {
    props:['bid','url','from'],
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
				cid: 0,
				bookname: '',
				content:'',

      }
    },
		components: {
				SweetModal,
				SweetModalTab,
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
			openModel(ref) {
				if (this.$refs[ref]) {
					this.$refs[ref].open()
				} else {
					throw new Error('openModel Ref not defined: ' + ref)
				}
			},
			closeModel(ref) {
				if (this.$refs[ref]) {
					this.$refs[ref].close()
				} else {
					throw new Error('openModel Ref not defined: ' + ref)
				}
			},
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
								self.bookname = '本地址通过手机加载出错了';
                self.noData = true;
                self.searchNoDataText = "请求出现故障";
                self.$refs.searchScroller.finishInfinite(true);

            });

      },
			isNotNullArray(t){
				return (t.constructor==Array) && t.length > 0;
			},
			onSubmit(){
				this.closeModel('voteAlert');
				//$("textarea[name='content']").val("");
				//var jsonData = $("#jubaoForm").serialize();
				//var jsonData = $("#jubaoForm").serializeArray();
				 var content =  $.trim(this.content);
				 this.content = '';
				 if(!content){
				 		this.$toast.center('提交内容不能为空');
						return
				 }
				 if(!this.bookname){
						this.$toast.center('请等待数据加载完毕');
						return;
				 }
				 var self = this;
				 var from = self.from;
				 var title = '来源手机_书名：'+ self.bookname;
				 axios.post(Config.jubaourl, {
							 content: content,
							 title: title,
							 from: from,
					 })
					 .then(function (response) {
						 console.log(response);
						 if(response.data.message){
						 		self.$toast.center(response.data.message);
						 }else{
						 		self.$toast.center('返回数据出错了');
						 }

					 })
					 .catch(function (response) {
							 console.log(response);
							 self.$toast.center('请刷新页面再尝试！');
					 });

				},

    },
  }
</script>
