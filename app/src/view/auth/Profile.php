<?php
$userCtrl = new UserController();
$sessionsCtrl = new SessionController();
$postController = new PostController();
$viewController = new ViewController();
$mediaController = new MediaController();
$badgeController = new BadgeController();

$userIdParam = $sessionsCtrl->getUserProfileId();
$loggedInUserId = $sessionsCtrl->getUser()['userId'];

$profile = null;
$posts = null;
$badges = null;

if (isset($loggedInUserId)) {
    if (isset($userIdParam) && isset($_GET['selectedUser'])) {
        $profile = $userCtrl->fetchById($userIdParam);
        $posts = $postController->fetchByUserId($userIdParam);
    } else {
        $profile = $userCtrl->fetchById($loggedInUserId);
        $posts = $postController->fetchByUserId($loggedInUserId);
    }
}

if (isset($profile)) {
    $badges = $badgeController->fetchAllByUserId($profile->getId());
}


if ($profile->getStatusId() !== null && $sessionsCtrl->getUser()['roleId'] == 2 && isset($userIdParam)) {
    if ($profile->getStatusId() == 1) {
        $buttons =   '<a href="/BanUser">
                    <button class="btn-outlined mr-4">BAN USER</button>
                </a>
                <a href="/DeleteUser">
                    <button class="btn-outlined  mr-4">DELETE USER</button>
                </a>';
    } else if ($profile->getStatusId() == 2) {
        $buttons =  '<a href="/UnbanUser">
                    <button class="btn-outlined  mr-4 w-52">MAKE USER ACTIVE</button>
                </a>
                <a href="/DeleteUser">
                    <button class="btn-outlined  mr-4">DELETE USER</button>
                </a>';
    } else if ($profile->getStatusId() == 3) {
        $buttons =   '<a href="/BanUser">
                    <button class="btn-outlined mr-4">BAN USER</button>
                </a>
                <a href="/UnbanUser">
                    <button class="btn-outlined  mr-4 w-52">MAKE USER ACTIVE</button>
                </a>
                <a href="/DeleteUser">
                    <button class="btn-outlined  mr-4">DELETE USER</button>
                </a>';
    } else {
        $buttons =  '
                <a href="/UnbanUser">
                    <button class="btn-outlined  mr-4 w-52">MAKE USER ACTIVE</button>
                </a>
                  ';
    }
}
?>
<div class="grid grid-cols-6 gap-4 px-8 w-full">
    <div class="col-span-6 2xl:h-[15vh] h-[25vh] "></div>
    <div class="2xl:mx-20 mx-0 col-span-6 mb-4">

        <div class="profile-card">
            <?php
            if ($sessionsCtrl->getUser()['roleId'] == 2 & isset($userIdParam)) {
                echo '
                <div class="absolute -top-[4rem] left-56 w-max h-auto flex items-center">
                ' . $buttons  . '
                </div>
                ';
            }
            ?>
            <div class="profile-picture">
                <img class="img" src="<?php if ($profile->getProfileImage() !== null) {
                                            echo 'data:image/*;charset=utf8;base64,' . base64_encode($profile->getProfileImage());
                                        } else {
                                            echo "public/asset/images/PlaceholderProfilePicture.png";
                                        } ?>" alt="Users Profile Picture">
            </div>
            <div class="profile-username-container">
                <h3 class="text-4xl font-mono ">
                    <span class="text-highlight-color-900">@</span><?php echo $profile->username ?><br>
                    <?php if ($sessionsCtrl->getUser()['roleId'] == 2 && isset($userIdParam)) {
                        echo '<span class="text-xs">User status: ' .  $profile->getStatus() . '</span>';
                    } ?>
                </h3>
                <?php if (isset($badges)) { ?>
                    <div class="badges-container">
                        <div class="badges-wrapper">
                            <?php foreach ($badges as $badge) {
                                echo '  
                                    <div class="badge">
                                         <div class="badge-icon mb-2">
                                          ' . $badge->getBadgeIcon() . '
                                         </div>
                                         <p class="text-highlight-color-900 font-mono text-xs"> ' . $badge->getName() . ' </p>
                                    </div>
                                ';
                            } ?>

                        </div>
                    </div>
                <?php }  ?>
            </div>
            <div class="h-auto w-full">
                <div class="profile-description-container">
                    <h4 class="text-xl uppercase mb-2 text-highlight-color-900 font-mono"> About me</h4>
                    <p><?php echo $profile->bioDescription ?></p>
                </div>
            </div>

        </div>
    </div>
    <?php if (!isset($userIdParam) || $userIdParam == $loggedInUserId || $sessionsCtrl->getUser()['roleId'] == 2) { ?>
        <div class="2xl:mx-20 mx-0 col-span-6 profile-post-options-container">
            <div class="option-chip" id="all">
                All
            </div>
            <div class="option-chip" id="public">
                Public
            </div>
            <div class="option-chip" id="private">
                Private
            </div>
        </div>
    <?php }  ?>
    <div class="2xl:mx-20 mx-0 col-span-6 mb-8">
        <?php
        if (empty($posts)) {
            echo '
                <div class="no-post-banner">
                    <h3 class="headline text-lg mb-6">You have not created any posts yet...</h3>
                    <div class="btn-green">
                        <a href="/Upload">
                            <button>CREATE A POST</button>
                        </a>
                    </div>
                </div>
        ';
        } else {
            $postTemplatesArray = array();
            foreach ($posts as $post) {
                $media = $mediaController->fetchMediaForPost($post->getId());
                $indexedMediaArray = array_values($media);
                if (isset($indexedMediaArray)) {
                    $post->setMedia($indexedMediaArray);
                }
                if (!isset($userIdParam) || $userIdParam == $loggedInUserId || $sessionsCtrl->getUser()['roleId'] == 2) {
                    $postTemplatesArray[] =  '
                    <a class="' . ($post->getIsPublic() ? "public" : "private") .  '" href="/SelectedPost?selectedPost=' .  $post->getId() . '">
                        <div class="post-card-container">
                            <!-- Post Image -->
                            ' . ($post->getCoverImageForPost() === null ? '' : '<div class="post-card-img">
                                    <img class="img" src="data:image/*;charset=utf8;base64,' . base64_encode($post->getCoverImageForPost()) . '" />
                                </div>') . '
                            <!-- Post Body -->
                                <div class="' . ($post->getCoverImageForPost() === null ? 'post-card-no-img-body' : 'post-card-body') . ' ">
                                <!-- Post Header -->
                                <div class="post-card-header mb-4">
                                    <h3 class="post-card-title">' . $post->getTitle() . '</h3>
                                    <p class="post-card-user">by @<span class="text-highlight-color-900">' . $post->getAuthorName() . '</span></p>
                                    ' . ($post->getCoverImageForPost() === null ? '
                                    <div class="h-44 w-full mt-2 overflow-hidden border-dashed">
                                        ' . htmlspecialchars_decode($post->getDescription())  . '
                                    </div>
                                    ' : '') . '
                                </div>
                            
                                <!-- Post Comment -->
                                    ' . ($post->getLatestComment() === null ? '' : '
                                    <div class="post-card-comment-wrapper">
                                        <div class="small-logo">
                                            <i class="las la-smile text-background-primary-900 text-xl"></i>
                                        </div>
                                    <div class="text-sm text-light-color-900/60">
                                    „ ' . $post->getLatestComment() . ' “
                                    </div>
                                </div>') . '
                                <!-- Post Reactions -->
                                <div class="w-full h-auto flex gap-4 justify-between">
                                    <div class="h-4 w-auto flex items-center text-sm "><i class="las la-heart"></i>
                                        <p class="ml-2">' . ($post->getReactionCount() ? $post->getReactionCount() : 0) . '</p>
                                    </div>
                                    <div class="h-4 w-auto flex items-center text-sm"><i class="las la-comment"></i>
                                        <p class="ml-2">' . ($post->getCommentCount() ? $post->getCommentCount() : 0) . '</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>';
                } else {
                    if ($post->getIsPublic() == true) {
                        $postTemplatesArray[] =  '
                        <a class="' . ($post->getIsPublic() ? "public" : "private") .  '" href="/SelectedPost?selectedPost=' .  $post->getId() . '">
                            <div class="post-card-container">
                                <!-- Post Image -->
                                ' . ($post->getCoverImageForPost() === null ? '' : '<div class="post-card-img">
                                        <img class="img" src="data:image/*;charset=utf8;base64,' . base64_encode($post->getCoverImageForPost()) . '" />
                                    </div>') . '
                                <!-- Post Body -->
                                    <div class="' . ($post->getCoverImageForPost() === null ? 'post-card-no-img-body' : 'post-card-body') . ' ">
                                    <!-- Post Header -->
                                    <div class="post-card-header mb-4">
                                        <h3 class="post-card-title">' . $post->getTitle() . '</h3>
                                        <p class="post-card-user">by @<span class="text-highlight-color-900">' . $post->getAuthorName() . '</span></p>
                                        ' . ($post->getCoverImageForPost() === null ? '
                                        <div class="h-44 w-full mt-2 overflow-hidden border-dashed">
                                            ' . htmlspecialchars_decode($post->getDescription())  . '
                                        </div>
                                        ' : '') . '
                                    </div>
                                
                                    <!-- Post Comment -->
                                        ' . ($post->getLatestComment() === null ? '' : '
                                        <div class="post-card-comment-wrapper">
                                            <div class="small-logo">
                                                <i class="las la-smile text-background-primary-900 text-xl"></i>
                                            </div>
                                        <div class="text-sm text-light-color-900/60">
                                        „ ' . $post->getLatestComment() . ' “
                                        </div>
                                    </div>') . '
                                    <!-- Post Reactions -->
                                    <div class="w-full h-auto flex gap-4 justify-between">
                                        <div class="h-4 w-auto flex items-center text-sm "><i class="las la-heart"></i>
                                            <p class="ml-2">' . ($post->getReactionCount() ? $post->getReactionCount() : 0) . '</p>
                                        </div>
                                        <div class="h-4 w-auto flex items-center text-sm"><i class="las la-comment"></i>
                                            <p class="ml-2">' . ($post->getCommentCount() ? $post->getCommentCount() : 0) . '</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>';
                    }
                }
            }
            echo '
            <div class="grid 2xl:grid-cols-5 xl:grid-cols-3 md:grid-cols-2 grid-cols-1 gap-4"> 
                ' . implode($postTemplatesArray) . '
            </div> 
            ';
        }
        ?>
    </div>

</div>