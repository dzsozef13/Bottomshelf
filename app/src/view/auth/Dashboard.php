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
        <div class="input-field-wrapper mb-4">
            <div class="icon-wrapper">
                <i class="las la-search"></i>
            </div>
            <input type="text" placeholder="Search..." class="input-field">
        </div>
        <div class="grid 2xl:grid-cols-5 xl:grid-cols-3 md:grid-cols-2 grid-cols-1 gap-4">
            <?php echo implode($postTemplatesArray) ?>
        </div>
    </div>
    <div class="col-span-2">
        <div class="side-bar-container">
            <div class="banner">
                <!-- temporary dummy text untill we introduce information info which the admin can edit -->
                <h2 class="headline text-xl text-highlight-green-900">Welcome to Bottom Shelf!</h2>
                <p class="text-sm mt-2">Explore new recipe ideas by browsing the community’s submissions.
                    Through tags and our search system, you can find exactly the drink
                    you had in mind. If you dont feel inspired, go to Explore page…
                </p>
            </div>
            <div class="banner mt-4">
                notifications
            </div>
        </div>

    </div>
</div>