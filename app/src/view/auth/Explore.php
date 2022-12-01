<?php

/**
 * Fetch all posts
 */
$postController = new PostController();
$posts = $postController->fetchAll();

/**
 * Media controller
 */
$mediaController = new MediaController();

?>

<!-- Explore View -->
<div class="grid grid-cols-3 gap-8 p-8 h-[calc(100vh-5rem)]">
    <?php
    /**
     * Loop through the posts
     * Replace placeholders with data from each post
     * Echo out the complete template
     */
    foreach ($posts as $post) {
        // This will require some guarding, specially if we're planning to enable posting without images
        $media = $mediaController->fetchMediaForPost($post->getId());
        $indexedMediaArray = array_values($media);
        // If media exist, save them inside Post entity so the template could use the first one
        if (isset($indexedMediaArray)) {
            $post->setMedia($indexedMediaArray);
        }
        // Echo out the complete card
        echo $post->getPostTemplate();
    }
    ?>
</div>

<!-- Test File Upload Form -->
<form action="MediaUpload" method="post" enctype="multipart/form-data">
    <div class="input-field-wrapper">
        <div class="icon-wrapper">
            <i class="las la-at"></i>
        </div>
        <input placeholder="Image" class="input-field " type="file" name="media1"><br>
        <input placeholder="Image" class="input-field " type="file" name="media2"><br>
        <input placeholder="Image" class="input-field " type="file" name="media3"><br>
    </div>
    <button class="btn-white w-full mt-6" type="submit" name="submit">UPLOAD</button>
</form>