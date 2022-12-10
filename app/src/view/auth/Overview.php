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
<div class="grid grid-cols-6 gap-4 px-8 my-8 w-full">
    <div class="col-span-3 bg-red-900">
        <h3 class="medium-headline">All Posts</h3>

    </div>
    <div class="col-span-3">
        <h3 class="medium-headline">All Users</h3>
    </div>
</div>