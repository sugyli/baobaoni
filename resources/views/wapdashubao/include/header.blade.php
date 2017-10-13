<div class="header Displayanimation" v-bind:class="{ ishide: !ishide}">
  <div class="Swipe-tab Swipe-tab_2 f-cb">
    <a href="javasrcipt:" v-bind:class="tab_1_class" v-on:click.stop="tabSwitch(0)"></a>
    <a href="javasrcipt:" v-bind:class="tab_2_class" v-on:click.stop="tabSwitch(1)"></a>
    <i v-bind:style="'width:'+index_header_tab_width +
                  'px;transition-duration:'+ header_duration +
                  's;transform:'+'translate3d('+ header_position +'px,0px,0px);'"></i>
  </div>
  <em class="header-user"></em>
  <em class="header-checkin"></em>
</div>
