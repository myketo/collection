<?php
    include "../app/includes/functions/collection.php";
    include "../app/includes/queries/collection.php";
?>

<link rel='stylesheet' href='styles/collection.css'>
<div class="subpage collection-page d-flex flex-column">
    <h1 class='display-4 text-center caps-count mb-0'><?=countAllRows("", "", "", true)?></h1>
    <small class='text-center subtitle mb-5' style='font-size: 120%;'>unknown caps</small>

    <?php
        $items = getItems("id", "asc", "1000", "0", "", "", "", true);
        foreach($items as $item) showItem($item, loggedIn());
    ?>

    <script src='scripts/show_details.js'></script>
</div>