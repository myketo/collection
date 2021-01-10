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
    $count = ceil($caps_count / $limit);

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
    $valid_sort = ["brand", "text", "color", "country"];
    $valid_order = ["asc", "desc"];

    // setting default values
    $path = "";
    $data = [
        'country' => '',
        'search' => '',
        'sort_by' => 'id',
        'order_by' => 'desc',
        'page' => 1
    ];

    // check country query (if search isn't set)
    if(isset($url['country']) && !isset($url['search'])){
        $url['country'] = filter_input(INPUT_GET, 'country', FILTER_SANITIZE_STRING);
        if(empty($url['country'])) headerLocation('colleciton');
        $path .= "country={$url['country']}";
        $data['country'] = $url['country'];
    }

    // check search query (if country isn't set)
    if(isset($url['search']) && !isset($url['country'])){
        $url['search'] = filter_input(INPUT_GET, 'search', FILTER_SANITIZE_STRING);
        if(empty($url['search'])) headerLocation("collection");
        $path .= "search={$url['search']}";
        $data['search'] = $url['search'];
    }

    // check sort & order query
    if(isset($url['sort_by']) && isset($url['order_by'])){
        $url['sort_by'] = filter_input(INPUT_GET, 'sort_by', FILTER_SANITIZE_STRING);
        $url['order_by'] = filter_input(INPUT_GET, 'order_by', FILTER_SANITIZE_STRING);

        $path .= (isset($url['country']) || isset($url['search'])) ? "&" : "";
        $path .= "sort_by={$url['sort_by']}&order_by={$url['order_by']}";

        $data['sort_by'] = in_array($url['sort_by'], $valid_sort) ? $url['sort_by'] : "id";
        $data['order_by'] = in_array($url['order_by'], $valid_order) ? $url['order_by'] : "desc";
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
 * Set values to display for  first, second and third center pagination buttons
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
    // send message with cap id in title
    if($item['unknown']) $item['unknown'] = "Do you know this cap? <a href='#' class='badge badge-primary'>Help me out.</a>";
    
    echo
    "<div class='card'>
        <div class='row no-gutters d-flex flex-column align-items-center align-items-md-left flex-md-row'>
            <div class='col-auto m-1 pt-3'>", 
            file_exists("media/caps/{$item['image']}") 
                ? "<img src='media/caps/{$item['image']}' class='img-thumbnail' data-toggle='modal' data-target='#cap{$item['id']}'>" 
                : "<div class='img-thumbnail text-center no-image'>no image</div>"
            ,"</div>
            <div class='col'>
                <div class='card-body'>
                    <div>
                        <h5 class='card-header'>",$item['unknown'] ? $item['unknown'] : $item['brand']," 
                            <a class='details_link small collapsed float-right d-inline d-md-none' data-toggle='collapse' href='#details",$item['id'],"' role='button' aria-expanded='false' aria-controls='Details'>Details &dArr;</a>
                        </h5>
                    </div>

                    <div class='d-md-block collapse item-details' id='details",$item['id'],"'>
                        <ul class='list-group list-group-flush'>
                            <li class='list-group-item cap-text' title='",$item['text'],"'>",$item['text'],"</li>
                            <li class='list-group-item'>",$item['color'],"</li>
                            <li class='list-group-item'>",$item['country'],"</li>
                        </ul>

                        <div class='mt-4 d-flex justify-content-between align-items-center'>
                            <div class='btn-group admin-info'>",
                                $admin ? "<span class='btn btn-sm btn-outline-secondary disabled'>#".$item['id']."</span>
                                <button type='button' class='btn btn-sm btn-outline-secondary'>Edit</button>" : ""
                            ,"</div>
                            <small class='text-muted'>",$item['created_date'],"</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class='modal fade' id='cap",$item['id'],"' tabindex='-1' role='dialog'>
        <div class='modal-dialog modal-dialog-centered modal-lg' role='document'>
            <div class='modal-content'>
                <div class='modal-header'>
                    <h5 class='modal-title'>",$item['brand'],"</h5>
                    <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                        <span aria-hidden='true'>&times;</span>
                    </button>
                </div>
                <div class='modal-body p-0 d-flex justify-content-center'>
                    <img src='media/caps/",$item['image'],"' alt='",$item['brand'],"' class='img-fluid rounded-bottom'>
                </div>
            </div>
        </div>
    </div>";
}

