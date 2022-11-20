<?php
$userCtrl = new UserController();
$sessionsCtrl = new SessionController();
$user = $sessionsCtrl->getUser();
$profile = null;
if (isset($user)) {
    $profile = $userCtrl->fetchById($user['userId']);
}

?>

<p>Profile page of:</p>
<h1><?php echo $profile->username ?></h1>