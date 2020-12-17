function getUrlVars()
{
    var vars = [], hash;
    var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
    for(var i = 0; i < hashes.length; i++)
    {
        hash = hashes[i].split('=');
        vars.push(hash[0]);
        vars[hash[0]] = hash[1];
    }
    return vars;
}

var page = parseInt(getUrlVars()["page"]);
var last_page = Math.ceil(parseInt($(".caps-count").text())/10);
if(isNaN(page)) page = 1;

$(".page-item").filter(function(){
    if(page == 1){
        if($(this).hasClass("first-page") || $(this).hasClass("previous-page")){
            $(this).addClass("disabled");
        }
    }else if(page == last_page){
        if($(this).hasClass("last-page") || $(this).hasClass("next-page")){
            $(this).addClass("disabled");
        }
    }

    if($(this).text() == page){
        $(this).addClass("active");
    }
});