<?php


/**
 * Display a table row with country info
 * @param array $country array containing data about the country to be shown
 */
function showCountry($country)
{
    // include the countries array
    $countries = include "../app/includes/countries_array.php";

    // display the table row with country info
    echo "<tr>
        <td><img src='media/flags/{$country['name']}.svg' class='country-flag image-fluid rounded shadow'></td>
        <td><a href='collection?country={$country['name']}'>{$countries[$country['name']]}</a></td>
        <td>{$country['amount']}</td>
    </tr>";
}