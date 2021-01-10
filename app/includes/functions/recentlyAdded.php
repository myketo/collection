<?php

function showRecentlyAdded($item = [], $admin = false)
{
    // send message with cap id in title
    if($item['unknown']) $item['unknown'] = "Do you know this cap? <a href='#' class='badge badge-primary'>Help me out.</a>";

    echo 
    "<div class='col-md-4 recent-cap'>
        <div class='card mb-4 shadow-sm'>",
            file_exists("media/caps/{$item['image']}") 
            ? "<img src='media/caps/{$item['image']}' class='img' data-toggle='modal' data-target='#cap{$item['id']}'>" 
            : "<div class='img text-center no-image'>no image</div>"
            ,"<div class='card-body p-2 p-lg-3'>
                <h5 class='card-header'>",$item['unknown'] ? $item['unknown'] : $item['brand'],"</h5>
                <ul class='list-group list-group-flush'>
                    <li class='list-group-item recent-text' title='",$item['text'],"'>",$item['text'],"</li>
                    <li class='list-group-item'>",$item['color'],"</li>
                    <li class='list-group-item'>",$item['country'],"</li>
                </ul>

                <div class='mt-4 d-flex justify-content-between align-items-center px-2'>
                    <div class='btn-group admin-info'>",
                        $admin ? "<span class='btn btn-sm btn-outline-secondary disabled'>#".$item['id']."</span>
                        <button type='button' class='btn btn-sm btn-outline-secondary'>Edit</button>" : ""
                    ,"</div>
                    <small class='text-muted'>",$item['created_date'],"</small>
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