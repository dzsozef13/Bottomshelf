<?php
include_once 'autoload.php';
include_files(array(
    "SessionController",
    "Console",
    "Router",
    "Routes"
));

$router = new Router();
$session = new SessionController();
$pageController = new PageController();

?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../../public/output.css" rel="stylesheet">
    <title><?php echo $router->currentRoute ?></title>
</head>