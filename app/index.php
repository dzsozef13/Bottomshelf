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
    "SystemController",
    "BadgeController",
    "ColorSchemeController",
));

$router = new Router();
$session = new SessionController();
$pageController = new PageController();
$systemController = new SystemController();
$colorSchemeController = new ColorSchemeController();

$system = $systemController->fetchById(1);
$colorScheme = null;

if (isset($system) && $system->getColorSchemeId() !== null) {
    $colorScheme = $colorSchemeController->fetchById($system->getColorSchemeId());
}
?>


<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script type="application/x-javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <link href="../../public/output.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <script type="text/javascript" src="/public/js/utility.js"></script>
    <script type="application/x-javascript" src="https://cdn.jsdelivr.net/npm/suneditor@latest/dist/suneditor.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/suneditor@latest/dist/css/suneditor.min.css" rel="stylesheet">
    <title><?php echo $router->currentRoute ?></title>
    <style>
        :root {
            --highlight: <?php echo $colorScheme->getHighlight() ?>;
            --background-primary: <?php echo $colorScheme->getBackgroundPrimary() ?>;
            --background-secondary: <?php echo $colorScheme->getBackgroundSecondary() ?>;
            --background-ternary: <?php echo $colorScheme->getBackgroundTernary() ?>;
            --light: <?php echo $colorScheme->getLightColor() ?>;
        }
    </style>
</head>