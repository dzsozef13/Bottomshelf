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

/**
 * Grab templates used in the view
 */
$viewController = new ViewController();
$postCardTempalte = $viewController->getTemplateContent("PostCard")

?>

<!-- Explore View -->
<div class="grid grid-cols-6 px-8 h-[calc(100vh-5rem)]">
    <?php
        /**
         * Loop through the posts
         * Replace placeholders with data from each post
         * Echo out the complete template
         */
        foreach($posts as $post) {
            $media = $mediaController->fetchMediaForPost($post->getId());
            $mediaDump = array_values($media);
            $postCard = str_replace(
                array(
                    '{{title}}', 
                    '{{description}}',
                    '{{imageBlob}}'),
                array(
                    $post->getTitle(), 
                    $post->getDescription(),
                    base64_encode($mediaDump[0]->getImage())),
                $postCardTempalte
            );
            echo $postCard;
        }
    ?>
    <form action="MediaUpload" method="post">
        <div class="input-field-wrapper">
            <div class="icon-wrapper">
                <i class="las la-at"></i>
            </div>
            <input placeholder="Image" class="input-field " type="file" name="image"><br>
        </div>
        <button class="btn-white w-full mt-6" type="submit">UPLOAD</button>
    </form>
</div>