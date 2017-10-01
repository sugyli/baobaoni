<style>
.header{
  position: relative;
  background: #efeff0;
  padding: 0px 90px;
  border-bottom: 1px solid #ddd;
  line-height: 44px;
  text-align: center;
}

.header i{
  bottom: -1px;
}
.header i:before{
  content: '';
  display: block;
  height: 2px;
  width: 34px;
  margin:0 auto;
  background: #777;
}

.header a:before{
  content: '\4e66\67b6';
  display:block;
  margin: 0 auto;
  width:2em;

}

.header-tab a:first-child:before{
     content: '\4e66\57ce';
}
.Swipe-tab{
  position: relative;
  overflow: hidden;
  z-index: 1;

}
.Swipe-tab a{
  float: left;
  text-align: center;
  -webkit-tap-highlight-color:rgba(0,0,0,0);
}
.Swipe-tab_2 a{
  width: 50%;
}
.Swipe-tab i {
    position: absolute;
    left: 0;
    -webkit-transition:-webkit-transform .3s ease-out;
}


.f-cb:after{
    clear:both;
    content: '';
    display: block;
    height: 0;
    overflow:hidden;
    visibility: hidden;
}
.header-user {
    position: absolute;
    right: 0px;
    top:0px;
    width: 44px;
    height: 44px;
    background: url(/wapdashubao/images/user.png) no-repeat center;
    background-size: 16px;
}
.header-checkin{
    position: absolute;
    left: 0px;
    top:0px;
    width: 44px;
    height: 44px;
    background: url(/wapdashubao/images/checkin.png) no-repeat center;
    background-size: 22px;
}

</style>

<div class="header">
  <div class="Swipe-tab Swipe-tab_2 f-cb">
    <a href="javasrcipt" v-bind:style="{ color: tab_1_class}"></a>
    <a href="javasrcipt" v-bind:style="{ color: tab_2_class}"></a>
    <i v-bind:style="{
      width: index_header_tab_width +'px',
      'transition-duration': header_duration +'s',
      transform:'translate3d('+ header_position +'px,0px,0px)'
      }"></i>
  </div>
  <em class="header-user"></em>
  <em class="header-checkin"></em>

</div>
