<?php

/**
 * Setup controllers used in view
 */
$sessionController = new SessionController();
$postController = new PostController();
$mediaController = new MediaController();
$tagsController = new TagsController();
$systemController = new SystemController();

/**
 * Fetch posts
 */
$filter = $sessionController->getExploreFilter();
switch ($filter) {
    case 'trending':
        console_log('trending');
        $posts = $postController->fetchAllByStatus();
        break;
    default:
        console_log('all');
        $posts = $postController->fetchAllByStatus();
        break;
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
    <div class="col-span-4">
        <form action="FilterPost" method="post" class="flex justify-between h-auto flex-wrap">
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
                <input type="text" name="phrase" placeholder="Search posts by a phrase..." class="input-field">
            </div>
            <button type="submit" class="btn-green-no-shadow w-[25%]">
                SEARCH
            </button>
        </form>

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
                <?php echo $system->getDescription() ?>
            </div>
            <div class="banner mt-4">
                <p class="headline mb-2">Guidelines</p>
                <?php echo $system->getRules() ?>
            </div>
        </div>

    </div>
</div>