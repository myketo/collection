<?php
    include "../app/includes/functions/admin.php";
    include "../app/includes/queries/admin.php";

    if(!loggedIn()) headerLocation('..');

    if(isset($_POST['submitAdd'])){
        unset($_POST['submitAdd']);
        
        $msg = "Please make sure to fill all the required fields.";
        $color = "danger";

        if(($data = verifyCapData($_POST)) && addNewCap($data)){
            $msg = "Successfully added a new cap to the collection!";
            $color = "success";
        }

        showAlert($msg, $color);
    }

    $countries = include "../app/includes/countries_array.php";
?>

<div class='subpage add-new-page d-flex flex-column align-items-center'>
    <h1 class='text-center m-2'>Add new cap</h1>
    <form method='POST' enctype='multipart/form-data' class='col-md-7'>
        <div class='form-group'>
            <label for='newBrand'>Brand</label>
            <input type='text' name='brand' class='form-control' id='newBrand' placeholder='Brand' autofocus>
        </div>

        <div class='form-group'>
            <label for='newText'>Text</label>
            <input type='text' name='text' class='form-control' id='newText' placeholder='Text'>
        </div>

        <div class='form-group'>
            <label for='newColors'>Colors</label>
            <input type='text' name='color' class='form-control' id='newColors' placeholder='eg. czar-biał-złot' required>
        </div>

        <div class='form-group'>
            <label for='newCountry'>Country </label>
            <label for='disable_country' class='ml-3 small'> <input type='checkbox' id='disable_country'> unknown</label>
            <select name='country' class='form-control form-select' id='newCountry'>
            <?php
            foreach($countries as $country){
                echo "<option value='",array_search($country, $countries),"' ",$country == "Poland" ? 'selected' : '',">$country</option>";
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
            <img id='imagePreview' alt='No image uploaded.' style='max-height: 130px;' class='mt-1'>
        </div>

        <!-- <div class="custom-control custom-checkbox">
            <input type="checkbox" name='unknown' class="custom-control-input" id="newUnknown">
            <label class="custom-control-label" for="newUnknown">Unknown</label>
        </div> -->

        <div class='form-group text-center'>
            <input type="submit" name='submitAdd' class="btn btn-primary col mt-4" value='Submit Add'>
        </div>

        <div class='form-group text-right p-0'>
            <input type='reset' class='btn btn-secondary mt-2' value='Reset Data'>
        </div>
    </form>
</div>

<script src='scripts/image_preview.js'></script>
<script src='scripts/disable_country.js'></script>