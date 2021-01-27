$(document).ready(function(){
    scaleNoImage();

    $(window).resize(function(){
        scaleNoImage();
    });
});

function scaleNoImage()
{
    $(".no-image").each(function(){
        var height = $(".img").height();
        $(this).height(height);
        $(this).css("line-height", height+"px");
    });
}