function orderBy()
{
    sort_by = $("#sort_by option:selected").val();
    if(sort_by == "date"){
        $(".order-by-desc").html("Newest");
        $(".order-by-asc").html("Oldest");
    }else{
        $(".order-by-desc").html("Z-A");
        $(".order-by-asc").html("A-Z");
    }
}

$(document).ready(function(){
    orderBy();
    if($("#asc").attr("checked") != "checked"){
        $("#desc").attr("checked", "checked");
    }

    $("#sort_by").change(function(){
        orderBy();
    });
});