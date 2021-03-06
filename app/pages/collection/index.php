<?php
// include "../app/includes/functions/collection.php";
include "../app/includes/queries/collection.php";
// $url = filterUrlData($_GET);

$caps_count = countAllRows($url['search'], $url['field'], $url['country']);

$subtitle = subtitle($url);

if(!$caps_count){
    $msg = "Sorry, no results found for '<i>{$url['search']}</i>'";
    $msg .= !empty($url['field']) ? " in field '<i>{$url['field']}</i>'." : ".";
    showAlert($msg, 'danger', true);
}

if(!$page = pageInfo($caps_count)) headerLocation("collection");
?>

<link rel='stylesheet' href='styles/collection.css'></link>
<div class="subpage collection-page d-flex flex-column">
    <h1 class='display-4 text-center caps-count mb-0'><?=$caps_count?></h1>
    <small class='text-center subtitle mb-3' style='font-size: 120%;'><?=$subtitle?></small>

    <div class='col d-flex justify-content-end mr-1 mb-2'>
        <a class='btn btn-primary w-25 col-lg-2' data-toggle='collapse' href='#sortForm' role='button' aria-expanded="false" aria-controls="collapseExample">Sorting</a>
    </div>

    <?php
        include "sorting.php";

        if($page['count'] > 1){
            $pagination = paginationLinks($page['nr'], $page['count'], $url['nopagepath']);
            $page_name = paginationNames($page['nr'], $page['count']);
            include "pagination.php";
        }

        $items = getItems($url['sort_by'], $url['order_by'], $page['limit'], $page['offset'], $url['search'], $url['field'], $url['country']);
        foreach($items as $item) showItem($item, loggedIn());

        if($page['count'] > 1) include "pagination.php";
    ?>
</div>

<script src='scripts/min/sorting.min.js'></script>
<script src='scripts/min/pagination.min.js'></script>
<script src='scripts/min/show_details.min.js'></script>