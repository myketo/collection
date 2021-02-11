<?php
    include "../app/includes/functions/admin.php";
    include "../app/includes/queries/admin.php";
    
    if(!loggedIn()) headerLocation("home");

    $dates = recentDates();
    $actions = actionsOnDates($dates, 4);
?>

<link rel='stylesheet' href='styles/admin.css'>
<div class='subpage admin-page'>
    <h1 class='display-4 text-center mb-2 mb-md-0'>Admin panel</h1>
    
    <div class='links mx-2 p-lg-1 mb-4 d-flex'>
        <div>
            <a href='admin/add' class='btn btn btn-primary'>Add new cap</a>
            <a href='admin/activity' class='btn btn btn-primary'>Activity history</a>
        </div>
        <a href='logout' class='btn btn-secondary ml-auto'>Logout</a>
    </div>

    <div class='row d-flex flex-column-reverse flex-lg-row justify-content-between pl-xl-5 m-0'>
        <div class='recent col col-lg-4 p-3 mt-4 mt-md-0'>
            <h1>Recent changes</h1>
            <?php
                for($i = count($dates)-1; $i >= 0; $i--){
                    echo "<ul class='list-group mt-3 mb-4'>";
                    echo "<h4 class='mb-3'><a href='admin/activity?date={$dates[$i]}' class='text-dark'><b>{$dates[$i]}</b></a></h4>";

                    foreach($actions[$i] as $item){
                        $item['updated_at'] = strtotime($item['updated_at']);
                        $item['created_at'] = strtotime($item['created_at']);

                        if($dates[$i] == date("Y-m-d", $item['updated_at'])){
                            echo "<li class='list-group-item list-group-item-warning'>Updated <i>{$item['brand']} (<a href='collection?field=id&search={$item['id']}'>#{$item['id']}</a>)</i></li>";
                        }
                        
                        if($dates[$i] == date("Y-m-d", $item['created_at'])){                    
                            echo "<li class='list-group-item list-group-item-success'>Added <i>{$item['brand']} (<a href='collection?field=id&search={$item['id']}'>#{$item['id']}</a>)</i></li>";
                        }
                    }
                    echo "</ul>";
                }
            ?>
        </div>

        <div class='search_by_id col col-lg-4 p-3'>
            <h1 class='mb-3'>Search by ID</h1>
            
            <form method='GET' action='collection' class='form form-inline'>
                <input type='hidden' name='field' value='id'>
                <input type='number' name='search' min='1' required class='mr-1 form-control' placeholder='Search' style='width: 10rem;'>
                <button class='btn btn-primary' type='submit'>Search</button>
            </form>
        </div>
    </div>
</div>