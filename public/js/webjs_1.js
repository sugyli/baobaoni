(function () {
  var baobaoni = {
    init: function(){
        this.searchApi();
    },
    searchApi: function() {
      $('#search_input').bind('keyup',function(){
        var jqueryInput = $(this);
        var searchText = jqueryInput.val();
         searchText = $.trim(searchText);
         if(searchText==undefined || searchText== "" || searchText ==null){
              return  false;
          }else{
            axios.post(Config.aliinputsearchurl, {
                  query: searchText,
              })
              .then(function (response) {
                  if(response.data.error == 0){
                    var data = response.data.bakdata;
                    var html = "";
                    for (var i = 0; i < data.length; i++) {
                      html += '<li>提示：<span>'+data[i].suggestion+'</li>';
                    }
                    $("#search-result").html(html);
                    $('#search-suggest').css({
                      top:$('#search-form').offset().top+$('#search-form').height(),
                      left:$('#search-form').offset().left-1,
                      position: 'absolute'
                    }).show();

                  }

              })
              .catch(function (response) {

                  console.log(response);

              });

          }

      });
    }


  }
  window.baobaoni = baobaoni;
  baobaoni.init();
})()//闭包不影响全局
