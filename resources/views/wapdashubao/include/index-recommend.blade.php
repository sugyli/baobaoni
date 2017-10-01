<style>
.i-rd{
  background: #fff;
  border-bottom: 10px solid #f5f5f5;
  position: relative;
}
.i-rd-header{
  position: relative;
  padding: 15px 13px 14px 13px;
  border-bottom: 1px solid #f0f0f0;
}
.i-rd-header-title{
  position: relative;
  font: bold 13px/13px a;
  color: rgba(0, 0, 0, 0.9);
}
.i-rd-header-title > i{
  position: absolute;
  margin: -1px 0 0 5px;
  padding: 3px 5px 0 5px;
  font: 9px/9px a;
  color: #fff;
  background: #53ac7d;
  border-radius: 1px;
}
.i-rd-header-tab{
  position: absolute;
  top: 9px;
  right: 13px;

}
.i-rd-header-tab a{
  position: relative;
  font: 12px/12px a;
  color: #999;
  padding: 16px 7px;

}
.i-rd-header-tab a:after{
  content: '';
  position: absolute;
  top: 16px;
  bottom: 16px;
  right: 0;
  width: 1px;
  border-right: solid 1px #ccc;
}
.i-rd-header-tab a:last-child {
    padding-right: 0;
}
.i-rd-header-tab a:last-child:after {
    display: none;
}
.i-rd-header-tab-select{
  color: #528ae8 !important;/*important防止被覆盖*/
}



.i-rd-list{
  padding: 0 13px;

}
.i-rd-list li{
  padding: 17px 0;
  border-bottom: 1px solid #f0f0f0;
}
.i-rd-list li:last-child {
    border: none;
}
.i-rd-list-main{
  overflow: hidden;

}
.i-rd-list-main img {
    width: 100%;
    height: 100%;
    border-radius: 1px;
}
.i-rd-list-main-left{
  position: relative;
  float: left;
  width: 85px;
  height: 113px;
  background-color: #eeece9;/*书没加载出来有个背景色*/
  border: 1px solid #f0f0f0;
  border-radius: 1px;
  overflow: hidden;
}
.i-rd-list-main-state{
  position: absolute;
  bottom: 0;
  width: 100%;
  box-sizing: border-box;
  font: 10px/10px a;
  padding: 25px 7px 6px;
  color: #fff;
  background: -webkit-linear-gradient(top,rgba(0,0,0,0),rgba(0,0,0,0.3));

}
.i-rd-list-main-right{
    margin-left: 100px;
    padding-top: 6px;
    background: #fff;
}
.i-rd-list-main-right-bookname{
  margin-bottom: 4px;
  font: 16px/17px a;
  color: rgba(0, 0, 0, 0.9);
  overflow: hidden;
  text-overflow: ellipsis;/*单行溢出文本显示省略号*/
  white-space: nowrap;/*规定段落中的文本不进行换行*/
}
.i-rd-list-main-right-author{
  margin-top: 8px;
  font: 12px/12px a;
  color: rgba(0, 0, 0, 0.7);
  overflow: hidden;
  text-overflow: ellipsis;
  white-space: nowrap;
}
.i-rd-list-main-right-info{
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

.i-rd-list-main-right-tags{
  margin-top: 10px;
  padding-top: 3px;
  overflow: hidden;

}
.i-rd-list-main-right-tags-tag{
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
.i-rd-list-main-right-tags-tag:last-child {
    margin-right: 0;
}

.i-rd-list-mainnoimg-left{
  float: left;
  margin-top: 1px;
  font: 13px/13px a;
  color: rgba(237, 83, 15, 0.9);
}
.i-rd-list-mainnoimg-right{
    margin-left: 27px;
}
.i-rd-list-mainnoimg-right-bookname{
  font: 15px/15px a;
  color: rgba(0, 0, 0, 0.9);
  background: #fff;
  position: relative;
}

.i-rd-foot{
  border-top: 1px solid #f0f0f0;
  overflow: hidden;

}
.i-rd-foot >a {
  float: left;
  width: 50%;
  padding: 14px;
  font: 13px/1.3em a;
  color: rgba(0, 0, 0, 0.9);
  box-sizing: border-box;
  text-align: center;
}
.i-rd-foot > a:first-child {
    border-right: 1px solid #f0f0f0;
}



</style>

<section class="i-rd">
  <div class="i-rd-header">
    <p class="i-rd-header-title">
      重磅推出<i>荐</i>
    </p>
    <div class="i-rd-header-tab">
      <a href="javasrcipt" class="i-rd-header-tab-select">男</a>
      <a href="javasrcipt">女</a>
    </div>
  </div>

  <ul class="i-rd-list">
    <li>
      <a href="/">
        <div class="i-rd-list-main">
          <div class="i-rd-list-main-left">
            <img src="http://www.dashubao.net/xsfengmian/84/84656/84656s.jpg"/>
            <p class="i-rd-list-main-state">
              完结
            </p>
          </div>
          <div class="i-rd-list-main-right">
            <p class="i-rd-list-main-right-bookname">
              书名
            </p>

            <p class="i-rd-list-main-right-author">
              作者
            </p>

            <p class="i-rd-list-main-right-info">
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
            <div class="i-rd-list-main-right-tags">
              <div class="i-rd-list-main-right-tags-tag">玄幻小说</div>
            </div>

          </div>

        </div>
      </a>
    </li>
    <li>
      <a href="javasrcipt">
        <div class="i-rd-list-main i-rd-list-mainnoimg">
          <span class="i-rd-list-mainnoimg-left">01</span>
          <div class="i-rd-list-mainnoimg-right">
            <div class="i-rd-list-mainnoimg-right-bookname">
              书名
            </div>
          </div>
        </div>
      </a>
    </li>

    <li>
      <a href="javasrcipt">
        <div class="i-rd-list-main i-rd-list-mainnoimg">
          <span class="i-rd-list-mainnoimg-left">01</span>
          <div class="i-rd-list-mainnoimg-right">
            <div class="i-rd-list-mainnoimg-right-bookname">
              书名
            </div>
          </div>
        </div>
      </a>
    </li>

  </ul>

  <div class="i-rd-foot">
    <a href="javasrcipt">测试</a>
    <a href="javasrcipt">测试2</a>
  </div>





</section>
