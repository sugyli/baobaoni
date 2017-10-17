<template>
<div class="list-wrapper" ref="scroll_wrapper">
  <div>
    <!-- 顶部提示信息 -->
    <div class="top-tip">
      {{topTip}}
    </div>
    <!-- 列表 -->
    <ul class="list-content list-content-hook">
      <li>
        <a class="online" href="http://www.sugyli.com/content/46398/20606041" title="第四十七章 一场婚礼">{{topTip}}</a><i></i>
      </li>
      <li>
        <a class="online" href="http://www.sugyli.com/content/46398/20606041" title="第四十七章 一场婚礼">第四十七章 一场婚礼</a><i></i>
      </li>
      <li>
        <a class="online" href="http://www.sugyli.com/content/46398/20606041" title="第四十七章 一场婚礼">第四十七章 一场婚礼</a><i></i>
      </li>
      <li>
        <a class="online" href="http://www.sugyli.com/content/46398/20606041" title="第四十七章 一场婚礼">第四十七章 一场婚礼</a><i></i>
      </li>
      <li>
        <a class="online" href="http://www.sugyli.com/content/46398/20606041" title="第四十七章 一场婚礼">第四十七章 一场婚礼</a><i></i>
      </li>
      <li>
        <a class="online" href="http://www.sugyli.com/content/46398/20606041" title="第四十七章 一场婚礼">第四十七章 一场婚礼</a><i></i>
      </li>
      <li>
        <a class="online" href="http://www.sugyli.com/content/46398/20606041" title="第四十七章 一场婚礼">第四十七章 一场婚礼</a><i></i>
      </li>
      <li>
        <a class="online" href="http://www.sugyli.com/content/46398/20606041" title="第四十七章 一场婚礼">第四十七章 一场婚礼</a><i></i>
      </li>
      <li>
        <a class="online" href="http://www.sugyli.com/content/46398/20606041" title="第四十七章 一场婚礼">第四十七章 一场婚礼</a><i></i>
      </li>
      <li>
        <a class="online" href="http://www.sugyli.com/content/46398/20606041" title="第四十七章 一场婚礼">第四十七章 一场婚礼</a><i></i>
      </li>
      <li>
        <a class="online" href="http://www.sugyli.com/content/46398/20606041" title="第四十七章 一场婚礼">第四十七章 一场婚礼</a><i></i>
      </li>
      <li>
        <a class="online" href="http://www.sugyli.com/content/46398/20606041" title="第四十七章 一场婚礼">第四十七章 一场婚礼</a><i></i>
      </li>
      <li>
        <a class="online" href="http://www.sugyli.com/content/46398/20606041" title="第四十七章 一场婚礼">第四十七章 一场婚礼</a><i></i>
      </li>
      <li>
        <a class="online" href="http://www.sugyli.com/content/46398/20606041" title="第四十七章 一场婚礼">第四十七章 一场婚礼</a><i></i>
      </li>
      <li>
        <a class="online" href="http://www.sugyli.com/content/46398/20606041" title="第四十七章 一场婚礼">第四十七章 一场婚礼</a><i></i>
      </li>
      <li>
        <a class="online" href="http://www.sugyli.com/content/46398/20606041" title="第四十七章 一场婚礼">第四十七章 一场婚礼</a><i></i>
      </li>
      <li>
        <a class="online" href="http://www.sugyli.com/content/46398/20606041" title="第四十七章 一场婚礼">第四十七章 一场婚礼</a><i></i>
      </li>
      <li>
        <a class="online" href="http://www.sugyli.com/content/46398/20606041" title="第四十七章 一场婚礼">第四十七章 一场婚礼</a><i></i>
      </li>
      <li>
        <a class="online" href="http://www.sugyli.com/content/46398/20606041" title="第四十七章 一场婚礼">第四十七章 一场婚礼</a><i></i>
      </li>
      <li>
        <a class="online" href="http://www.sugyli.com/content/46398/20606041" title="第四十七章 一场婚礼">第四十七章 一场婚礼</a><i></i>
      </li>
    </ul>
    <!--
      1、底部提示信息
      2、这里有一种情况,就是没有更多数据时,这里的文本应该显示"暂无更多数据"
    -->
    <div class="bottom-tip">
      <span class="loading-hook">查看更多</span>
    </div>
  </div>
</div>
</template>
<script type="text/ecmascript-6">
  import BScroll from 'better-scroll'
  export default {
    data() {
      return {
        topTip:'下拉刷新',

      }
    },
    mounted() {
      // 保证在DOM渲染完毕后初始化 better-scroll
      setTimeout(() => {
        this._initScroll()
      }, 20)
    },
    methods: {
      _initScroll() {
        if (!this.$refs.scroll_wrapper) {
          return
        }
        // better-scroll的初始化
        this.scroll = new BScroll(this.$refs.scroll_wrapper, {
                              probeType: 1,
                              click: true,
                              scrollX: false, /** * 是否开启横向滚动 */
                            })
        // 滑动中
        this.scroll.on('scroll', function (position) {
          if(position.y > 30) {
            console.log('f');
            this.topTip = '释放立即刷新';
          }
        });


      },
    }
  }
</script>
