$('.collapse').on('show.bs.collapse', function() {
    details = $(this).prev().first().find("a");
    details.html("Details &uArr;");
});

$('.collapse').on('hide.bs.collapse', function() {
    details = $(this).prev().first().find("a");
    details.html("Details &dArr;");
});