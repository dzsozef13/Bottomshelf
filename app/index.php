<?php

include_once 'autoload.php';
include_files(array(
    "SessionController",
    "Console",
    "Router",
));

$session = new SessionController();
$session->connect_to_db();
console_log("Ready");
Router::add(new Route("home", "/src/view/Home.php", 1, ['GET']));
Router::add(new Route("login", "/src/view/Login.php", 1, ['GET']));
$router = new Router("home");
?>

<h1>Welcome to Bottomshelf</h1>
<?php print_r($router->getAll()) ?>