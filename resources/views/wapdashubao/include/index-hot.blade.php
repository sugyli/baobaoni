<style>
  .i-hot{
    position: relative;
    background: #fff;
    border-bottom: 10px solid #f5f5f5;
  }
  .i-hot-header{
    position: relative;
    padding: 10px 14px;
    border-bottom: 1px solid #f0f0f0;
    border-left: 6px solid #ffab18;
  }
  .i-hot-header-title{
    font-size: 16px;
    font-weight: normal;
    color: #333;
  }


  .i-hot-list{
    padding: 13px 14px 5px;
    font-size: 0px;
  }
  .i-hot-list li{
    width:33.3%;
    display:inline-block;
    vertical-align:top;
    line-height: 1;
    margin-bottom: 8px;

  }
  .i-hot-list li>*{
    display: inline-block;
  }
  .i-hot-list li:nth-child(3n+1){text-align:left;}
  .i-hot-list li:nth-child(3n+2){text-align:center;}
  .i-hot-list li:nth-child(3n+3){text-align:right;}


  .i-hot-list-wrap{
    position : relative;
    overflow: hidden;
    width: 86px;
  }
  .i-hot-list-wrap-cover{
    position: relative;
    width: 86px;
    height: 113px;
    background-color: #eeece9;
    box-shadow: 0px 6px 5px -3px #aaa;
    border: 1px solid #f0f0f0;
    border-bottom: none;
    overflow: hidden;
  }
  .i-hot-list-wrap-cover img{
    width: 100%;
    height: 100%;
  }
  .i-hot-list-wrap-info{
    padding-top: 8px;
  }
  .i-hot-list-wrap-info-title{
    font-size: 13px;
    line-height: 1.4em;
    max-height: 2.8em;
    color: #8d8d8d;
    font-weight: 400;
    margin-bottom: 0px;
    text-align: center;
    overflow: hidden;
    text-overflow: ellipsis;/*单行溢出文本显示省略号*/
    white-space: nowrap;/*规定段落中的文本不进行换行*/

  }
  .p-tag {
      position: absolute;
      top: 0;
      left: 0;
      line-height: 1.4;
      background-color: #ef6c2c;
      color: #fff;
      width: 100%;
      -webkit-transform-origin: top center;
      -webkit-transform: translateX(50%) rotate(45deg) translateY(50%) scale(0.8);
      font-size: 1.4rem;
      text-align: center;
  }
  .p-tag.-word{
    background-color: #49ab3f;

  }
  .p-tag.-word:before{
    content: '\9650\514d';
  }

</style>

<section class="i-hot">
  <div class="i-hot-header">
    <h2 class="i-hot-header-title">热门推荐</h2>
  </div>

  <ul class="i-hot-list Displayanimation">

    <li>
        <a href="javasrcipt:">
          <div class="i-hot-list-wrap">
            <div class="i-hot-list-wrap-cover">
              <img src="http://www.dashubao.net/xsfengmian/84/84672/84672s.jpg"/>
              <div class="p-tag -word"></div>
            </div>

            <div class="i-hot-list-wrap-info">
                <h3 class="i-hot-list-wrap-info-title">
                  书名
                </h3>
            </div>
          </div>
        </a>
    </li>

    <li>
        <a href="javasrcipt:">
          <div class="i-hot-list-wrap">
            <div class="i-hot-list-wrap-cover">
              <img src="http://www.dashubao.net/xsfengmian/84/84672/84672s.jpg"/>
              <div class="p-tag -word"></div>
            </div>

            <div class="i-hot-list-wrap-info">
                <h3 class="i-hot-list-wrap-info-title">
                  书名书名书名书名书
                  名书名书名书名
                </h3>
            </div>
          </div>
        </a>
    </li>

    <li>
        <a href="javasrcipt:">
          <div class="i-hot-list-wrap">
            <div class="i-hot-list-wrap-cover">
              <img src="http://www.dashubao.net/xsfengmian/84/84672/84672s.jpg"/>
              <div class="p-tag -word"></div>
            </div>

            <div class="i-hot-list-wrap-info">
                <h3 class="i-hot-list-wrap-info-title">
                  书名
                </h3>
            </div>
          </div>
        </a>
    </li>

    <li>
        <a href="javasrcipt:">
          <div class="i-hot-list-wrap">
            <div class="i-hot-list-wrap-cover">
              <img src="http://www.dashubao.net/xsfengmian/84/84672/84672s.jpg"/>
              <div class="p-tag -word"></div>
            </div>

            <div class="i-hot-list-wrap-info">
                <h3 class="i-hot-list-wrap-info-title">
                  书名
                </h3>
            </div>
          </div>
        </a>
    </li>
  </ul>
</section>
