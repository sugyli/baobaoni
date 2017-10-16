<template>
  <!--该节点需要定位，内容以此节点的盒模型为基础滚动。另外，该节点的背景色配合上拉加载、下拉刷新的UI，正常情况下不可作它用。-->
<div class="better-scroll-root" :style="'height:'+screen_height+'px;'">
    <div class="right-search">
      <a  href="javascript:history.back()" class="top__back"></a>
      <div id="search-input" class="search-input"> <b class="search-input__mi"></b>
        <input type="text" v-model="searchKeyword" ref="search_box" placeholder="输入书名/作者/关键字">
        <div class="search-input__btn" v-on:click="search">搜索</div>
      </div>
    </div>
    <div class="top__bd list-wrapper">
      <div v-if="loading" class="loading"></div>
      <div ref="better_scroll_root">
        <div>
            <!-- 顶部提示信息 -->
            <div class="top-tip">
              <span class="refresh-hook">{{pulldownTip}}</span>
            </div>
            <section class="i-cl" v-if="isArray(searchItems)">
                <ul class="i-cl-list Displayanimation">
                    <li v-for="(item, index) in searchItems">
                      <div class="i-cl-list-main">
                        <a href="/">
                          <div class="i-cl-list-main-left">
                            <img :src="item['imgflag']"/>
                            <p class="i-cl-list-main-left-state">
                              {{item['fullflag']}}
                            </p>
                          </div>
                          <div class="i-cl-list-main-right">
                            <p class="i-cl-list-main-right-bookname">
                              {{item['articlename']}}
                            </p>

                            <p class="i-cl-list-main-right-author">
                                {{item['author']}}
                            </p>

                            <p class="i-cl-list-main-right-info">
                              {{item['intro']}}
                            </p>
                            <div class="i-cl-list-main-right-tags">
                              <div class="i-cl-list-main-right-tags-tag">{{item['articlefenlei']}}</div>
                            </div>
                          </div>
                        </a>
                      </div>
                    </li>
                </ul>
            </section>
            <div v-else>
                <ul class="m-tag -color search-tag">
                  <li v-for="(item, index) in storageSearchItems" class="u-tag" id="Tag__128">{{item}}</li>
                </ul>

                <div class="his-dele" v-if="isArray(storageSearchItems)">
                  <a v-on:click.stop="delStorageSearchItems">
                  <img src="/wapdashubao/images/icon_search_del.png" style="width:.98rem;height:.92rem;display: inline-block;">清除记录
                  </a>
                </div>
            </div>
                  <!--
                    1、底部提示信息
                    2、这里有一种情况,就是没有更多数据时,这里的文本应该显示"暂无更多数据"
                  -->
            <div class="bottom-tip" v-bind:class="{bottomhalt}">
              <span class="loading-hook">{{bottomTip}}</span>
            </div>
        </div>
      </div>
      <div class="alert alert-hook" v-bind:class="{haltAlert}">{{alertText}}</div>
    </div>
</div>
</template>
<style>
.better-scroll-root {
    background: #ccc;
    position: relative;
    overflow: hidden;
}

.list-wrapper {
    position: relative;
    overflow: hidden;
    height:100%;
    background-color: #fff;
    padding-top:45px;
}
.list-wrapper .top-tip {
    position: absolute;
    top: -44px;
    left: 0;
    width: 100%;
    height: 40px;
    line-height: 40px;
    text-align: center;
    color: #555;
}
.bottom-tip {
    width: 100%;
    height: 35px;
    line-height: 35px;
    text-align: center;
    color: #777;
    background: #f2f2f2;
}

.better-scroll-root .alert {
    position: fixed;
    top: 44px;
    left: 0;
    z-index: 2;
    width: 100%;
    height: 35px;
    line-height: 35px;
    text-align: center;
    color: #fff;
    font-size: 12px;
    background: rgba(7, 17, 27, 0.7);
}
.haltAlert , .bottomhalt{
  display: none;
}
</style>
<script>
import BScroll from 'better-scroll'

