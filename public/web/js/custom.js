$(document).ready(function(){
    // Size-chart 
    $(".size-chart").click(function(){
        $(".szi-cht").toggleClass("show");
        $(".size-chart").text(($(".size-chart").text() == 'see size chart') ? 'hide size chart' : 'see size chart').fadeIn();
    });

    //  
    $(".add-address").click(function(){
      $("#selt-add").hide();
      $("#add-addr").show();
    });

    // 
    $(".bck-selt").click(function(){
        $("#selt-add").show();
        $("#add-addr").hide();
    });
});