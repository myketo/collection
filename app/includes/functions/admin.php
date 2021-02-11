<?php


/**
 * Function that checks what submit was sent on edit page and performs corresponding action based on it
 * @param array $data array containing data sent through $_POST
 * @param array $item array containing information about edited cap
 * @return array returns $item with edited information
 */
function editPageFormSubmits($data, $item)
{
    // delete cap
    if(isset($data['submitDelete'])){
        $id = $item['id'];
        // delete images
        deleteImageAndThumbnail($item['image']);

        // try deleting cap
        if(deleteCap($id)){
            $msg = "Successfully deleted cap #$id! (Go to <a href='admin'>admin page</a>)";
            $color = "success";
            showAlert($msg, $color, true);
        }

        showAlert("An error occured while deleting.", "danger");

    // delete image
    }if(isset($data['deleteImage'])){
        // delete images
        deleteImageAndThumbnail($item['image']);

        $msg = "An error occured while deleting the image.";
        $color = "danger";

        // try deleting images
        if(deleteCapImage($item['id'])){
            $item['image'] = "";
            $msg = "Successfully deleted caps image!";
            $color = "success";
        }

        showAlert($msg, $color);

    // edit cap
    }if(isset($data['submitEdit'])){
        // unset unneeded variable
        unset($data['submitEdit']);

        $msg = "An error occured while editing.";
        $color = "danger";

        // if no error occured & sent form data was valid
        if(($_FILES['image']['error'] == 0 || $_FILES['image']['error'] == 4) && $data = validateCapData($data)){
            // if new image was sent
            if($_FILES['image']['error'] == 0){
                // then replace the old one
                deleteImageAndThumbnail($item['image']);
            // if no image was sent
            }else{
                // then don't change anything
                $data['image'] = $item['image'];
            }

            // show proper messege if editing was successful or not 
            if(editCap($data)){
                $item = $data;

                $msg = "Successfully edited cap data!";
                $color = "success";
            }else{
                $msg = "An error occured while editing cap info.";
                $color = "danger";
            }
        }

        showAlert($msg, $color);
    }

    // return edited $item
    return $item;
}


/**
 * Function that sanitizes an input string
 * @param string $input data sent by the user
 * @return string sanitized $input string
 */
function sanitizeInput($input)
{
    return filter_var(trim($input), FILTER_SANITIZE_STRING);
}


/**
 * Resize & rename image sent by user, create its thumbnail and save it on the server
 * @param array $file $_FILES data about the sent image
 * @return string returns new images name
 */
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


/**
 * Sanitize all of inputs sent by user about the cap info
 * @param array $data $_POST values sent by user
 * @return array return sanitized data 
 */
function validateCapData($data)
{
    // sanitize all set fields and set as null if user sent them empty
    $data['brand'] = isset($data['brand']) ? sanitizeInput($data['brand']) : "";
    $data['text'] = isset($data['text']) ? sanitizeInput($data['text']) : "";
    $data['color'] = isset($data['color']) ? sanitizeInput($data['color']) : "";    // delete if return on empty
    $data['country'] = isset($data['country']) ? sanitizeInput($data['country']) : "";
    $data['unknown'] = (int)empty($data['brand']);
    $data['image'] = uploadImageAndThumbnail($_FILES['image']);

    return $data;
}


/**
 * Find $limit amount of most recent dates on which cap was added or updated
 * @param int $limit max amount of dates to be returned
 * @return array list of found dates
 */
function recentDates($limit = 5)
{
    // sending database query
    $dates = getRecentChanges($limit);

    // preparing an array for the results
    $unique_dates = [];

    // looping through found dates
    foreach($dates as $date){
        // checking created_at field if date is not already in array and adding it
        if(!in_array($date['created_at'], $unique_dates)) array_push($unique_dates, $date['created_at']);
        // checking updated_at field if date is not already in array and if it isn't an empty field, then adding it
        if(!in_array($date['updated_at'], $unique_dates) && !is_null($date['updated_at'])) array_push($unique_dates, $date['updated_at']);
    }

    // returning found, unique dates
    return $unique_dates;
}


/**
 * Find $limit amount of actions made on all of selected $dates
 * @param array $dates array of dates to find actions for
 * @param int $limit max amount of results to be returned for each date
 * @return array array containing actions for each date in $dates
 */
function actionsOnDates($dates, $limit = 10)
{
    // preparing an array for found actions
    $actions = [];

    // looping through every date in $dates
    for($i = 0; $i < count($dates); $i++){
        // querying the database for actions on every date and pushing returned values to new $actions index
        array_push($actions, getActionsOnDate($dates[$i], $limit));
    }

    // returning array with actions
    return $actions;
}


/**
 * Function that checks if image file exists and deletes it from the server
 * @param string $img file name of image to be deleted
 */
function deleteImageAndThumbnail($img)
{
    // checking and deleting the full-sized image file
    if(file_exists("media/caps/$img.jpg")) unlink("media/caps/$img.jpg");

    // checking and deleting the thumbnail file for the base image
    if(file_exists("media/caps/thumb/$img.jpg")) unlink("media/caps/thumb/$img.jpg");
}