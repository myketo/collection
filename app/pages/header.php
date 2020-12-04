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
                            <a href='collection' class='nav-link'>Collection</a>
                            <a href='#' class="nav-link dropdown-toggle dropdown-toggle-split ml-2 pl-lg-0 ml-lg-0" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            </a>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="collection/unknown">Unknown</a>
                            </div>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="countries">Countries</a>
                    </li>
                    <li class='nav-item'>
                        <div class="btn-group">
                            <a href='admin' class='nav-link'>Admin</a>
                            <a href='#' class="nav-link dropdown-toggle dropdown-toggle-split ml-2 pl-lg-0 ml-lg-0" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            </a>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="admin/add">Add new</a>
                                <a class="dropdown-item" href="admin/activity">Activity</a>
                            </div>
                        </div>
                    </li>
                </ul>
                <form class="form-inline my-2 my-lg-0">
                    <select class="form-control mr-sm-2 mb-2 mb-md-0">
                        <option >All</option>
                        <option>Brand</option>
                        <option>Text</option>
                        <option>Colors</option>
                        <option>Country</option>
                    </select>
                    <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">
                    <button class="btn btn-secondary my-2 my-sm-0" type="submit">Search</button>
                </form>
            </div>
        </nav>

        <main role="main">