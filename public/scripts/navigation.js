$(function() {
    var url = window.location.href;
    url = url.split("?")[0];
    url = url.split("/")[5];
    console.log(url);
    
    // $('.nav-item a').filter(function() {
    //     return this.href == url;
    // }).parent().addClass('active');

    $("#nav-"+url).addClass('active');

    if($('.nav-item').hasClass('active') === false){
        $("#home").addClass('active');
    }
});

$("#scroll-btn").on('click', function(e){
    e.preventDefault();
    $('html, body').animate({scrollTop: 0}, 300);
});