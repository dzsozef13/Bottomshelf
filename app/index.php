<?php
include_once 'autoload.php';
include_files(array(
    "SessionController",
    "Console",
    "Router",
    "Routes",
    "TagsController",
    "CommentController",
    "CountryController",
));

$router = new Router();
$session = new SessionController();
$pageController = new PageController();

?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script type="application/x-javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <link href="../../public/output.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <script type="text/javascript" src="/public/js/utility.js"></script>
    <title><?php echo $router->currentRoute ?></title>

</head>