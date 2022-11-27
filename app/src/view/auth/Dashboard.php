<?php
$session = new SessionController();
$user = $session->getUser();
?>

<h1>Welcome <?php echo $user['username'] ?> this is your dashboard</h1>
<a href="UserLogout">Log out</a>