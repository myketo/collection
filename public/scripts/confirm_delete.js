$(document).ready(function() {
    $("#editForm").submit(function(e) {
        var val = $("input[type=submit][clicked=true]").attr("name");
        if(val == "submitDelete" && !confirm("Are you sure that you want to delete this cap?")){
            e.preventDefault();
        }

        if(val == "deleteImage" && !confirm("Are you sure that you want to delete this caps image?")){
            e.preventDefault();
        }
    });
    
    $("form input[type=submit]").click(function() {
        $("input[type=submit]", $(this).parents("form")).removeAttr("clicked");
        $(this).attr("clicked", "true");
    });
});