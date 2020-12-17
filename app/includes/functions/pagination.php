<?php

function paginationLinks($page = 1, $page_amount)
{
    $url = "collection";
    $query = "?page=";

    $first_page = $url;
    $last_page = $url . $query . $page_amount;

    $previous = $url . $query . ($page-1);
    $next = $url . $query . ($page+1);

    $first = $previous;
    $second = $url . $query . $page;
    $third = $next;

    if($page == 1){
        $first = $first_page;
        $second = $next;
        $third = $url . $query . ($page+2);
    }elseif($page == 2){
        $previous = $first_page;
    }elseif($page == $page_amount){
        $first = $url . $query . ($page_amount-2);
        $second = $url . $query . ($page_amount-1);
        $third = $last_page;
    }

    return [
        'first_page' => $first_page,
        'last_page' => $last_page,
        'previous' => $previous,
        'next' => $next, 
        'first' => $first,
        'second' => $second,
        'third' => $third
    ];
}