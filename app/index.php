<?php

include_once 'autoload.php';
include_files(array(
    "SessionController",
    "Console",
    "Router",
    "Routes"
));

$session = new SessionController();
$session->connect_to_db();
console_log("Ready");

/**
 * Router tries to serve the current URL request
 */
$router = new Router();
$router->serveRequeset();

?>