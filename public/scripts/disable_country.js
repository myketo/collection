$("#disable_country").change(function()
{
    if($("#newCountry").attr("disabled")){
        $("#newCountry").removeAttr("disabled");
        $("#newCountry").val("PL");
    }else{
        $("#newCountry").attr("disabled", true);
        $("#newCountry").val("");
    }
});