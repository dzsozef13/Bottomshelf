<?php
$userCtrl = new UserController();
$sessionsCtrl = new SessionController();
$postController = new PostController();
$viewController = new ViewController();
$mediaController = new MediaController();

$userIdParam = $sessionsCtrl->getUserProfileId();
$loggedInUserId = $sessionsCtrl->getUser()['userId'];
$profile = null;
$posts = null;

if (isset($loggedInUserId)) {
    if (isset($userIdParam)) {
        $profile = $userCtrl->fetchById($userIdParam);
        $posts = $postController->fetchByUserId($userIdParam);
    } else {
        $profile = $userCtrl->fetchById($loggedInUserId);
        $posts = $postController->fetchByUserId($loggedInUserId);
    }
}

?>
<div class="grid grid-cols-6 gap-4 px-8 w-full">
    <div class="col-span-6 2xl:h-[15vh] h-[25vh] "></div>
    <div class="2xl:mx-20 mx-0 col-span-6 mb-4">
        <div class="profile-card">
            <div class="profile-picture">
                <img class="img" src="<?php if ($profile->getProfileImage() !== null) {
                                            echo $profile->getProfileImage();
                                        } else {
                                            echo "public/asset/images/PlaceholderProfilePicture.png";
                                        } ?>" alt="Users Profile Picture">
            </div>
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
    <div class="2xl:mx-20 mx-0 col-span-6 mb-8">
        <?php
        if (empty($posts)) {
            echo '
                <div class="no-post-banner">
                    <h3 class="headline text-lg mb-6">You have not created any posts yet...</h3>
                    <div class="btn-green">
                        <button>CREATE A POST</button>
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
                $postTemplatesArray[] =  '
                        <a class="' . ($post->getIsPublic() ? "public" : "private") .  '" href="/SelectedPost?selectedPost=' .  $post->getId() . '">
                            <div class="post-card-container">
                                <!-- Post Image -->
                                ' . ($post->getCoverImageForPost() === null ? '' : '<div class="post-card-img">
                                        <img class="img" src="data:image/*;charset=utf8;base64,' . base64_encode($post->getCoverImageForPost()) . '" />
                                    </div>') . '
                                <!-- Post Body -->
                                <div class="post-card-body">
                                    <!-- Post Header -->
                                    <div class="post-card-header">
                                        <h3 class="post-card-title">' . $post->getTitle() . '</h3>
                                        <p class="post-card-user">by @<span class="text-highlight-green-900">' . $post->getAuthorName() . '</span></p>
                                    </div>
                                    <!-- Post Comment -->
                                        ' . ($post->getLatestComment() === null ? '' : '<div class="post-card-comment-wrapper">
                                        <div class="small-logo">
                                            <i class="las la-smile text-background-black-900 text-xl"></i>
                                        </div>
                                        <div class="post-card-comment">
                                        ' . $post->getLatestComment() . '
                                        </div>
                                    </div>') . '
                                    <!-- Post Reactions -->
                                    <div class="post-card-reactions-wrapper">
                                        🌸 ✅ 👀
                                    </div>
                                </div>
                            </div>
                        </a>';
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