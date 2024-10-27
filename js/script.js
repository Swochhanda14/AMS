$(".menu > ul > li").click(function (e){

    // remove active from already active 
    $(this).siblings().removeClass("active");
    
    // add active
    $(this).toggleClass("active");
    
    // if it has sub menu open it
    $(this).find("ul").slideToggle();
    
    // close other sub menu if any open
    $(this).siblings().find("ul").slideUp();
    
    // remove active class of sub menu items
    $(this).siblings().find("ul").find("li").removeClass("active");
});

    
    
    // responsive nav 
    $(".menu-btn").click(function () {
        $(".sidebar").toggleClass("active");
    });

