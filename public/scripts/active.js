$(function() {
    var url = window.location.href;
    $('.nav-item a').filter(function() {
        return this.href == url;
    }).parent().addClass('active');

    if($('.nav-item').hasClass('active') === false){
        $("#home").addClass('active');
    }
});