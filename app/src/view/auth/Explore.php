<?php

/**
 * Setup controllers used in view
 */
$sessionController = new SessionController();
$postController = new PostController();
$mediaController = new MediaController();
$tagsController = new TagController();
$systemController = new SystemController();

// Check for applied filter
$filter = $sessionController->getFilter();
$sessionController->setFilter(null);
if ($filter != null) {
    switch ($filter) {
        case 'trending':
            console_log('showing trending');
            $posts = $postController->fetchInOrder($filter);
            break;
        case 'latest':
            console_log('showing newest');
            $posts = $postController->fetchInOrder($filter);
            break;
    }
}

// Check for applied search key
$searchPhrase = $sessionController->getSearchPhrase();
if ($searchPhrase != null) {
    $posts = $postController->fetchByPhrase($searchPhrase);
    $sessionController->setSearchPhrase(null);
}
// Check for applied search tag
$searchTag = $sessionController->getSearchTag();
if ($searchTag != null) {
    $posts = $postController->fetchByTag($searchTag);
    $sessionController->setSearchTag(null);
}
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

/**
 * Fetch System information
 */

$system = $systemController->fetchById(1);

?>

<!-- Explore View -->
<div class="grid grid-cols-6 gap-4 px-8 my-8 w-full">
    <div class="col-span-6 sm:col-span-4">
        <!-- Search Field -->
        <form action="Explore" method="get" class="flex justify-between h-auto flex-wrap">
            <div class="banner mb-4">
                <h3 class="small-headline mb-4">Select tags to improve the search!</h3>
                <div class="tags-container">
                    <?php echo implode($tagTemplates)
                    ?>
                </div>
            </div>
            <div class="rounded-lg border border-highlight-color-900/60 bg-transparent flex relative h-10 w-full sm:w-[48%] mb-2 sm:mb-0">
                <div class="icon-wrapper">
                    <i class="las la-search"></i>
                </div>
                <input type="text" name="searchPhrase" placeholder="Search posts by a phrase..." class="input-field">
            </div>
            <button type="submit" class="btn-green-no-shadow w-full mb-2 sm:mb-0 sm:w-[25%]">
                SEARCH
            </button>
            <a href="Explore" class="w-full sm:w-[25%]">
                <div class="btn-white-no-shadow w-full">
                    RESET FILTERS
                </div>
            </a>
        </form>
        <div class="flex mb-4 mt-4">
            <h3 class="small-headline mr-4">Sort by</h3>
            <?php
                $sortingQuery = "Explore?sorting=";
            ?>
            <a class="option-chip" href="<?php echo $sortingQuery . "latest" ?>">
                Newest first
            </a>
            <a class="option-chip" href="<?php echo $sortingQuery . "trending" ?>">
                Hot first
            </a> 
        </div>
        

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
                    <div class="post-card-container ' . ($post->getIsSticky() ? "sticky" : "") . ' ">
                        ' . ($post->getIsSticky() ? '<div class="post-card-sticky"><i class="las la-fire"></i></div>' : '') . '
                        <!-- Post Image -->
                        ' . ($post->getCoverImageForPost() === null ? '' : '<div class="post-card-img">
                                <img class="img" src="data:image/*;charset=utf8;base64,' . base64_encode($post->getCoverImageForPost()) . '" />
                            </div>') . '
                        <!-- Post Body -->
                        <div class="' . ($post->getCoverImageForPost() === null ? 'post-card-no-img-body' : 'post-card-body') . ' ">
                            <!-- Post Header -->
                            <div class="post-card-header mb-4">
                                <h3 class="post-card-title">' . $post->getTitle() . '</h3>
                                <p class="post-card-user">by @<span class="text-highlight-color-900">' . $post->getAuthorName() . '</span></p>
                                ' . ($post->getCoverImageForPost() === null ? '
                                <div class="h-44 w-full mt-2 overflow-hidden border-dashed">
                                    ' . htmlspecialchars_decode($post->getDescription())  . '
                                </div>
                                 ' : '') . '
                            </div>
                           
                            <!-- Post Comment -->
                                ' . ($post->getLatestComment() === null ? '' : '
                                <div class="post-card-comment-wrapper">
                                    <div class="small-logo">
                                        <i class="las la-smile text-background-primary-900 text-xl"></i>
                                    </div>
                                <div class="text-sm text-light-color-900/60">
                                  „ ' . $post->getLatestComment() . ' “
                                </div>
                            </div>') . '
                            <!-- Post Reactions -->
                            <div class="w-full h-auto flex gap-4 justify-between">
                                <div class="h-4 w-auto flex items-center text-sm "><i class="las la-heart"></i>
                                    <p class="ml-2">' . ($post->getReactionCount() ? $post->getReactionCount() : 0) . '</p>
                                </div>
                                <div class="h-4 w-auto flex items-center text-sm"><i class="las la-comment"></i>
                                    <p class="ml-2">' . ($post->getCommentCount() ? $post->getCommentCount() : 0) . '</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>';
            }
            echo '
                <div class="grid 2xl:grid-cols-5 xl:grid-cols-3 md:grid-cols-2 grid-cols-1 gap-4"> 
                ' . implode($postTemplatesArray) . '
                </div> 
                    '; ?>
        <?php } ?>
    </div>
    <div class="col-span-6 sm:col-span-2">
        <div class="side-bar-container">
            <div class="banner">
                <?php echo htmlspecialchars_decode($system->getDescription()) ?>
            </div>
            <div class="banner mt-4">
                <p class="headline mb-2">Guidelines</p>
                <?php echo htmlspecialchars_decode($system->getRules()) ?>
            </div>
        </div>
    </div>
</div>