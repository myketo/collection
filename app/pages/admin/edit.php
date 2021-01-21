<?php    
    include "../app/includes/functions/admin.php";
    include "../app/includes/queries/admin.php";

    if(!loggedIn() || !isset($_GET['id'])) headerLocation('..');

    $item = getItemById($_GET['id']);
    if(!$item) headerLocation('..');

    if(isset($_POST['submitEdit'])){
        unset($_POST['submitEdit']);

        $msg = "An error occured while editing.";
        $color = "danger";

        if(($_FILES['image']['error'] == 0 || $_FILES['image']['error'] == 4) && $data = verifyCapData($_POST)){
            if($_FILES['image']['error'] == 0){
                if(file_exists('media/caps/' . $item['image'] . '.jpg')) unlink('media/caps/' . $item['image'] . '.jpg');
                if(file_exists('media/caps/thumb/' . $item['image'] . '.jpg')) unlink('media/caps/thumb/' . $item['image'] . '.jpg');
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
?>

<div class='edit-page d-flex flex-column align-items-center'>
    <h1 class='text-center m-2'>Edit #<?=$item['id']?></h1>
    <form method='POST' enctype='multipart/form-data' class='w-50'>
        <input type='hidden' name='id' value='<?=$item['id']?>'>
        <div class='form-group'>
            <label for='editBrand'>Brand</label>
            <input type='text' name='brand' class='form-control' id='editBrand' placeholder='Brand' value='<?=$item['brand']?>' autofocus>
        </div>

        <div class='form-group'>
            <label for='editText'>Text</label>
            <input type='text' name='text' class='form-control' id='editText' placeholder='Text' value='<?=$item['text']?>'>
        </div>

        <div class='form-group'>
            <label for='editColors'>Colors</label>
            <input type='text' name='color' class='form-control' id='editColors' placeholder='eg. czar-biał-złot' value='<?=$item['color']?>' required>
        </div>

        <div class='form-group'>
            <label for='editCountry'>Country</label>
            <input type='text' name='country' class='form-control' id='editCountry' placeholder='Country' value='<?=$item['country']?>'>
        </div>

        <div class='form-group'>
            <label for='newImage'>Image</label>

            <div class="custom-file">
                <input type="file" name='image' class="custom-file-input" id="newImage" accept='image/*'>
                <label class="custom-file-label" for="newImage">Choose file...</label>
                <div class="invalid-feedback">Example invalid custom file feedback</div>
            </div>

            <div class="col">
                <img src='media/caps/thumb/<?=$item['image']?>.jpg' id='imagePreview' alt='No image uploaded.' style='max-height: 130px;' class='mt-1'>
            </div>
        </div>

        <!-- <div class="custom-control custom-checkbox">
            <input type="checkbox" name='unknown' class="custom-control-input" id="newUnknown">
            <label class="custom-control-label" for="newUnknown">Unknown</label>
        </div> -->

        <div class='form-group text-center'>
            <input type="submit" name='submitEdit' class="btn btn-primary col mt-4" value='Submit Edit'></input>
        </div>
    </form>
</div>

<script src='scripts/image_preview.js'></script>