<?php

/**
 * Fetch all posts
 */
$postController = new PostController();
$posts = $postController->fetchAll();

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
            $postCard = str_replace(
                array(
                    '{{title}}', 
                    '{{description}}'),
                array(
                    $post->getTitle(), 
                    $post->getDescription()), 
                $postCardTempalte
            );
            echo $postCard;
        }
    ?>
</div>