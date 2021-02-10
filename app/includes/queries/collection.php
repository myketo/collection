<?php

/**
 * Create a query that returns an amount of all the rows
 * @param string $search search data
 * @param string $field column name
 * @param string $country country name
 * @param bool $unknown decide to count in unknown caps or not
 * @return int amount of all rows from the query
 */
function countAllRows($search = "", $field = "", $country = "", $unknown = false)
{
    // connection variable
    global $conn;

    // base query
    $query = "SELECT COUNT(*) AS 'amount' FROM `collection`";

    // show just unknown or just known caps depending on $unknown value
    $query .= " WHERE `unknown` = " . (int)$unknown;

    // if $country is set then select by its value
    if(!empty($country)) $query .= " AND `country` = '$country'";

    // if $search is set
    if(!empty($search)){
        // prepare the query for more WHERE values
        $query .= " AND ";
        
        // if $field is set
        if(!empty($field)){
            // and selected field is country
            if($field == "country"){
                // then get all the ISO names of searched countries and assign it to the $search variable
                $search = getCountryISO($search);

                // put all of the found ISO names into the query
                $i = 1;
                foreach($search as $iso){
                    $query .= "`$field` = '$iso'";
                    $query .= $i != count($search) ? " OR " : "";
                    $i++;
                }
            // for all the other fields just search using LIKE
            }elseif($field == "id"){
                // or $field is set as id
                $query .= "`$field` = $search";
            }else{
                $query .= "`$field` LIKE '%$search%'";
            }
        // if field is not set
        }else{
            // array of possible searched columns
            $columns = ['brand', 'text', 'country', 'color', 'created_at'];

            // then search all the columns for the value
            $i = 1;
            foreach($columns as $column){
                $query .= "`$column` LIKE '%$search%'";
                $query .= $i != count($columns) ? " OR " : "";
                $i++;
            }
        }
    }

    // complete the query
    $result = mysqli_query($conn, $query);

    // fetch the data and return the amount
    $data = mysqli_fetch_array($result);
    return $data['amount'];
}


/**
 * Prepare the query for database using multiple variables and return found items
 * @param string column to sort the data by (ORDER BY)
 * @param string direction for order by, either ascending (ASC) or descending (DESC)
 * @param int $limit limit of items returned by the query (LIMIT)
 * @param int $offset offset for the limit which defines the first value to be returned (OFFSET)
 * @param string $search search data
 * @param string $field column name
 * @param string $country country name
 * @param bool $unknown decide to count in unknown caps or not
 * @return array array containing $limit amount of rows found
 */
function getItems($sort_by, $order_by, $limit, $offset, $search = "", $field = "", $country = "", $unknown = false)
{
    // connection variable
    global $conn;

    // base query
    $query = "SELECT * FROM `collection`";

    // show just unknown or just known caps depending on $unknown value
    $query .= " WHERE `unknown` = " . (int)$unknown;

    // if $country is set then select by its value
    if(!empty($country)) $query .= " AND `country` = '$country'";

    // if $search is set
    if(!empty($search)){
        // preparing the query
        $query .= " AND ";

        // if $field is set
        if(!empty($field)){
            // and $field value is equal to country
            if($field == "country"){
                // then get all the ISO names of searched countries and assign it to the $search variable
                $search = getCountryISO($search);
                
                // add all found ISO names to the query
                $i = 1;
                foreach($search as $iso){
                    $query .= "`$field` = '$iso'";
                    $query .= $i != count($search) ? " OR " : "";
                    $i++;
                }
            }elseif($field == "id"){
                // or $field is set as id
                $query .= "`$field` = $search";
            }else{
                // for all of the other fields just search LIKE
                $query .= "`$field` LIKE '%$search%'";
            }
        // if field is not set
        }else{
            // available columns to search by
            $columns = ['brand', 'text', 'country', 'color', 'created_at'];

            // then search all the columns for the search value
            $i = 1;
            foreach($columns as $column){
                $query .= "`$column` LIKE '%$search%'";
                $query .= $i != count($columns) ? " OR " : "";
                $i++;
            }
        }
    }

    // set the column to order by, direction of listing found data, limit and offset
    $query .= " ORDER BY `$sort_by` $order_by LIMIT $limit OFFSET $offset;";

    // execute the prepared query
    $result = mysqli_query($conn, $query);

    // cycle through every found item
    $items = [];
    while($row = mysqli_fetch_array($result)){
        // and add a created date field based on the created_at timestamp
        $row['created_date'] = getDateFromDatetime($row['created_at']);
        array_push($items, $row);
    }

    // return found items
    return $items;
}