<!DOCTYPE html>
<html lang="en">
    <head>
        <base href="<?=$path['base']?>">
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
        <link rel="stylesheet" href="styles/style.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
        <script src='scripts/search_suggestions.js'></script>
        <title><?=$title?></title>
    </head>

    <body>
        <nav class="navbar navbar-expand-lg navbar-dark fixed-top bg-dark">
            <a class="navbar-brand" href="">Bottle Caps Collection</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarsExampleDefault">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <div class="btn-group">
                            <a href='collection' class='nav-link btn' id='nav-collection'>Collection</a>
                            <a class="nav-link btn dropdown-toggle dropdown-toggle-split ml-2 pl-lg-0 ml-lg-0" data-toggle="dropdown"></a>
                            <div class="dropdown-menu py-1">
                                <a class="dropdown-item" href="collection/unknown">Unknown</a>
                            </div>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a href="countries" class="nav-link" id='nav-countries'>Countries</a>
                    </li>
                    <li class='nav-item'>
                    <?=loggedIn() ? 
                    "<div class='btn-group admin-links'>
                        <a href='admin' class='nav-link btn' id='nav-admin'>Admin</a>
                        <a class='nav-link btn dropdown-toggle dropdown-toggle-split ml-2 pl-lg-0 ml-lg-0' data-toggle='dropdown'>
                        </a>
                        <div class='dropdown-menu py-1'>
                            <a class='dropdown-item' href='admin/add'>Add new</a>
                            <a class='dropdown-item' href='admin/activity'>Activity</a>
                        </div>
                    </div>" : "";?>
                    </li>
                </ul>
                <form method='GET' action='collection' class="form-inline my-2 my-lg-0" autocomplete="off">
                    <!-- <div class="custom-control custom-checkbox mr-sm-2">
                        <input type="checkbox" class="custom-control-input" id="exact">
                        <label class="custom-control-label text-light" for="exact">Exact</label>
                    </div> -->
                    <select name='field' class="form-control mr-sm-2 mb-2 mb-md-0">
                        <option value=''>All</option>
                        <option value='brand' <?=queryExists('field', 'brand', 'selected')?>>Brand</option>
                        <option value='text' <?=queryExists('field', 'text', 'selected')?>>Text</option>
                        <!-- <option value='color'>Color</option> -->
                        <option value='country' <?=queryExists('field', 'country', 'selected')?>>Country</option>
                    </select>
                    <div class='form-group search-container'>
                        <input class="form-control mr-sm-2" type="text" name="search" placeholder="Search" value="<?=getQueryValue('search');?>">
                        <ul class="list-group search-suggestions">
                        </ul>
                    </div>
                    <button class="btn btn-secondary my-2 my-sm-0" type="submit">Search</button>
                </form>
            </div>
        </nav>

        <main role="main">