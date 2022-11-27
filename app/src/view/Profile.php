<?php
$userCtrl = new UserController();
$sessionsCtrl = new SessionController();
$postController = new PostController();
$viewController = new ViewController();

$postCardTempalte = $viewController->getTemplateContent("PostCard");
$user = $sessionsCtrl->getUser();
$profile = null;
$posts = null;

if (isset($user)) {
    $profile = $userCtrl->fetchById($user['userId']);
    $posts = $postController->fetchByUserId($user['userId']);
}

?>
<div class="grid grid-cols-6 gap-4 px-8 w-full grid-flow-row min-h-screen">
    <div class="col-span-6 2xl:h-[15vh] h-[25vh] "></div>
    <div class="2xl:col-span-1 col-span-0"></div>
    <div class="2xl:col-span-4 col-span-6 ">
        <div class="profile-card">
            <div class="profile-picture">img</div>
            <div class="profile-username-container">
                <h3 class="text-4xl font-mono ">
                    <span class="text-highlight-green-900">@</span><?php echo $profile->username ?>
                </h3>
                <div class="badges-container">
                    <div class="badges-wrapper">
                        <div class="fake-badge">
                            <i class="las la-certificate text-background-black-900 text-2xl"></i>
                        </div>
                        <div class="fake-badge">
                            <i class="las la-certificate text-background-black-900 text-2xl"></i>
                        </div>
                        <div class="fake-badge">
                            <i class="las la-certificate text-background-black-900 text-2xl"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="h-auto w-full">
                <div class="profile-description-container">
                    <h4 class="text-xl uppercase mb-2 text-highlight-green-900 font-mono"> About me</h4>
                    <p><?php echo $profile->bioDescription ?></p>
                </div>
            </div>

        </div>
    </div>
    <div class="2xl:col-span-1 col-span-0"></div>
    <div class="col-span-6 profile-post-options-container">
        <a href="">
            <div class="option-chip">
                Public
            </div>
        </a>
        <a href="">
            <div class="option-chip">
                Private
            </div>
        </a>
    </div>
    <div class="col-span-6">

    </div>
</div>