<?php

include_once $_SERVER['DOCUMENT_ROOT']."/autoload.php";
include_files(array(
    "SessionController",
    "Console",
    "Router",
    "Route"
));

$session = new SessionController();
$session->connect_to_db();
console_log("Ready");
$loginRoute = new Route("login", "/src/view/Login.php", 1, ['POST']);

echo $loginRoute->getMethods()[0];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
</head>
<body>
    <h1>Home here, only for router testing purposes for now</h1>
    <a href=""><button>go to login</button></a> 
</body>
</html> 