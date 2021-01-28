<?php    
    include "../app/includes/functions/admin.php";
    include "../app/includes/queries/admin.php";

    if(!loggedIn() || !isset($_GET['id'])) headerLocation('..');

    $item = getItemById($_GET['id']);
    if(!$item) headerLocation('..');

    $item = checkFormSubmits($_POST, $item);
    $countries = include "../app/includes/countries_array.php";
?>

<div class='edit-page d-flex flex-column align-items-center'>
    <h1 class='text-center m-3'>Edit #<?=$item['id']?></h1>
    <form method='POST' enctype='multipart/form-data' class='col-md-7' id='editForm'>
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
            <label for='newCountry'>Country</label>
            <select name='country' class='form-control form-select' id='newCountry'>
            <?php
            foreach($countries as $country){
                $index = array_search($country, $countries);
                echo "<option value='$index' ",$item['country'] == $index ? 'selected' : '',">$country</option>";
            }
            ?>
            </select>
        </div>

        <div class='form-group'>
            <label for='newImage'>Image</label>

            <div class="custom-file">
                <input type="file" name='image' class="custom-file-input" id="newImage" accept='image/*'>
                <label class="custom-file-label" for="newImage">Choose file...</label>
                <div class="invalid-feedback">Example invalid custom file feedback</div>
            </div>

            <?=!empty($item['image']) ? "<input type='submit' name='deleteImage' value='Delete image' class='btn btn-outline-secondary btn-sm my-1'>" : ""?>

            <div class="col">
                <img src='media/caps/thumb/<?=$item['image']?>.jpg' id='imagePreview' alt='No image uploaded.' style='max-height: 130px;' class='mt-1'>
            </div>
        </div>

        <!-- <div class="custom-control custom-checkbox">
            <input type="checkbox" name='unknown' class="custom-control-input" id="newUnknown">
            <label class="custom-control-label" for="newUnknown">Unknown</label>
        </div> -->

        <div class='form-group text-center'>
            <input type="submit" name='submitEdit' class="btn btn-primary col mt-4" value='Submit Edit'>
        </div>

        <div class='form-group text-right p-0'>
            <input type='reset' class='btn btn-secondary mt-2' value='Reset Data'>
            <input type='submit' name='submitDelete' id='submitDelete' class='btn btn-danger mt-2' value='DELETE CAP'>
        </div>
    </form>
</div>

<script src='scripts/confirm_delete.js'></script>
<script src='scripts/image_preview.js'></script>