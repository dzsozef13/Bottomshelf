<?php

/**
 * Session controller
 */
$sessionController = new SessionController();

/**
 * Media controller
 */
$mediaController = new MediaController();

/**
 * Post Controller
 */
$postController = new PostController();

/**
 * Comment Controller
 */

$commentController = new CommentController();

/**
 * Get Post id from the session and fetch the Post
 */
$postId = $sessionController->getSelectedPostId();
$post = $postController->fetchById($postId);

/**
 * Fetch all media for the post
 */
$media = $mediaController->fetchMediaForPost($post->getId());
$indexedMediaArray = array_values($media);
if (isset($indexedMediaArray)) {
    $post->setMedia($indexedMediaArray);
}

/**
 * Fetch all comments for the post
 */

$comments = $commentController->fetchAllByPostId($post->getId());


?>

<div class="grid grid-cols-6 px-16 my-8 w-full">
    <div class="col-span-6">
        <div class="post-preview-container">
            <div class="post-preview-img-container">
                <img class="img" src="data:image/*;charset=utf8;base64,<?php echo base64_encode($indexedMediaArray[0]->getImage()) ?>" alt="">
            </div>
            <div class="post-preview-content">
                <h2 class="medium-headline"><?php echo $post->getTitle() ?></h2>
                <p class="text-sm font-mono">
                    by @<span class="text-highlight-green-900"><?php echo $post->getAuthorName() ?></span>
                    <span class="text-dim-white-900/60"><?php echo $post->getCreatedAt() ?></span>
                </p>
                <h4 class=" mt-4">
                    <?php echo $post->getDescription() ?>
                </h4>
            </div>


        </div>
    </div>
</div>