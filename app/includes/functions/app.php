<?php


/**
 * Taking the url GET string and making an array of all parameters divided by the slash sign
 * @param string $url GET url string to be exploded into an array
 * @return array returns an array with url data taken from the GET string
 */
function parseUrl($url = ""){
    return explode('/', filter_var(rtrim($url, '/'), FILTER_SANITIZE_URL));
}


/**
 * Analyze the url data to figure out the pathing for folders and files
 * @param array $url array consisting of parsed GET data
 * @return array return information about pathing for current page
 */
function routingPath($url = [])
{
    $base = "http://" . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . "/";    // base link for the website
    $path = "pages";        // default path
    $dir = "home";          // default directory
    $file = "index.php";    // default file
    $subpage = "";          // default subpage

    // routing to the page set in the url if a directory for it exists
    if(isset($url[0]) && file_exists(__DIR__  . "/../../$path/{$url[0]}/$file")){
        $dir = $url[0];
    }

    // routing to the subpage set in the url if a file for it exists in page directory
    if(isset($url[1]) && file_exists(__DIR__ . "/../../$path/$dir/{$url[1]}.php")){
        $subpage = "{$url[1]}.php";
    }

    // returning an array with routing information
    return [
        "base" => $base,
        "path" => $path,
        "dir" => $dir,
        "file" => $file,
        "subpage" => $subpage
    ];
}


/**
 * Prepering a page title to be displayed based on current page
 * @param string current page
 * @return string title for current page
 */
function title($dir = "")
{
    // deleting file extention from the name if it exists
    $dir = str_replace(".php", "", $dir);

    // base for the title
    $title = "Bottle Caps Collection";

    // creating the title
    if($dir != "" && $dir != "home") $title = ucfirst($dir) . " | " . $title;

    // returning the title
    return $title;
}


/**
 * Extract the year-month-day date format from datetime string
 * @param string $datetime string with datetime value
 * @return string $date date extracted from datetime string in Y-m-d format
 */
function getDateFromDatetime($datetime)
{
    return date('Y-m-d', strtotime($datetime));
}


/**
 * Stop processing the code and use header function to redirect to chosen $location
 * @param string $location page or location to redirect to
 */
function headerLocation($location)
{
    // if location is set to home then redirect to website's base url
    global $path;
    $location = "home" ? $path['base'] : $location;

    header("Location: " . $location);
    die();
    exit;
}


/**
 * Return the sanitized value of url GET variable if it exists
 * @param string $variable name of the url variable
 * @return string return sanitized value of variable or empty string if variable doesn't exist
 */
function getValue($variable)
{
    return isset($_GET[$variable]) ? filter_input(INPUT_GET, $variable, FILTER_SANITIZE_STRING) : "";
}


/**
 * Check if GET variable exists and has value equal to $value, if true then return $return
 * @param string $variable name of GET variable to be checked
 * @param string $value value of GET variable to be compared
 * @param string $return value to be returned after checking
 */
function getExists($variable, $value, $return)
{
    if(isset($_GET[$variable]) && ($_GET[$variable] == $value)) return $return;
}


/**
 * Show the bootstrap alert element with chosen color and messege
 * @param string $msg messege to be shown inside the alert
 * @param string $color color of the alert
 * @param bool $die choose to die out the code or not
 */
function showAlert($msg, $color, $die = false)
{
    echo "<p class='alert-$color'>$msg</p>";

    if($die){
        include "../app/pages/footer.php";
        die();
    }
}


/**
 * Check if user is logged in
 * @return bool return true or false depending on the status
 */
function loggedIn()
{
    return isset($_SESSION['logged_in']);
}


/**
 * Logout the admin account from current session
 * @param $url current url to determine if user should be logged out
 */
function logout($url)
{
    // if GET 'page' is not set to 'logout' then return
    if($url != "logout") return;

    // otherwise unset the logged in session
    if(isset($_SESSION['logged_in'])) unset($_SESSION['logged_in']);
    
    // and redirect to home page
    headerLocation("home");
}