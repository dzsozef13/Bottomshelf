<?php

/**
 * Setup controllers used in view
 */
$sessionController = new SessionController();
$postController = new PostController();
$mediaController = new MediaController();
$tagsController = new TagsController();

/**
 * Fetch posts
 */

// Check for applied filter
$filter = $sessionController->getFilter();
$sessionController->setFilter(null);
if ($filter != null) {
    switch ($filter) {
        case 'trending':
            console_log('trending');
            $posts = $postController->fetchAll();
            break;
    }
}

// Check for applied search key
$searchPhrase = $sessionController->getSearchPhrase();
if ($searchPhrase != null) {
    // $posts = $postController->fetchAllWithOptions($searchPhrase, $searchTag, $filter);
    $sessionController->setSearchPhrase(null);
}
// Check for applied search tag
$searchTag = $sessionController->getSearchTag();
if ($searchTag != null) {
    // $posts = $postController->fetchByTag($searchTag);
    $sessionController->setSearchTag(null);
}

$posts = $postController->fetchAllWithOptions($searchPhrase, $searchTag, $filter);

// Fetch all posts
if ($filter == null && $searchPhrase == null && $searchTag == null) {
    $posts = $postController->fetchAll();
}

/**
 * Fetch tags
 */
$tags = $tagsController->fetchAll();
$tagTemplates = array();
foreach ($tags as $tag) {
    $tagTemplates[] = $tag->getTagTemplate();
}

?>

<!-- Explore View -->
<div class="grid grid-cols-6 gap-4 px-8 my-8 w-full">
    <div class="col-span-4">

        <!-- Search Field -->

        <form action="Explore" method="get" class="flex justify-between h-auto flex-wrap">
            <div class="banner mb-4">
                <h3 class="small-headline mb-4">Select tags to improve the search!</h3>
                <div class="tags-container">
                    <?php echo implode($tagTemplates)
                    ?>
                </div>
            </div>
            <div class="rounded-lg border border-highlight-green-900/60 bg-transparent flex relative h-10 w-[73%]">
                <div class="icon-wrapper">
                    <i class="las la-search"></i>
                </div>
                <input type="text" name="searchPhrase" placeholder="Search posts by a phrase..." class="input-field">
            </div>
            <button type="submit" class="btn-green-no-shadow w-[25%]">
                SEARCH
            </button>
        </form>

        <!-- Posts section -->

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
                                                    <p class="post-card-user">by @<span class="text-highlight-green-900">' . $post->getAuthorName() . '</span></p>
                                                </div>
                                                <!-- Post Comment -->
                                                    ' . ($post->getLatestComment() === null ? '' : '<div class="post-card-comment-wrapper">
                                                    <div class="small-logo">
                                                        <i class="las la-smile text-background-black-900 text-xl"></i>
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
            <div class="grid 2xl:grid-cols-5 xl:grid-cols-3 md:grid-cols-2 grid-cols-1 gap-4"> 
                ' . implode($postTemplatesArray) . '
            </div> 
            ';
        } ?>
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

        </div>

    </div>
</div>