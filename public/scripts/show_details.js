$('#details1').on('show.bs.collapse', function() {
    details = $(this).prev().first().find("a");
    details.html("Details &uArr;");
});

$('#details1').on('hide.bs.collapse', function() {
    details = $(this).prev().first().find("a");
    details.html("Details &dArr;");
});