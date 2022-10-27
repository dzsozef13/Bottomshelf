<?php

include_once 'autoload.php';
include_files(array(
    "SessionController",
    "Console",
    "Router",
    "Routes",
    "ASD"
));

$session = new SessionController();
$session->connect_to_db();
console_log("Ready");
// premade routes are in Routes file
$router = new Router("");
//testing
$currentRouter = $router->matchFromPath($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);
echo ($_SERVER['REQUEST_URI']. $_SERVER['REQUEST_METHOD']);

// is no match, go to 404
if(isset($currentRouter)) {
    echo $currentRouter->getName();
    include $_SERVER['DOCUMENT_ROOT']."/src/view/" . $currentRouter->getName() . ".php";
}

?>