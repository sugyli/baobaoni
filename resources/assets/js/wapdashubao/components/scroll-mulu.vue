<template>
<div>
<div class="mulu_header">
	<a class="top__back" href="/"></a>
	<span class="top__title online">标题</span>
	<a class="mulu-header-right iconfont" href="/">&#xe73d;</a>
</div>
<div class="list-wrapper" ref="scroll_wrapper">
  <div>
    <!-- 顶部提示信息 -->
    <div class="top-tip">
      {{topTip}}
    </div>

    <!-- 列表 -->
    <ul class="list-content list-content-hook Displayanimation">
      <li v-for="item in items">
        <a class="online" :href="item['chapterlink']">{{item['chaptername']}}</a><i></i>
      </li>
    </ul>
    <!--
      1、底部提示信息
      2、这里有一种情况,就是没有更多数据时,这里的文本应该显示"暂无更多数据"
    -->
    <div class="bottom-tip" :style="classObject">
      {{bottomTip}}
    </div>
  </div>
      <rotate-loade :loading="loading" style="position: absolute;top: 50%;left: 50%;"></rotate-loade>
</div>
<!-- footer -->
<div class="mulu-footer">
  <span class="iconfont">&#xe73d;</span>
  <span class="iconfont">&#xe73d;</span>
  <span class="iconfont">&#xe73d;</span>
</div>
<!-- alert -->
<div class="mulu-alert" :class="{ishide}">{{alert}}</div>
</div>
</template>
<script type="text/ecmascript-6">
  import BScroll from 'better-scroll'
  export default {
    props:['bid','url'],
    data() {
      return {
        topTip:'下拉刷新',
        alert: '刷新成功',
        bottomTip: '查看更多',
        ishide: true,
        loading: false,
        items: [],
        infinitePage: 1,
        stopinfinite:0,
        refreshPage: 1,
      }
    },
    computed: {
      classObject: function () {
        if(this.isNotNullArray(this.items)){
          this.loading = false;
          return '';
        }else{
          this.loading = true;
          return 'display: none;';
        }
      }
    },
    mounted() {
        var pageItem = Util.StorageGetter('mulubooid_'+this.bid);
        if(pageItem){
           this.infinitePage =  JSON.parse(pageItem);
           this.refreshPage =  JSON.parse(pageItem);
        }
      // 保证在DOM渲染完毕后初始化 better-scroll
      setTimeout(() => {
        this._initScroll()
      }, 20)
    },
    methods: {
      _initScroll() {
        var self = this;
        axios.post(self.url, {
              bid: self.bid,
              page: self.infinitePage,
          })
          .then(function (response) {
            if(response.data.error == 0){
              if (!self.$refs.scroll_wrapper) {
                return
              }

              var datas = response.data.bakdata;

              for (var i = 0; i < datas.length; i++) {
                self.items.push(datas[i]);
              }
              self.$nextTick(() => {
                  // better-scroll的初始化
                  var  scroll = new BScroll(self.$refs.scroll_wrapper, {
                                        probeType: 1,
                                        click: true,
                                        scrollX: false, /** * 是否开启横向滚动 */
                                      });
                      self.scroll = scroll;
                    // 滑动中
                    scroll.on('scroll', function (position) {
                      console.log(position.y);
                      if(position.y > 30) {
                        self.topTip = '释放立即刷新';
                      }
                    });
                    // 是否派发顶部下拉事件，用于下拉刷新
                   scroll.on('touchEnd', function (position) {
                     if (position.y > 30) {

                        if(self.refreshPage <= 0){
                            self.refreshAlert('已经是第一页了');
                            return;
                        }
                         setTimeout(function () {
                             /*
                              * 这里发送ajax刷新数据
                              * 刷新后,后台只返回第1页的数据,无论用户是否已经上拉加载了更多
                             */
                             self.refresh();

                             // 恢复文本值
                             self.topTip = '下拉刷新';

                             // 刷新列表后,重新计算滚动区域高度
                             scroll.refresh();
                           }, 1000);
                     }
                   });

                   // 是否派发滚动到底部事件，用于上拉加载
                   scroll.on('scrollEnd', (position) => {
                       // 滚动到底部
                       if (position.y <= (scroll.maxScrollY + 30)) {
                          if(self.stopinfinite == 0){
                              self.bottomTip = '加载中...';
                              setTimeout(function () {
                                // 向列表添加数据
                                self.infinite();
                                // 加载更多后,重新计算滚动区域高度
                                scroll.refresh();
                              }, 1000);
                           }

                         }
                    });

                });

            }else{
              console.log(response)
            }

          })
          .catch(function (response) {
            console.log(response)
          });
      },
      refreshAlert(text) {
        text = text || '操作成功';
        this.alert = text;
        this.ishide = false;
        var me = this;
        setTimeout(function(){
          me.ishide = true;
        },1000);
      },
      isNotNullArray(t){
        return (t.constructor==Array) && t.length > 0;
      },
      refresh(){
        var self = this;
        if(self.refreshPage <= 0){
            self.refreshAlert('已经第一页了,如有问题刷新页面');
            return;
        }
        self.refreshPage = Number(self.refreshPage) - 1;
        axios.post(self.url, {
              bid: self.bid,
              page: self.refreshPage,
          })
          .then(function (response) {
            if(response.data.error == 0){
                var datas = response.data.bakdata;

                for (var i = (datas.length-1); i >= 0; i--) {
                    self.items.splice(0, 0, datas[i]);
                }
                self.$nextTick(() => {
                  // 刷新成功后的提示
                  self.refreshAlert('刷新成功');
                  self.scroll.refresh();
                });
            }else{
              self.refreshPage = 0;
              self.refreshAlert('没有数据了');
              console.log(response);
            }

          })
          .catch(function (response) {
            self.refreshPage = 0;
            self.refreshAlert('出错了！！！');
            console.log(response)
          });

      },
      infinite() {
          var self = this;
          if(self.stopinfinite > 0){
              return;
          }
          self.infinitePage = Number(self.infinitePage) + 1;
          axios.post(self.url, {
                bid: self.bid,
                page: self.infinitePage,
            })
            .then(function (response) {
              if(response.data.error == 0){
                  var datas = response.data.bakdata;

                  for (var i = 0; i < datas.length; i++) {
                    self.items.push(datas[i]);
                  }
                  self.$nextTick(() => {
                    // 恢复文本值
                    self.bottomTip = '查看更多';
                    self.scroll.refresh();
                  });
              }else{
                // 恢复文本值
                self.bottomTip = '没有数据了';
                self.stopinfinite = 1;
                console.log(response);
              }

            })
            .catch(function (response) {
              self.bottomTip = '出现故障了';
              self.stopinfinite = 1;
              console.log(response)
            });
      },

    },
  }
</script>
