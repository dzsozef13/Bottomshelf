<?php

/**
 * Setup controllers used in view
 */
$sessionController = new SessionController();
$postController = new PostController();
$mediaController = new MediaController();
$tagsController = new TagsController();
$systemController = new SystemController();
$userController = new UserController();

if ($sessionController->getUser()['roleId'] !== 2) {
    new Router('Explore');
}
/**
 * Fetch posts
 */
$posts = $postController->fetchAll();

/**
 * Fetch System information
 */

$users = $userController->fetchAll();

?>

<!-- Explore View -->
<div class="grid grid-cols-6 gap-8 px-8 my-8 w-full">
    <div class="col-span-3">
        <h3 class="medium-headline mb-4">All Posts</h3>
        <div class="w-full h-max" id="posts">
            <?php if (empty($posts)) {
                echo '
                <div class="no-post-banner">
                    <h3 class="headline text-lg ">No posts found...</h3>
                </div>
        ';
            } else {
                /**
                 * Loop through the posts
                 * Replace placeholders with data from each post
                 * Echo out the complete template
                 */
                $postTemplatesArray = array();
                foreach ($posts as $post) {
                    $media = $mediaController->fetchMediaForPost($post->getId());
                    $indexedMediaArray = array_values($media);
                    if (isset($indexedMediaArray)) {
                        $post->setMedia($indexedMediaArray);
                    }
                    $postTemplatesArray[] =  '
                                    <a href="/SelectedPost?selectedPost=' .  $post->getId() . '">
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
                                                    <p class="post-card-user">by @<span class="text-highlight-color-900">' . $post->getAuthorName() . '</span></p>
                                                </div>
                                                <!-- Post Comment -->
                                                    ' . ($post->getLatestComment() === null ? '' : '<div class="post-card-comment-wrapper">
                                                    <div class="small-logo">
                                                        <i class="las la-smile text-background-primary-900 text-xl"></i>
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
            <div class="grid 2xl:grid-cols-4 xl:grid-cols-3 md:grid-cols-2 grid-cols-1 gap-4"> 
                ' . implode($postTemplatesArray) . '
            </div> 
            ';
            } ?>
        </div>
    </div>
    <div class="col-span-3">
        <h3 class="medium-headline mb-3">All Users</h3>
        <div class="w-full h-max" id="users">
            <?php if (empty($users)) {
                echo '
                <div class="no-post-banner">
                    <h3 class="headline text-lg ">No posts found...</h3>
                </div>
        ';
            } else {
                $userTemplatesArray = array();
                foreach ($users as $user) {
                    $userTemplatesArray[] =  '
                                    <a href="/Profile?selectedUser=' .  $user->getId() . '">
                                        <div class="user-card-container">
                                            <!-- User Image Image -->
                                            <div class="user-card-img-container">
                                                <div class="user-card-img">
                                                    <img class="img" src="' . ($user->getProfileImage() == null ? 'public/asset/images/PlaceholderProfilePicture.png' : ' data:image/*;charset=utf8;base64,' . base64_encode($user->getProfileImage())) . '" />
                                                </div>
                                            </div>
                                            <!-- User Card Body -->
                                            <div class="user-card-body">
                                                <!-- User Card Header -->
                                                <div class="post-card-header">
                                                    <h3 class="user-card-name">' . $user->getUsername() . '</h3>
                                                    <p class="user-card-email text-highlight-color-900">' . $user->getEmail() . '</p>
                                                </div>
                                                <div class="user-card-status">
                                                    <p class="font-mono text-xs text-highlight-color-900">STATUS: <span class="text-light-color-900"> ' . $user->getStatus() . '</span></p>
                                                </div>
                                            </div>
                                        </div>
                                    </a>';
                }
                echo '
            <div class="grid 2xl:grid-cols-4 xl:grid-cols-3 md:grid-cols-2 grid-cols-1 gap-4"> 
                ' . implode($userTemplatesArray) . '
            </div> 
            ';
            } ?>
        </div>
    </div>
</div>