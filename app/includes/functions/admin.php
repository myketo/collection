<?php

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
    if(!isset($data['color']) || empty($data['color'])) return;

    // sanitize all fields or set as null if empty
    $data['brand'] = isset($data['brand']) ? sanitizeInput($data['brand']) : "";
    $data['text'] = isset($data['text']) ? sanitizeInput($data['text']) : "";
    $data['country'] = isset($data['country']) ? sanitizeInput($data['country']) : "";
    // $data['unknown'] = isset($data['unknown']) ? 1 : 0;
    $data['unknown'] = (int)empty($data['brand']);
    $data['image'] = uploadImageAndThumbnail($_FILES['image']);

    return $data;
}