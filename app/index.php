<?php

ini_set('display_errors', 1);
include_once 'autoload.php';

$use = new Autoload(array(
    "SessionController"
));

$session = new SessionController();
$session->connect_to_db();

?>

<h1>Welcome to Bottomshelf</h1>