<?php

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