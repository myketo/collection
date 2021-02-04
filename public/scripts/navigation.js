$(function() {
    var url = window.location.href;
    url = url.split("?")[0];
    url = url.split("/")[5];
    
    if(url != "#" && $("#nav-"+url).length){
        $("#nav-"+url).addClass('active');
    }

    if($('.nav-item').hasClass('active') === false){
        $("#home").addClass('active');
    }

    if($(document).height() <= $(window).height()){ 
       $("#scroll-btn").addClass("d-none");
    }
});

$("#scroll-btn").on('click', function(e){
    e.preventDefault();
    $('html, body').animate({scrollTop: 0}, 300);
});