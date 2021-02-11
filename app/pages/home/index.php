<?php
    include "../app/includes/queries/recentlyAdded.php";
    include "../app/includes/functions/recentlyAdded.php";
    include "../app/includes/queries/collection.php";

    $caps_count = countAllRows();
    $items = getRecentlyAdded(9);
?>
<link rel='stylesheet' href='styles/home.css'></link>
<div class="home-page">
    <div class="jumbotron m-0">
        <div class="container">
            <h1 class="display-4">Welcome!</h1>
            <p class="lead mb-5">On this website you are able to browse my personal collection of bottle caps. I started collecting around the year 2012 because I really liked the designs on some of the caps and I still enjoy adding new ones to my collection to this day. Currently, I own exactly <span class="font-weight-bold"><?=$caps_count?>&nbsp;different bottle caps</span>. I hope you enjoy looking through my collection and thanks for checking it out!</p>
            <p><a class="btn btn-primary btn-lg" href="collection" role="button">Start browsing &raquo;</a></p>
        </div>
    </div>

    <div class="album pt-5 bg-light">
        <div class="container">
            <h2 class='mb-4'>Recently added: </h2>
            <div class="row">
                <?php foreach($items as $item) showRecentlyAdded($item, loggedIn()); ?>
            </div>
        </div>
    </div>
</div>

<script src='scripts/min/scale_no_image.min.js'></script>