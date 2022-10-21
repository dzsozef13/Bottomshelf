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
Router::add(new Route("getHomePage", "/", 1, ['GET']));
Router::add(new Route("getLoginPage", "/login", 1, ['GET']));
Router::add(new Route("getUserById", "/user/{id}", 1, ['GET']));
$router = new Router("getHomePage");
?>

<h1>Welcome to Bottomshelf</h1>
<?php var_dump($router->getAll()) ?>