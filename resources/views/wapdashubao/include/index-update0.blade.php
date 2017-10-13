<style>
.i-up{
  background: #fff;
  border-bottom: 10px solid #f5f5f5;
  position: relative;
}
.i-up-header{
  position: relative;
  padding: 15px 13px 14px 13px;
  border-bottom: 1px solid #f0f0f0;
}
.i-up-header-title{
  position: relative;
  font: bold 13px/13px a;
  color: rgba(0, 0, 0, 0.9);
}
.i-up-header-title > i{
  position: absolute;
  margin: -1px 0 0 5px;
  padding: 3px 5px 0 5px;
  font: 9px/9px a;
  color: #fff;
  background: #53ac7d;
  border-radius: 1px;
}
.i-up-header-tab{
  position: absolute;
  top: 9px;
  right: 13px;

}
.i-up-header-tab a{
  position: relative;
  font: 12px/12px a;
  color: #999;
  padding: 16px 7px;
  -webkit-tap-highlight-color:rgba(0,0,0,0);

}
.i-up-header-tab a:after{
  content: '';
  position: absolute;
  top: 16px;
  bottom: 16px;
  right: 0;
  width: 1px;
  border-right: solid 1px #ccc;
}
.i-up-header-tab a:last-child {
    padding-right: 0;
    padding-left: 0;

}
.i-up-header-tab a:last-child:after {
    display: none;
}
.i-up-header-tab-select{
  color: #528ae8 !important;/*important防止被覆盖*/
}

.i-up-list{
  padding: 0 13px;

}
.i-up-list li{
  padding: 17px 0;
  border-bottom: 1px solid #f0f0f0;
}
.i-up-list li:last-child {
    border: none;
}
.i-up-list-main{
  overflow: hidden;

}

.i-up-list-main-left{
  position: relative;
  float: left;
  width: 85px;
  height: 113px;
  background-color: #eeece9;/*书没加载出来有个背景色*/
  border: 1px solid #f0f0f0;
  border-radius: 1px;
  overflow: hidden;
}

.i-up-list-main-left img {
    width: 100%;
    height: 100%;
    border-radius: 1px;
}
.i-up-list-main-state{
  position: absolute;
  bottom: 0;
  width: 100%;
  box-sizing: border-box;
  font: 10px/10px a;
  padding: 25px 7px 6px;
  color: #fff;
  background: -webkit-linear-gradient(top,rgba(0,0,0,0),rgba(0,0,0,0.3));

}
.i-up-list-main-right{
    margin-left: 100px;
    padding-top: 6px;
    background: #fff;
}
.i-up-list-main-right-bookname{
  margin-bottom: 4px;
  font: 16px/17px a;
  color: rgba(0, 0, 0, 0.9);
  overflow: hidden;
  text-overflow: ellipsis;/*单行溢出文本显示省略号*/
  white-space: nowrap;/*规定段落中的文本不进行换行*/
}
.i-up-list-main-right-author{
  margin-top: 8px;
  font: 12px/12px a;
  color: rgba(0, 0, 0, 0.7);
  overflow: hidden;
  text-overflow: ellipsis;
  white-space: nowrap;
}
.i-up-list-main-right-info{
  margin: 8px 0 0;
  height: 2.8em;
  font: 12px/1.4em a;
  color: rgba(0, 0, 0, 0.6);
  overflow: hidden;
  text-overflow: ellipsis;
  /*下面3个控制多行*/
  display: -webkit-box;/*多行文字溢出*/
  -webkit-line-clamp: 2;/*多行文字几行*/
  -webkit-box-orient: vertical;/*溢出就用...*/
}

.i-up-list-main-right-tags{
  margin-top: 10px;
  padding-top: 3px;
  overflow: hidden;

}
.i-up-list-main-right-tags-tag{
  float: left;
  margin: -3px 7px 0 0;
  padding: 3px 6px 2px;
  font: 10px/11px a;
  color: #53ac7d;
  border-radius: 3px;
  border: 1px solid #53ac7d;
  text-overflow: ellipsis;
  overflow: hidden;
  white-space: nowrap;
  max-width: 6em;
}
.i-up-list-main-right-tags-tag:last-child {
    margin-right: 0;
}

