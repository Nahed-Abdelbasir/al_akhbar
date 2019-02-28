
//==================== footer bottom 0 ============

if($("body").height() <= $(window).height()){
    $("footer").css({
        "position" : "absolute" ,
        "width" : "100%",
        "bottom" : "0" 
    });
}
    




//=========== active nav link ============

$("nav .nav-item").click(function(){
    
    $("nav .nav-item").removeClass("active");
    $(this).addClass("active");
    
});





//=========== active arrange link ============

$(".show-news .choose a").click(function(){
    
    $(".show-news .choose a").removeClass("select");
    $(this).addClass("select");
    
});



