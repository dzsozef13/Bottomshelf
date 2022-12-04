<?php

/**
 * Media controller
 */
$sessionController = new SessionController();

/**
 * Media controller
 */
$mediaController = new MediaController();

/**
 * Fetch all posts
 */
$postController = new PostController();

$postId = $sessionController->getSelectedPostId();
$post = $postController->fetchById($postId);

$media = $mediaController->fetchMediaForPost($post->getId());

$indexedMediaArray = array_values($media);
if (isset($indexedMediaArray)) {
    $post->setMedia($indexedMediaArray);
}
?>

<div class="grid grid-cols-6 px-16 my-8 w-full">
    <div class="col-span-6">
        <div class="post-preview-container">

            <div class="post-preview-img-container"></div>


        </div>
    </div>
</div>