.i-up-list-mainnoimg-left{
  float: left;
  margin-top: 1px;
  font: 13px/13px a;
  color: rgba(237, 83, 15, 0.9);
}
.i-up-list-mainnoimg-right{
    margin-left: 27px;
}
.i-up-list-mainnoimg-right-bookname{
  font: 15px/15px a;
  color: rgba(0, 0, 0, 0.9);
  background: #fff;
  position: relative;
}

.i-up-foot{
  border-top: 1px solid #f0f0f0;
  overflow: hidden;

}
.i-up-foot >a {
  display: block;
  width: 100%;
  padding: 14px;
  font: 13px/1.3em a;
  color: rgba(0, 0, 0, 0.9);
  box-sizing: border-box;
  text-align: center;
}


</style>

<section class="i-up">
  <div class="i-up-header">
    <p class="i-up-header-title">
      最新数据
    </p>
    <div class="i-up-header-tab" ref="test">
      <a href="javasrcipt:" v-on:click="Tab(1)" class="i-up-header-tab-select" id="tab1">更新</a>
      <a href="javasrcipt:" v-on:click="Tab(2)" id="tab2">入库</a>
    </div>
  </div>
    <div id="d1">
      <ul class="i-up-list Displayanimation">
        <li>
            <div class="i-up-list-main">
              <a href="/">
                <div class="i-up-list-main-left">
                  <img src="http://www.dashubao.net/xsfengmian/84/84656/84656s.jpg"/>
                  <p class="i-up-list-main-state">
                    完结
                  </p>
                </div>
                <div class="i-up-list-main-right">
                  <p class="i-up-list-main-right-bookname">
                    书名
                  </p>

                  <p class="i-up-list-main-right-author">
                    作者
                  </p>

                  <p class="i-up-list-main-right-info">
                    副科级都是垃圾饭到啦辅导教师拉发动机
                    副科级都是垃圾饭到啦辅导教师拉发动机
                    副科级都是垃圾饭到啦辅导教师拉发动机
                    副科级都是垃圾饭到啦辅导教师拉发动机
                    副科级都是垃圾饭到啦辅导教师拉发动机
                    副科级都是垃圾饭到啦辅导教师拉发动机
                    副科级都是垃圾饭到啦辅导教师拉发动机
                    副科级都是垃圾饭到啦辅导教师拉发动机
                    副科级都是垃圾饭到啦辅导教师拉发动机副科级都是垃圾饭到啦辅导教师拉发动机副科级都是垃圾饭到啦辅导教师拉发动机
                    副科级都是垃圾饭到啦辅导教师拉发动机副科级都是垃圾饭到啦辅导教师拉发动机副科级都是垃圾饭到啦辅导教师拉发动机副科级都是垃圾饭到啦辅导教师拉发动机
                    副科级都是垃圾饭到啦辅导教师拉发动机副科级都是垃圾饭到啦辅导教师拉发动机副科级都是垃圾饭到啦辅导教师拉发动机
                    副科级都是垃圾饭到啦辅导教师拉发动机副科级都是垃圾饭到啦辅导教师拉发动机
                  </p>
                  <div class="i-up-list-main-right-tags">
                    <div class="i-up-list-main-right-tags-tag">玄幻小说</div>
                  </div>

                </div>
              </a>
            </div>

        </li>
        <li>
          <a href="javasrcipt">
            <div class="i-up-list-main i-up-list-mainnoimg">
              <span class="i-up-list-mainnoimg-left">01</span>
              <div class="i-up-list-mainnoimg-right">
                <div class="i-up-list-mainnoimg-right-bookname">
                  书名
                </div>
              </div>
            </div>
          </a>
        </li>

        <li>
          <a href="javasrcipt">
            <div class="i-up-list-main i-up-list-mainnoimg">
              <span class="i-up-list-mainnoimg-left">01</span>
              <div class="i-up-list-mainnoimg-right">
                <div class="i-up-list-mainnoimg-right-bookname">
                  书名
                </div>
              </div>
            </div>
          </a>
        </li>

        <li>
          <a href="javasrcipt">
            <div class="i-up-list-main i-up-list-mainnoimg">
              <span class="i-up-list-mainnoimg-left">01</span>
              <div class="i-up-list-mainnoimg-right">
                <div class="i-up-list-mainnoimg-right-bookname">
                  书名
                </div>
              </div>
            </div>
          </a>
        </li>

        <li>
          <a href="javasrcipt">
            <div class="i-up-list-main i-up-list-mainnoimg">
              <span class="i-up-list-mainnoimg-left">01</span>
              <div class="i-up-list-mainnoimg-right">
                <div class="i-up-list-mainnoimg-right-bookname">
                  书名
                </div>
              </div>
            </div>
          </a>
        </li>
      </ul>
      <div class="i-up-foot">
        <a href="javasrcipt">更多...</a>
      </div>
   </div>
  <div id="d2" style="display:none;">
    <ul class="i-up-list Displayanimation">
      <li>
          <div class="i-up-list-main">
            <a href="/">
              <div class="i-up-list-main-left">
                <img src="http://www.dashubao.net/xsfengmian/84/84656/84656s.jpg"/>
                <p class="i-up-list-main-state">
                  完结
                </p>
              </div>
              <div class="i-up-list-main-right">
                <p class="i-up-list-main-right-bookname">
                  书名2222
                </p>

                <p class="i-up-list-main-right-author">
                  作者
                </p>

                <p class="i-up-list-main-right-info">
                  副科级都是垃圾饭到啦辅导教师拉发动机
                  副科级都是垃圾饭到啦辅导教师拉发动机
                  副科级都是垃圾饭到啦辅导教师拉发动机
                  副科级都是垃圾饭到啦辅导教师拉发动机
                  副科级都是垃圾饭到啦辅导教师拉发动机
                  副科级都是垃圾饭到啦辅导教师拉发动机
                  副科级都是垃圾饭到啦辅导教师拉发动机
                  副科级都是垃圾饭到啦辅导教师拉发动机
                  副科级都是垃圾饭到啦辅导教师拉发动机副科级都是垃圾饭到啦辅导教师拉发动机副科级都是垃圾饭到啦辅导教师拉发动机
                  副科级都是垃圾饭到啦辅导教师拉发动机副科级都是垃圾饭到啦辅导教师拉发动机副科级都是垃圾饭到啦辅导教师拉发动机副科级都是垃圾饭到啦辅导教师拉发动机
                  副科级都是垃圾饭到啦辅导教师拉发动机副科级都是垃圾饭到啦辅导教师拉发动机副科级都是垃圾饭到啦辅导教师拉发动机
                  副科级都是垃圾饭到啦辅导教师拉发动机副科级都是垃圾饭到啦辅导教师拉发动机
                </p>
                <div class="i-up-list-main-right-tags">
                  <div class="i-up-list-main-right-tags-tag">玄幻小说</div>
                </div>

              </div>
            </a>
          </div>

      </li>
      <li>
        <a href="javasrcipt">
          <div class="i-up-list-main i-up-list-mainnoimg">
            <span class="i-up-list-mainnoimg-left">01</span>
            <div class="i-up-list-mainnoimg-right">
              <div class="i-up-list-mainnoimg-right-bookname">
                书名2222
              </div>
            </div>
          </div>
        </a>
      </li>

      <li>
        <a href="javasrcipt">
          <div class="i-up-list-main i-up-list-mainnoimg">
            <span class="i-up-list-mainnoimg-left">01</span>
            <div class="i-up-list-mainnoimg-right">
              <div class="i-up-list-mainnoimg-right-bookname">
                书名2222
              </div>
            </div>
          </div>
        </a>
      </li>

      <li>
        <a href="javasrcipt">
          <div class="i-up-list-main i-up-list-mainnoimg">
            <span class="i-up-list-mainnoimg-left">01</span>
            <div class="i-up-list-mainnoimg-right">
              <div class="i-up-list-mainnoimg-right-bookname">
                书名2222
              </div>
            </div>
          </div>
        </a>
      </li>

      <li>
        <a href="javasrcipt">
          <div class="i-up-list-main i-up-list-mainnoimg">
            <span class="i-up-list-mainnoimg-left">01</span>
            <div class="i-up-list-mainnoimg-right">
              <div class="i-up-list-mainnoimg-right-bookname">
                书名2222
              </div>
            </div>
          </div>
        </a>
      </li>
    </ul>
    <div class="i-up-foot">
      <a href="javasrcipt">更多...</a>
    </div>
  </div>


</section>
