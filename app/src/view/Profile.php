<?php
$userCtrl = new UserController();
$sessionsCtrl = new SessionController();
$user = $sessionsCtrl->getUser();
$profile = null;
if (isset($user)) {
    $profile = $userCtrl->fetchById($user['userId']);
}

?>

<div class="grid grid-cols-6 gap-4 px-8 w-full grid-flow-row ">
    <div class="col-span-6 h-[25vh]"></div>
    <div class="col-span-6">
        <div class="bg-background-secondary-900 w-full h-40 rounded relative">
            <div class=" w-40 h-40 bg-background-ternary-900 rounded absolute -top-20 left-10">img</div>
            <h3><?php echo $profile->username ?></h3>
        </div>
    </div>
</div>