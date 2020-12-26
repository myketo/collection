<?php
include "../app/includes/functions/collection.php";
include "../app/includes/queries/collection.php";

$caps_count = countAllRows();
if(!$page = pageInfo($caps_count)) headerLocation("collection");
$url = filterUrlData($_GET);
?>

<link rel='stylesheet' href='styles/collection.css'></link>
<div class="collection-page d-flex flex-column">
    <h1 class='display-1 text-center caps-count'><?=$caps_count?></h1>

    <div class='col d-flex justify-content-end mr-1'>
        <a class='btn btn-primary w-25 col-lg-2' data-toggle='collapse' href='#sortForm' role='button' aria-expanded="false" aria-controls="collapseExample">Sorting</a>
    </div>

    <?php
        include "sorting.php";

        $pagination = paginationLinks($page['nr'], $page['count'], $url['nopagepath']);

        include "pagination.php";
        $items = getItems($url['sort_by'], $url['order_by'], $page['limit'], $page['offset']);
        foreach($items as $item) showItem($item, true);

        include "pagination.php";
    ?>

    <script src='scripts/sorting.js'></script>
    <script src='scripts/pagination.js'></script>
    <script src='scripts/show_details.js'></script>
</div>