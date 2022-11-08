<?php
include_files(array(
    "Console",
    "Router",
    "UserController",
    "Post"
));

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
    <h1 >Home here, only for router testing purposes for now</h1>
    <a href="Login"><button>login</button></a>
    <br>
    <a href="Dashboard"><button>dashboard</button></a>
    <h1 class="text-3xl text-highlight-green-900 font-bold underline">
        Hello world!
    </h1>
    <p class="text-dim-white-900">aaaaaa</p>
   <a href="/createPost">test</a>

</body>
</html>