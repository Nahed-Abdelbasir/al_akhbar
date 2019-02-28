


//==================== footer bottom 0 ============

if($("body").height() <= $(window).height()){
    $("footer").css({
        "position" : "absolute" ,
        "width" : "100%",
        "bottom" : "0" 
    });
}
    




//=========== active link ============

$("nav .nav-item").click(function(){
    
    $("nav .nav-item").removeClass("active");
    $(this).addClass("active");
    
    
});







//============= login toggle ===============

$(".form-user h2 span").click(function(){
    $(".form-user h2 span").toggleClass("active");
    $(".form-user .form-login , .form-user .form-sign").removeClass("show");
    $($(".form-user .active").attr("data-class")).addClass("show") ;
})















