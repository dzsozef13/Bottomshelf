<?php

include_once 'autoload.php';
include_files(array(
    "SessionController",
    "Console"
));

$session = new SessionController();
$session->connect_to_db();
console_log("Ready");

?>

<h1>Welcome to Bottomshelf</h1>