<?php
    include "../app/includes/functions/collection.php";
    include "../app/includes/queries/collection.php";
?>

<link rel='stylesheet' href='styles/collection.css'></link>
<div class="collection-page d-flex flex-column">
    <h1 class='display-1 text-center'><?=countAllRows("", "", true)?></h1>

    <?php
        $items = getItems("id", "asc", "1000", "0", "", "", true);
        foreach($items as $item) showItem($item);
    ?>

    <script src='scripts/show_details.js'></script>
</div>