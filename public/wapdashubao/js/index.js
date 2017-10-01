var windowWidth = $(window).width();
if(windowWidth<320){
   windowWidth = 320;
}
var offset = $($('.Swipe-tab').find('a')[0]).offset();
var index_header_tab_width = offset.width;
new Vue({
   el:'#app',
   data:{
       screen_width:windowWidth,
       double_screen_width:windowWidth*2,
       index_header_tab_width:index_header_tab_width,
       duration:0,
       position:0,
       header_position:0,
       header_duration:0,
       tab_1_class:'#ff6600',
       tab_2_class:'',
       tab1:{
         'i-up-header-tab-select':true
       },
       tab2:''
   },
   methods:{
     Tab: function(num){
       //this.tab2 = {'i-up-header-tab-select':true};
       var i;
       for(i=1;i<=4;i++)
       {

           if(i==num){

             $("#tab"+i).addClass("i-up-header-tab-select");
             $("#d"+i).show();

           }else{
             $("#tab"+i).removeClass("i-up-header-tab-select");
             $("#d"+i).hide();
           }

       }
     }


   }

})
