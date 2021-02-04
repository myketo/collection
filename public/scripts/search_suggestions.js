function findSuggestions(search, field)
{
    $.post("../app/includes/search_suggestions.php", {'search': search, 'field': field}, function(data){
        if(!data) return;
        // console.log(data);
        var arr = $.parseJSON(data);
        // console.log(arr);

        $(".search-suggestions").html("");
        
        if(field == "country"){
            $.each(arr, function(index){
                $(".search-suggestions").append("<a href='collection?country=" + index + "' class='list-group-item list-group-item-action btn text-left p-2'>" + this + "</a>");
            });
        }else{
            $.each(arr, function(){
                $(".search-suggestions").append("<a href='collection?search=" + this + "' class='list-group-item list-group-item-action btn text-left p-2'>" + this + "</a>");
            });
        }
    });
}

$(document).ready(function()
{
    $("input[name=search]").on('click input propertychange', function(){
        var search = $(this).val();
        
        if(search.length < 2){
            $(".search-suggestions").html("");
            return;
        }

        $(".search-suggestions").show();

        var field = $("select[name=field]").val();
        findSuggestions(search, field);
    });

    $("select[name=field]").on('change propertychange', function(){
        var search = $("input[name=search]").val();
        
        if(search.length < 2){
            $(".search-suggestions").html("");
            return;
        }

        var field = $("select[name=field]").val();
        findSuggestions(search, field);
    });
});

$(document).mouseup(function(e) 
{
    var container = $(".search-suggestions");

    if (!container.is(e.target) && container.has(e.target).length === 0) 
    {
        container.hide();
    }
});