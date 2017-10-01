
require('./public');
var windowWidth = $(window).width();
if(windowWidth<320){
   windowWidth = 320;
}

var offset = $($('.Swipe-tab').find('a')[0]).offset();
var index_header_tab_width = offset.width;
new Vue({
  el: '#app',
  data :{
    screen_width:windowWidth,
    index_header_tab_width:index_header_tab_width,


  }
})
