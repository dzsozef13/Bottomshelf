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
 * Tags controller
 */
$tagsController = new TagsController();
$tags = $tagsController->fetchAll();
$tagTemplates = array();
foreach ($tags as $tag) {
    $tagTemplates[] = $tag->getTagTemplate();
}


?>

<!-- Explore View -->
<div class="grid grid-cols-6 gap-4 px-8 my-8 w-full">
    <div class="col-span-6 ">
        <div class="tags-container">
            <?php echo implode($tagTemplates)
            ?>
        </div>
        <!-- tags -->
    </div>
    <div class="col-span-2 h-auto">
        <!-- search -->
        <div class="input-field-wrapper">
            <div class="icon-wrapper">
                <i class="las la-search"></i>
            </div>
            <input type="text" placeholder="Search..." class="input-field">
        </div>
    </div>
    <div class="col-span-6 mt-10">
        <div class="sort-dropdown-container">
            <!-- update this to an actual dropdown at some point -->
            <div class="dropdown">
                <h6>Sort by:</h6>
                <p class="text-highlight-green-900 ml-2">Newest</p>
            </div>
        </div>
        <?php
        if (empty($posts)) {
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
                $postTemplatesArray[] = $post->getPostTemplate();
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

<!-- Test File Upload Form -->
<!-- <form action="MediaUpload" method="post" enctype="multipart/form-data">
    <div class="input-field-wrapper">
        <div class="icon-wrapper">
            <i class="las la-at"></i>
        </div>
        <input placeholder="Image" class="input-field " type="file" name="media1"><br>
        <input placeholder="Image" class="input-field " type="file" name="media2"><br>
        <input placeholder="Image" class="input-field " type="file" name="media3"><br>
    </div>
    <button class="btn-white w-full mt-6" type="submit" name="submit">UPLOAD</button>
</form> -->