export default {
    data() {
        return {
            screen_height: Util.windowHeight,
            searchKeyword: '',
            pulldownTip: '下拉刷新！',
            bottomTip: '查看更多',
            alert: '刷新成功',
            searchItems: [],
            storageSearchItems:[],
            alertText: 'alertText',
            haltAlert: true,
            bottomhalt: true,
            loading: false,
            url: '/searchinput',
        };
    },
    mounted() {
        // 保证在DOM渲染完毕后初始化better-scroll
        setTimeout(() => {
            //this._initScroll()
            this.getStorageSearchItems();
        }, 20)
    },
    methods: {
        _initScroll() {

            if (!this.$refs.better_scroll_root) {
                return;
            }
            // better-scroll的初始化
            this.scroll = new BScroll(this.$refs.better_scroll_root, {
                probeType: 1,
                click: true,
                scrollX: false,
            });

            // 滑动中
            this.scroll.on('scroll', function (position) {
              if(position.y > 30) {
                  this.pulldownTip = '松开立即刷新';
              }
            });

            /*
             * @ touchend:滑动结束的状态
             * @ maxScrollY:屏幕最大滚动高度
            */
            // 滑动结束
            this.scroll.on('touchend', function (position) {
              if (position.y > 30) {

                setTimeout(function () {
                  /*
                   * 这里发送ajax刷新数据
                   * 刷新后,后台只返回第1页的数据,无论用户是否已经上拉加载了更多
                  */

                  // 恢复文本值
                  this.pulldownTip = '下拉刷新';
                  // 刷新成功后的提示
                  this.refreshAlert('刷新成功');
                  // 刷新列表后,重新计算滚动区域高度
                  this.scroll.refresh();
                }, 1000);
              }else if(position.y < (this.maxScrollY - 30)) {
                $this.bottomhalt = false;
                $this.bottomTip = '加载中...';
                setTimeout(function () {
                  // 恢复文本值
                  $this.bottomTip = '查看更多';
                  // 向列表添加数据
                  this.reloadData();
                  // 加载更多后,重新计算滚动区域高度
                  this.scroll.refresh();
                }, 1000);
              }
            });

        },
        // 加载更多方法
        reloadData() {
          var template = '<li class="list-item"><div class="avatar"><img src="img/1.png" width="100" height="100" /></div>'+
                  '<div class="text"><h2>只会放肆,不会说谎,好青春也是谁不想要一个深情却刺激</h2><span>2016-11-23</span></div></li>'
          // 向ul容器中添加内容
          listContent.innerHTML = listContent.innerHTML + template;
        },
        // 刷新成功提示方法
        refreshAlert(text) {
            text = text || '操作成功';
            this.alertText = text;
            //alert.style.display = 'block';

            this.haltAlert = false;
            setTimeout(function(){
              this.haltAlert = true;
            //alert.style.display = 'none';
            },1000);
        },
        isArray(t){
          return (t.constructor==Array) && t.length > 0;
        },
        getStorageSearchItems(){
            var storageSearchItems = Util.StorageGetter('StorageSearchItems');
            console.log(storageSearchItems);
            if(storageSearchItems){
               this.storageSearchItems =  JSON.parse(storageSearchItems);
            }else{
              this.storageSearchItems = [];
            }
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

          this.storageSearchItems.splice(0, 0,keyword);
          this.storageSearchItems = this.storageSearchItems.unique3();
          //this.storageSearchItems.push(keyword)
          Util.StorageSetter('StorageSearchItems',JSON.stringify(this.storageSearchItems));

        },
        delStorageSearchItems(){
          Util.StorageDel('StorageSearchItems');
          this.getStorageSearchItems();
        },
        getKeyWord(){

          return $.trim(this.searchKeyword);

        },
        toggleShow: function() {
            this.loading = !this.loading;
        },
        refresh () {
            var self  = this;
            axios.post(self.url, {
                  query: self.searchKeyword,
              })
              .then(function (response) {
                self.toggleShow();
                console.log(response);
                if(response.data.error == 0){
                    var data = response.data.bakdata.data;
                    self.searchItems = data;
                    self.setStorageSearchItems(searchKeyword);
                }else{
                      console.log('2222222222222')

                }

              })
              .catch(function (response) {
                  self.toggleShow();
                  console.log(response);

              });

        },
        search:function() {
            var keyword =  this.getKeyWord();
            keyword = $.trim(keyword);
            if (keyword) {
              this.toggleShow();
              setTimeout(() => {
                  this._initScroll()
                  this.refresh();
              }, 20)
            }

        },
    },
}
</script>
