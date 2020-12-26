<div class='container collapse' id='sortForm'>
    <form method='GET' class='shadow p-3 m-1 d-flex flex-column align-items-center'>
        <?=!empty($url['search']) ? "<input type='hidden' name='search' value='{$url['search']}'>" : ""?>
        <div class='form-row'>
            <label for='sort_by' class='col-sm-0 col-form-label col-form-label-sm'>Sort by: </label>
            <div class='form-group col-sm-0'>
                <select class='form-control form-control-sm' id='sort_by' name='sort_by'>
                    <option value='date'>Date</option>
                    <option value='brand'>Brand</option>
                    <option value='text'>Text</option>
                    <option value='colors'>Colors</option>
                    <option value='country'>Country</option>
                </select>
            </div>
        </div>

        <div class='form-row'>
            <label class='col-sm-0 col-form-label col-form-label-sm'>Order by: </label>
            <div class='form-group col-sm-0'>
                <div class="custom-control custom-radio">
                    <input type='radio' id='asc' name='order_by' value='asc' class='custom-control-input'>
                    <label class='custom-control-label' for='asc'>Oldest</label>
                </div>
                <div class="custom-control custom-radio">
                    <input type='radio' id='desc' name='order_by' value='desc' class='custom-control-input' checked>
                    <label class='custom-control-label' for='desc'>Newest</label>
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-primary btn-sm w-50 col-lg-3">Sort</button>
    </form>
</div>