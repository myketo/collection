<?php


/**
 * Return information about collection page
 * @param int $caps_count amount of caps used to calculate page_count and db query offset
 * @param int $limit defines how many data rows are supposed to be displayed on a single page
 * @return array returns current page nr, count of all pages, limit of data per page and offset
 */
function pageInfo($caps_count, $limit = 10)
{
    // if $_GET['page'] is not set or invalid then set page as default 1
    if(!$page = filter_input(INPUT_GET, 'page', FILTER_SANITIZE_NUMBER_INT)){
        $page = 1;
    }

    // calculate the amount of pages based on the limit per page
    $count = $caps_count <= $limit ? 1 : ceil($caps_count / $limit);

    // if set page doesnt exist then return
    if($page < 1 || $page > $count) return;

    // set offset for current page
    $offset = ($page * $limit) - $limit;

    return [
        'nr' => $page,
        'count' => $count,
        'limit' => $limit,
        'offset' => $offset
    ];
}


/**
 * Function that analyzes and filters GET query data for Collection page
 * @param array $url array containing GET data
 * @return array returns validated values while also generating a new url
 */
function filterUrlData($url = [])
{
    // valid values for sort_by and order_by
    $valid_sort = ["brand", "text", "color", "country", "field"];
    $valid_field = ["brand", "text", "color", "country", "id"];
    $valid_order = ["asc", "desc"];

    // setting default values
    $path = "";
    $data = [
        'country' => '',
        'search' => '',
        'field' => '',
        'sort_by' => 'id',
        'order_by' => 'desc',
        'page' => 1
    ];

    // check country query (if search isn't set)
    if(isset($url['country']) && !isset($url['search'])){
        $url['country'] = filter_input(INPUT_GET, 'country', FILTER_SANITIZE_STRING);

        if(empty($url['country'])) headerLocation('collection');

        $path .= "country={$url['country']}";
        $data['country'] = $url['country'];
    }

    // check search query (if country isn't set)
    if(isset($url['search']) && !isset($url['country'])){
        global $conn;
        $url['search'] = mysqli_escape_string($conn, $url['search']);

        if(empty($url['search'])) headerLocation("collection");

        $path .= "search={$url['search']}";
        $data['search'] = $url['search'];

        // check field query
        if(isset($url['field'])){
            $url['field'] = filter_input(INPUT_GET, 'field', FILTER_SANITIZE_STRING);
            
            // if field is empty or set to 'id' but admin isn't logged in then redirect
            if(empty($url['field']) || ($url['field'] == 'id' && !loggedIn())) headerLocation("collection?$path");

            $path .= "&field={$url['field']}";
            $data['field'] = in_array($url['field'], $valid_field) ? $url['field'] : "";
        }

        // if searched by country field then set default sorting to country asc
        if(!isset($url['sort_by'])){
            $data['sort_by'] = $data['field'] == "country" ? "country" : "brand";
            $data['order_by'] = "asc";
        }
    }

    // check sort & order query
    if(isset($url['sort_by']) && isset($url['order_by'])){
        $url['sort_by'] = filter_input(INPUT_GET, 'sort_by', FILTER_SANITIZE_STRING);
        $url['order_by'] = filter_input(INPUT_GET, 'order_by', FILTER_SANITIZE_STRING);

        $path .= (isset($url['country']) || isset($url['search'])) ? "&" : "";
        $path .= "sort_by={$url['sort_by']}&order_by={$url['order_by']}";

        // check if chosen sort and order are valid fields
        $data['sort_by'] = in_array($url['sort_by'], $valid_sort) ? $url['sort_by'] : $data['sort_by'];
        $data['order_by'] = in_array($url['order_by'], $valid_order) ? $url['order_by'] : $data['order_by'];
    }

    // path without page data
    $data['nopagepath'] = count($url) > 1 ? "?$path" : "";

    // check page query
    if(isset($url['page'])){
        if(count($url) == 2) $data['nopagepath'] = "";

        $path .= count($url) > 1 ? "&" : "";
        $path .= "page={$url['page']}";

        $data['page'] = $url['page'];
    }
    $data['path'] = count($url) > 1 ? "?$path" : "";
    
    return $data;
}


/**
 * Set links for all pagination buttons
 * @param int $page current page number
 * @param int $page_count amount of pages based on limit per page
 * @param string current url without page number
 * @return array returns an array with links for every pagination button
 */
