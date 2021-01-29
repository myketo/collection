<?php

function checkFormSubmits($data, $item)
{
    if(isset($data['submitDelete'])){
        $id = $_GET['id'];
        deleteImageAndThumbnail($id);

        if(deleteCap($id)){
            $msg = "Successfully deleted cap #$id! (Go to <a href='admin'>admin page</a>)";
            $color = "success";
            showAlert($msg, $color);
            die();
        }

        showAlert("An error occured while deleting.", "danger");
    }

    if(isset($data['deleteImage'])){
        deleteImageAndThumbnail($item['image']);

        $msg = "An error occured while deleting the image.";
        $color = "danger";

        if(deleteCapImage($_GET['id'])){
            $item['image'] = "";
            $msg = "Successfully deleted caps image!";
            $color = "success";
        }

        showAlert($msg, $color);
    }
    
    if(isset($data['submitEdit'])){
        unset($data['submitEdit']);

        $msg = "An error occured while editing.";
        $color = "danger";

        if(($_FILES['image']['error'] == 0 || $_FILES['image']['error'] == 4) && $data = verifyCapData($data)){
            if($_FILES['image']['error'] == 0){
                deleteImageAndThumbnail($item['image']);
            }else{
                $data['image'] = $item['image'];
            }

            if(editCap($data)){
                $item = $data;

                $msg = "Successfully edited cap data!";
                $color = "success";
            }
        }

        showAlert($msg, $color);
    }

    return $item;
}

function sanitizeInput($input)
{
    return filter_var(trim($input), FILTER_SANITIZE_STRING);
}

function uploadImageAndThumbnail($file)
{
    // return if no file was uploaded
    if($file['error'] == 4) return;

    // path to cap images folder
    $path = "media/caps";

    // create a random, unique name for image files
    do{
        $name = uniqid(rand(), true);
    }while(file_exists("$path/$name.jpg"));

    // names for cap image and its thumbnail
    $img = "$name.jpg";
    $thumb = "thumb/$img";

    // creating an image from uploaded file
    $image = imagecreatefromstring(file_get_contents($file['tmp_name']));
    
    // checking image sizes
    $sizes = getimagesize($file['tmp_name']);
    // if image width is more than 1280px then scale it down
    if($sizes[0] > 1280){
        // generating an image and uploading it
        $image_resized = imagescale($image, 1280);
        imagejpeg($image_resized, "$path/$img");
    // else just save the file
    }else{
        imagejpeg($image, "$path/$img");
    }

    // generating a thumbnail and uploading it
    $image = imagecreatefromjpeg("$path/$img");
    // thumbnail size is 256px by 192px
    $image_resized = imagescale($image, 256, 192);
    imagejpeg($image_resized, "$path/$thumb");

    // return added images name
    return $name;
}

function verifyCapData($data)
{
    // color was required, so return if it wasn't set
    // if(!isset($data['color']) || empty($data['color'])) return;

    // sanitize all fields or set as null if empty
    $data['brand'] = isset($data['brand']) ? sanitizeInput($data['brand']) : "";
    $data['text'] = isset($data['text']) ? sanitizeInput($data['text']) : "";
    $data['color'] = isset($data['color']) ? sanitizeInput($data['color']) : "";    // delete if return on empty
    $data['country'] = isset($data['country']) ? sanitizeInput($data['country']) : "";
    // $data['unknown'] = isset($data['unknown']) ? 1 : 0;
    $data['unknown'] = (int)empty($data['brand']);
    $data['image'] = uploadImageAndThumbnail($_FILES['image']);

    return $data;
}

function recentDates($limit = 5)
{
    $dates = getRecentChanges($limit);
    $unique_dates = [];

    foreach($dates as $date){
        if(!in_array($date['created_at'], $unique_dates)) array_push($unique_dates, $date['created_at']);
        if(!in_array($date['updated_at'], $unique_dates) && !is_null($date['updated_at'])) array_push($unique_dates, $date['updated_at']);
    }

    return $unique_dates;
}

function actionsOnDates($dates, $limit = 10)
{
    $actions = [];
    for($i = 0; $i < count($dates); $i++){
        array_push($actions, getActionsOnDate($dates[$i], $limit));
    }

    return $actions;
}

function deleteImageAndThumbnail($img)
{
    if(file_exists("media/caps/$img.jpg")) unlink("media/caps/$img.jpg");
    if(file_exists("media/caps/thumb/$img.jpg")) unlink("media/caps/thumb/$img.jpg");
}