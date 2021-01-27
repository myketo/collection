<?php
    include "../app/includes/functions/admin.php";
    include "../app/includes/queries/admin.php";

    $dates = recentDates(5);
    $actions = actionsOnDates($dates);
?>

<div class='activity-page d-flex flex-column p-4'>
    <h1 class='text-center'>Activity History</h1>

    <div class='row'>
        <div class='recent col-4'>
        <?php
            for($i = 0; $i < count($dates); $i++){
                echo "<ul class='list-group mt-3 mb-4'>";
                echo "<h4 class='mb-3'><b><u>{$dates[$i]}</u></b> (<span class='actions-amount'></span> actions)</h4>";

                foreach($actions[$i] as $item){
                    $item['updated_at'] = strtotime($item['updated_at']);
                    $item['created_at'] = strtotime($item['created_at']);

                    if($dates[$i] == date("Y-m-d", $item['updated_at'])){
                        echo "<li class='list-group-item list-group-item-warning'>Updated <i>{$item['brand']} (#{$item['id']})</i></li>";
                    }
                    
                    if($dates[$i] == date("Y-m-d", $item['created_at'])){                    
                        echo "<li class='list-group-item list-group-item-success'>Added <i>{$item['brand']} (#{$item['id']})</i></li>";
                    }
                }
                echo "</ul>";
            }
        ?>
        </div>

        <div class='calendar col-4'>
            <!-- php calendar extention -->
        </div>
    </div>
</div>

<script>
    $(".list-group").each(function(){
        var actions = $(this).children().length - 1;
        var actions_amount = $(this).children().first().find(".actions-amount");
        actions_amount.text(actions);
    });
</script>