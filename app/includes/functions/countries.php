<?php

function showCountry($country)
{
    $countries = include "../app/includes/countries_array.php";

    echo "<tr>
        <td><img src='media/flags/{$country['name']}.svg' class='country-flag image-fluid rounded shadow'></td>
        <td><a href='collection?country={$country['name']}'>{$countries[$country['name']]}</a></td>
        <td>{$country['amount']}</td>
    </tr>";
}