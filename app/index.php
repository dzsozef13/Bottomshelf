<?php
include_once 'autoload.php';
include_files(array(
    "SessionController",
    "Console",
    "Router",
    "Routes"
));

$session = new SessionController();

/**
 * Router tries to serve the current URL request
 */
$router = new Router();
?>