<?php
include_files(array(
    "Console",
    "Router",
    "UserController",
    "Post"
));

// $session = new SessionController();
// $session->connect_to_db();
// console_log("Ready");
$test = new Post()

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../../public/output.css" rel="stylesheet">
    <title>Home</title>
</head>
<body>
    <h1>Home here, only for router testing purposes for now</h1>
    <a href="Login"><button>login</button></a>
    <br>
    <a href="Dashboard"><button>dashboard</button></a>
    <h1 class="text-3xl font-bold underline">
        Hello world!
    </h1>
   <p> <?php var_dump($test->getById(1)) ?></p>
</body>
</html>