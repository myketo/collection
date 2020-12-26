$('.item-details').on('show.bs.collapse', function() {
    details = $(this).prev().first().find(".details_link");
    details.html("Details &uArr;");
});

$('.item-details').on('hide.bs.collapse', function() {
    details = $(this).prev().first().find(".details_link");
    details.html("Details &dArr;");
});