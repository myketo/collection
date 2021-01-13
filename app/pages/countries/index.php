<!-- sortowanie tabeli js'em -->
<?php
    include "../app/includes/functions/countries.php";
    include "../app/includes/queries/countries.php";
    $countries = getCountries();
?>

<div class='countries-page d-flex flex-column align-items-center'>
    <h1 class='display-1 text-center'><?=count($countries)?></h1>
    <table class='table table-hover table-bordered text-center col-md-9 m-4'>
        <thead class='thead-light'>
            <!-- <th scope='col'>#</th> -->
            <th scope='col'>Flag</th>
            <th scope='col'>Country</th>
            <th scope='col'>Collection</th>
        </thead>

        <tbody>
            <?php foreach($countries as $country) showCountry($country); ?>
        </tbody>
    </table>
</div>