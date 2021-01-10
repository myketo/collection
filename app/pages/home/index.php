<link rel='stylesheet' href='styles/home.css'></link>
<div class="home-page">
    <div class="jumbotron">
        <div class="container">
            <h1 class="display-3">Welcome!</h1>
            <p class="lead mb-5">On this website you are able to browse my personal collection of bottle caps. I started collecting around the year 2012 because I really liked the designs on some of the caps and I still enjoy adding new ones to my collection to this day. Currently, I own exactly <span class="font-weight-bold">500&nbsp;different bottle caps</span>. I hope you enjoy looking through my collection and thanks for checking it out!</p>
            <p><a class="btn btn-primary btn-lg" href="collection" role="button">Start browsing &raquo;</a></p>
        </div>
    </div>

    <div class="album py-5 bg-light">
        <div class="container">
            <div class="row">
            <?php
                include "../app/includes/queries/recentlyAdded.php";
                include "../app/includes/functions/recentlyAdded.php";
                $items = getRecentlyAdded(9);
                foreach($items as $item) showRecentlyAdded($item);
            ?>
            </div>
        </div>
    </div>
</div>