function paginationLinks($page = 1, $page_count, $query = "")
{
    // base page url
    $url = "collection";

    // first page link, which doesn't have a page data in url (no page=1)
    $first_page = $url . $query;

    // checking if other variables exist in query and adding needed characters
    $query .= (strpos($query, "=") !== FALSE) ? "&" : "?";
    $query .= "page=";

    // last page is always a max = page_count
    $last_page = $url . $query . $page_count;

    // pages before and after current page
    $previous = $url . $query . ($page-1);
    $next = $url . $query . ($page+1);

    // setting the three buttons values, middle one is current
    $first = $previous;
    $second = $url . $query . $page;
    $third = $next;

    // changing page links in special circumstances
    if($page == 1){
        $first = $first_page;
        $second = $next;
        $third = $url . $query . ($page+2);
    }elseif($page == 2){
        $first = $first_page;
        $previous = $first_page;
    }elseif($page == $page_count){
        $first = $url . $query . ($page_count-2);
        $second = $url . $query . ($page_count-1);
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


/**
 * Set values to display for first, second and third center pagination buttons
 * @param int $page current page number
 * @param int $page_count amount of pages based on limit per page
 * @return array returns an array with values to display for three pagination buttons
 */
function paginationNames($page = 1, $page_count)
{
    if($page < 3){
        return [
            'first' => 1,
            'second' => 2,
            'third' => 3
        ];
    }elseif($page == $page_count){
        return [
            'first' => ($page_count - 2),
            'second' => ($page_count - 1),
            'third' => $page_count
        ];
    }else{
        return [
            'first' => ($page - 1),
            'second' => $page,
            'third' => ($page + 1)
        ];
    }
}


/**
 * Get information about a database item wrapped in html
 * @param array $item array with data about a single item
 * @param bool $admin if user is an admin then display more data
 * @return string returns item data wrapped in html
 */
function showItem($item = [], $admin = false)
{
    $countries = include "../app/includes/countries_array.php";

    // send message with cap id in title
    if($item['unknown']){
        $link = "mailto:mykys99@gmail.com?subject=Information about cap (id: {$item['id']})";
        $item['unknown'] = "Do you know this cap? <a href='$link' target='_blank' class='badge badge-primary'>Help me out.</a>";
    }
    
    echo
    "<div class='card' style='border-radius: 0;'>
        <div class='row no-gutters d-flex flex-column align-items-center align-items-md-left flex-md-row'>
            <div class='col-auto m-1 py-1'>", 
            file_exists("media/caps/thumb/{$item['image']}.jpg") 
                ? "<img src='media/caps/thumb/{$item['image']}.jpg' class='img-thumbnail' data-toggle='modal' data-target='#cap{$item['id']}'>" 
                : "<div class='img-thumbnail text-center no-image'>no image</div>"
            ,"</div>
            <div class='col'>
                <div class='card-body'>
                    <div class='text-center text-md-left'>
                        <h4 class='card-header font-weight-bold mb-2'>",$item['unknown'] ? $item['unknown'] : $item['brand'],"</h4>
                        <a class='details_link collapsed d-inline d-md-none' style='letter-spacing: 1px;' data-toggle='collapse' href='#details{$item['id']}' role='button' aria-expanded='false' aria-controls='Details'>Details &dArr;</a>
                    </div>

                    <div class='d-md-block collapse item-details' id='details{$item['id']}'>
                        <ul class='list-group list-group-flush'>
                            <li class='list-group-item cap-text' title='{$item['text']}'>",$item['text'] ? $item['text'] : "&nbsp;","</li>
                            <!-- <li class='list-group-item'>",$item['color'] ? $item['color'] : "&nbsp;","</li> -->
                            <li class='list-group-item'>",$item['country'] ? "<a href='collection?country={$item['country']}'>{$countries[$item['country']]}</a>" : "&nbsp;","</li>
                        </ul>

                        <div class='mt-4 d-flex justify-content-between align-items-center'>
                            <div class='btn-group admin-info'>",
                                $admin ? "<span class='btn btn-sm btn-outline-secondary disabled'>#{$item['id']}</span>
                                <a class='btn btn-sm btn-outline-secondary' href='admin/edit/{$item['id']}'>Edit</a>" : ""
                            ,"</div>
                            <small class='text-muted'>{$item['created_date']}</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class='modal fade' id='cap{$item['id']}' tabindex='-1' role='dialog'>
        <div class='modal-dialog modal-dialog-centered modal-lg' role='document'>
            <div class='modal-content'>
                <div class='modal-header'>
                    <h5 class='modal-title'>{$item['brand']}</h5>
                    <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                        <span aria-hidden='true'>&times;</span>
                    </button>
                </div>
                <div class='modal-body p-0 d-flex justify-content-center'>
                    <img src='media/caps/{$item['image']}.jpg' alt='{$item['brand']}' class='img-fluid rounded-bottom'>
                </div>
            </div>
        </div>
    </div>";
}


/**
 * Generate text under results amount based on the query
 * @param array $url array containing GET data
 * @return string returns text to be shown as the subtitle
 */
function subtitle($url)
{
    // include the countries array
    $countries = include "../app/includes/countries_array.php";

    // if search results were found
    if(!empty($url['search'])) return "results found";

    // if country page is open
    if(!empty($url['country']) && isset($countries[$url['country']])) return "caps from {$countries[$url['country']]}";

    // if collection page is open
    return "caps collected";
}


/**
 * Search for similar country names and return their corresponding ISO names
 * @param string $search country name or part of it to be searched for
 * @return array array containing found countries ISO names
 */
function getCountryISO($search)
{
    // pull the countries array from a different file
    $countries = include "../app/includes/countries_array.php";

    // uppercase the first letter of the searched query
    $input = ucwords($search);

    // find all matching results
    $input = preg_quote($input, '~');
    $result = preg_grep("~$input~", $countries);

    // if any results were found then return their ISOs, otherwise put search value in array
    return count($result) ? array_keys($result) : [$search];
}