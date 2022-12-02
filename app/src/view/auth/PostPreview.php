<?php

/**
 * Media controller
 */
$mediaController = new MediaController();

/**
 * Fetch all posts
 */
$postController = new PostController();
$posts = $postController->fetchAll();
$postTemplatesArray = array();

foreach ($posts as $post) {
    $media = $mediaController->fetchMediaForPost($post->getId());
    $indexedMediaArray = array_values($media);
    if (isset($indexedMediaArray)) {
        $post->setMedia($indexedMediaArray);
    }
    $postTemplatesArray[] = $post->getPostTemplate();
}


?>

<!-- Dashboard View -->
<div class="grid grid-cols-6 gap-4 px-8 my-8 w-full">
    <div class="col-span-4">

    </div>
</div>