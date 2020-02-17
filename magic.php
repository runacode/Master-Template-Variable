<?php
include_once('pixelcode/pixelconstants.php');
$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

switch ($path) {




    case '/resources/js/kvalidator2.js':
          header('Content-Type: application/javascript');
        require_once (dirname(__FILE__) . "/resources/js/kvalidator.js.php");
        break;
    default :
        header("HTTP/1.0 404 Not Found");

        exit;
        break;

}

?>

