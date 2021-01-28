$(".list-group").each(function(){
    var actions = $(this).children().length - 1;
    var actions_amount = $(this).children().first().find(".actions-amount");
    actions_amount.text(actions);
});