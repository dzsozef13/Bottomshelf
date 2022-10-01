<?php require_once("src/SessionController.php"); ?>

<?php
$session = new SessionController();
if ($session->connect_to_db()) {
    echo "YAY, we have a database *_*";
} else {
    echo "Ouch, something went wrong :c";
}
?>

<h1>Welcome to Bottomshelf</h1>