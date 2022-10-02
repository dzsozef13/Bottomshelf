<?php

spl_autoload_register(function ($class)
{include("src/controller/".$class.".php");});

$session = new SessionController();
$session->connect_to_db();

?>

<h1>Welcome to Bottomshelf</h1>