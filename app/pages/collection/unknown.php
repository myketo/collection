<div class="collection-page d-flex flex-column">
    <h1 class='display-1 text-center'>11</h1>

    <!-- <div class='col d-flex justify-content-end mr-1'>
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
    </div> -->

    <nav class='d-flex justify-content-center mt-3'>
        <ul class="pagination">
            <li class="page-item"><a class="page-link" href="#">First</a></li>
            <li class="page-item">
                <a class="page-link" href="#" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                    <span class="sr-only">Previous</span>
                </a>
            </li>
            <li class="page-item"><a class="page-link" href="#">1</a></li>
            <li class="page-item"><a class="page-link" href="#">2</a></li>
            <li class="page-item"><a class="page-link" href="#">3</a></li>
            <li class="page-item">
                <a class="page-link" href="#" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                    <span class="sr-only">Next</span>
                </a>
            </li>
            <li class="page-item"><a class="page-link" href="#">Last</a></li>
        </ul>
    </nav>

    <div class="card">
        <div class="row no-gutters d-flex flex-column align-items-center align-items-md-left flex-md-row">
            <div class="col-auto m-1 pt-3">
                <div class='img-thumbnail text-center no-image'>no image</div>
            </div>
            <div class="col">
                <div class="card-body">
                    <div>
                        <!-- send message with cap id in title -->
                        <h5 class="card-header">Do you know this cap? <a href='#' class='badge badge-primary'>Help me out.</a> 
                            <a class='small collapsed float-right d-inline d-md-none' data-toggle='collapse' href='#details1' role='button' aria-expanded="false" aria-controls="Details">Details &dArr;</a>
                        </h5>
                    </div>

                    <div class='d-md-block collapse' id='details1'>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">'NAPIS'</li>
                            <li class="list-group-item">kolor-kolor-kolor</li>
                            <li class="list-group-item">unknown</li>
                        </ul>

                        <div class="mt-4 d-flex justify-content-between align-items-center">
                            <div class="btn-group">
                                <span class='btn btn-sm btn-outline-secondary disabled'>#500</span>
                                <button type="button" class="btn btn-sm btn-outline-secondary">Edit</button>
                            </div>
                            <small class="text-muted">12-11-2020</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- <div class="card-footer w-100 text-muted">
            Footer stating cats are CUTE little animals
        </div> -->
    </div>

    <div class='modal fade' id='cap1' tabindex='-1' role='dialog' aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class='modal-dialog modal-lg' role='document'>
            <div class='modal-content'>
                <div class='modal-header'>
                    <h5 class='modal-title'>Marka</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class='modal-body p-0 d-flex justify-content-center'>
                    <img src='//placehold.it/1000x1000' class='img-fluid rounded-bottom'>
                </div>
            </div>
        </div>
    </div>

    <!-- <div class="card">
        <div class="row no-gutters d-flex flex-column align-items-center align-items-md-left flex-md-row">
            <div class="col-auto m-1 pt-3">
                <img src="//placehold.it/240x200" class="img-thumbnail" alt="">
            </div>
            <div class="col">
                <div class="card-body">
                    <div>
                        <h5 class="card-header">Marka 
                            <a href='#' class='small float-right d-inline d-md-none' data-toggle='collapse' role='button' data-target='#details1'>Details &dArr;</a>
                        </h5>
                    </div>

                    <div class='collapse d-md-block' id='details1'>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">'NAPIS'</li>
                            <li class="list-group-item">kolor-kolor-kolor</li>
                            <li class="list-group-item">Kraj</li>
                        </ul>

                        <div class="mt-4 d-flex justify-content-between align-items-center">
                            <div class="btn-group">
                                <span class='btn btn-sm btn-outline-secondary disabled'>#500</span>
                                <button type="button" class="btn btn-sm btn-outline-secondary">Edit</button>
                            </div>
                            <small class="text-muted">12-11-2020</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> -->

    <nav class='d-flex justify-content-center mt-3'>
        <ul class="pagination">
            <li class="page-item"><a class="page-link" href="#">First</a></li>
            <li class="page-item">
                <a class="page-link" href="#" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                    <span class="sr-only">Previous</span>
                </a>
            </li>
            <li class="page-item"><a class="page-link" href="#">1</a></li>
            <li class="page-item"><a class="page-link" href="#">2</a></li>
            <li class="page-item"><a class="page-link" href="#">3</a></li>
            <li class="page-item">
                <a class="page-link" href="#" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                    <span class="sr-only">Next</span>
                </a>
            </li>
            <li class="page-item"><a class="page-link" href="#">Last</a></li>
        </ul>
    </nav>

    <script>
        $('#details1').on('show.bs.collapse', function() {
            details = $(this).prev().first().find("a");
            details.html("Details &uArr;");
        });

        $('#details1').on('hide.bs.collapse', function() {
            details = $(this).prev().first().find("a");
            details.html("Details &dArr;");
        });
    </script>
</div>