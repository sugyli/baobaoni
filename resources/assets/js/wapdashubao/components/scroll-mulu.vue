<template>
<div class="mulu__bd" :style="'height:'+screen_height+'px;background: #fff;'">
	<div class="mulu_header">
		<a class="top__back" href="/"></a>
		<span class="top__title online">标题</span>
		<a class="mulu-header-right iconfont"  v-on:click.stop="openModel('voteAlert')">&#xe73d;</a>
	</div>

	<scroller
		style="top: 45px"
		ref="searchScroller"
		:on-refresh="refresh"
		:on-infinite="infinite"
		:no-data-text="searchNoDataText"
		:refresh-text = "refreshText"
		>
		<ul class="list-content list-content-hook">
			<li v-for="item in items">
				<a class="online" :href="item['chapterlink']" :class="{'red-bg': item['chapterid'] == cid}" >{{item['chaptername']}}</a><i></i>
			</li>
		</ul>
		</scroller>
		<sweet-modal title="举报错误" ref="voteAlert">
            <form id="cuowuForm">
							<textarea :style="'width:100%;height:'+(this.screen_height * 0.5)+'px;border:0;background-color:transparent;color: #666464;outline: none;'"></textarea>
            </form>
      <p slot="button"><vm-button type="primary" id="subBnt">提交</vm-button></p>

    </sweet-modal>
</div>
</template>
<style>
.mulu__bd{
	position: relative;
	overflow: hidden;
}
.mulu_header {
    top: 0;
    height: 44px;
    background: #efeff0;
    border-bottom: 1px solid #ddd;
    font: 15px/45px a;
    color: rgba(0,0,0,0.7);
    position: fixed;
    z-index: 999;
    left: 0;
    display: flex;
    width: 100%;
}
.mulu_header .top__title{
  flex: 1;
  line-height: 44px;
  text-align: center;
}
.mulu-header-right {
    float: right;
    height: 44px;
    width: 42px;
    text-align: center;
    font-size: 22px;

}

.list-wrapper {
    position: fixed;
    z-index: 1;
    top: 44px;
    bottom: 50px;
    left: 0;
    width: 100%;
    background: #fff;
    overflow: hidden;
}
.top-tip {
    position: absolute;
    top: -40px;
    left: 0;
    bottom: 50px;
    z-index: 1;
    width: 100%;
    height: 40px;
    line-height: 40px;
    text-align: center;
    color: #555;
}

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
	import { Button } from 'vue-multiple-button';
	import 'vue-multiple-button/lib/button.css';
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
				cid:0,

      }
    },
		components: {
				SweetModal,
				SweetModalTab,
				'vm-button': Button
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
