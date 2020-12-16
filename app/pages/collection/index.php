<?php include "../app/includes/queries/collection.php"; ?>

<link rel='stylesheet' href='styles/collection.css'></link>
<div class="collection-page d-flex flex-column">
    <h1 class='display-1 text-center'><?=getAllAmount();?></h1>

    <div class='col d-flex justify-content-end mr-1'>
        <a class='btn btn-primary w-25 col-lg-2' data-toggle='collapse' href='#sortForm' role='button' aria-expanded="false" aria-controls="collapseExample">Sorting</a>
    </div>

    <div class='container collapse' id='sortForm'>
        <form class='shadow p-3 m-1 d-flex flex-column align-items-center'>
            <div class='form-row'>
                <label for='sort_by' class='col-sm-0 col-form-label col-form-label-sm'>Sort by: </label>
                <div class='form-group col-sm-0'>
                    <select class='form-control form-control-sm' id='sort_by'>
                        <option>Date</option>
                        <option>Brand</option>
                        <option>Text</option>
                        <option>Colors</option>
                        <option>Country</option>
                    </select>
                </div>
            </div>

            <div class='form-row'>
                <label class='col-sm-0 col-form-label col-form-label-sm'>Order by: </label>
                <div class='form-group col-sm-0'>
                    <div class="custom-control custom-radio">
                        <input type='radio' id='asc' name='order_by' class='custom-control-input'>
                        <label class='custom-control-label' for='asc'>Oldest</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input type='radio' id='desc' name='order_by' class='custom-control-input'>
                        <label class='custom-control-label' for='desc'>Newest</label>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-primary btn-sm w-50 col-lg-3">Sort</button>
        </form>
    </div>

    <?php
        include "pagination.php";
        
        $limit = 10;
        $offset = 0;
        $items = getItems($limit, $offset);
        foreach($items as $item) showItem($item, true);

        include "pagination.php";
    ?>

    <script src='scripts/show_details.js'></script>
</div>