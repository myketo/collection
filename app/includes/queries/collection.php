<?php

function getAllAmount()
{
    global $conn;

    $query = "SELECT COUNT(*) AS 'amount' FROM `collection`;";
    $result = mysqli_query($conn, $query);
    $data = mysqli_fetch_array($result);

    return $data['amount'];
}

function getItems($limit, $offset)
{
    global $conn;

    $query = "SELECT * FROM `collection` LIMIT ? OFFSET ?;";
    $stmt = mysqli_stmt_init($conn);
    mysqli_stmt_prepare($stmt, $query);
    mysqli_stmt_bind_param($stmt, "ii", $limit, $offset);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    $items = [];
    while($row = mysqli_fetch_array($result)){
        $row['created_date'] = getDateFromDatetime($row['created_at']);
        array_push($items, $row);
    }

    return $items;
}

function showItem($item = [], $admin = false)
{
    echo
    "<div class='card'>
        <div class='row no-gutters d-flex flex-column align-items-center align-items-md-left flex-md-row'>
            <div class='col-auto m-1 pt-3'>
                <img src='media/caps/",$item['image'],"' class='img-thumbnail' alt='",$item['brand'],"' data-toggle='modal' data-target='#cap",$item['id'],"'>
            </div>
            <div class='col'>
                <div class='card-body'>
                    <div>
                        <h5 class='card-header'>",$item['brand']," 
                            <a class='small collapsed float-right d-inline d-md-none' data-toggle='collapse' href='#details1' role='button' aria-expanded='false' aria-controls='Details'>Details &dArr;</a>
                        </h5>
                    </div>

                    <div class='d-md-block collapse' id='details1'>
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
        <div class='modal-dialog modal-lg' role='document'>
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