<?php
    include "../app/includes/functions/admin.php";
    include "../app/includes/queries/admin.php";
    
    if(!loggedIn()) headerLocation(".");
?>

<div class='subpage admin-page'>
    <a href='logout' class='btn btn-primary'>Logout</a>
    <br>
    dodaj
    aktywność - ostatnio dodane i zaktualizowane z datami, ile zrobiono danego dnia
    wyszukiwarka po id
</div>