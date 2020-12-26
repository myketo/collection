<!-- sortowanie tabeli js'em -->

<?php
    function getCountries()
    {
        global $conn;

        $query = "SELECT `country` AS 'name', COUNT(*) AS 'amount' FROM `collection` WHERE `unknown` = 0 GROUP BY `country` ORDER BY `amount` DESC;";
        $result = mysqli_query($conn, $query);

        $countries = [];
        while($row = mysqli_fetch_array($result)){
            $row['filename'] = strtolower(str_replace(" ", "-", $row['name']));
            array_push($countries, $row);
        }
        
        return $countries;
    }

    function showCountry($country)
    {
        // <th scope='row'>1</th>
        echo 
        "<tr>
        <td>
            <img src='media/flags/{$country['filename']}.svg' class='country-flag image-fluid'>
        </td>
        <td><a href='collection?country={$country['name']}'>{$country['name']}</a></td>
        <td>{$country['amount']}</td>
    </tr>";
    }
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
        <?php
            foreach($countries as $country) showCountry($country);
        ?>
        </tbody>
    </table>
</div>