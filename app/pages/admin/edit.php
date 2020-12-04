<div class='add-new-page d-flex flex-column align-items-center justify-content-center'>
    <h1 class='text-center m-2'>Edit #500</h1>
    <form class='w-50'>
        <div class='form-group'>
            <label for='newBrand'>Brand</label>
            <input type='text' class='form-control' id='newBrand' placeholder='Brand' autofocus value='Brand'>
        </div>

        <div class='form-group'>
            <label for='newText'>Text</label>
            <input type='text' class='form-control' id='newText' placeholder='Text' value='Text'>
        </div>

        <div class='form-group'>
            <label for='newColors'>Colors</label>
            <input type='text' class='form-control' id='newColors' placeholder='eg. czar-biał-złot' required value='kolor-kolor-kolor'>
        </div>

        <div class='form-group'>
            <label for='newCountry'>Country</label>
            <input type='text' class='form-control' id='newCountry' placeholder='Country' value='Country'>
        </div>

        <div class='form-group'>
            <label for='newImage'>Image</label>
            <div class="custom-file">
                <input type="file" class="custom-file-input" id="newImage" accept='image/*'>
                <label class="custom-file-label" for="newImage">file.jpg</label>
                <div class="invalid-feedback">Example invalid custom file feedback</div>
            </div>
            <img id='imagePreview' alt='No image uploaded.' style='max-height: 130px;' class='mt-1'>
        </div>

        <div class="custom-control custom-checkbox">
            <input type="checkbox" class="custom-control-input" id="newUnknown" checked>
            <label class="custom-control-label" for="newUnknown">Unknown</label>
        </div>

        <div class='form-group text-center'>
            <button type="submit" class="btn btn-primary col mt-4">Submit Edit</button>
        </div>
    </form>
</div>

<script src='scripts/image_preview.js'></script>