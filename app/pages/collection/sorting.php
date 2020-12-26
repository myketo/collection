<?php
    function queryExists($name, $value, $return)
    {
        if(isset($_GET[$name]) && ($_GET[$name] == $value)){
            return $return;
        }
    }
?>

<div class='container collapse' id='sortForm'>
    <form method='GET' class='shadow p-3 m-1 d-flex flex-column align-items-center'>
        <?=!empty($url['search']) ? "<input type='hidden' name='search' value='". getQueryValue('search') ."'>" : ""?>
        <div class='form-row'>
            <label for='sort_by' class='col-sm-0 col-form-label col-form-label-sm'>Sort by: </label>
            <div class='form-group col-sm-0'>
                <select class='form-control form-control-sm' id='sort_by' name='sort_by'>
                    <option value='date' <?=queryExists('sort_by', 'created_at', 'selected')?>>Date</option>
                    <option value='brand' <?=queryExists('sort_by', 'brand', 'selected')?>>Brand</option>
                    <option value='text' <?=queryExists('sort_by', 'text', 'selected')?>>Text</option>
                    <option value='color' <?=queryExists('sort_by', 'color', 'selected')?>>Color</option>
                    <option value='country' <?=queryExists('sort_by', 'country', 'selected')?>>Country</option>
                </select>
            </div>
        </div>

        <div class='form-row'>
            <label class='col-sm-0 col-form-label col-form-label-sm'>Order by: </label>
            <div class='form-group col-sm-0'>
                <div class="custom-control custom-radio">
                    <input type='radio' id='asc' name='order_by' value='asc' class='custom-control-input' <?=queryExists('order_by', 'asc', 'checked')?>>
                    <label class='custom-control-label order-by-asc' for='asc'>Oldest</label>
                </div>
                <div class="custom-control custom-radio">
                    <input type='radio' id='desc' name='order_by' value='desc' class='custom-control-input' <?=queryExists('order_by', 'desc', 'checked')?>>
                    <label class='custom-control-label order-by-desc' for='desc'>Newest</label>
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-primary btn-sm w-50 col-lg-3">Sort</button>
    </form>
</div>