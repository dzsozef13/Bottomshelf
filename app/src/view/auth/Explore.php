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
$filter = $sessionController->getExploreFilter();
switch ($filter) {
    case 'trending':
        console_log('trending');
        $posts = $postController->fetchAll();
        break;
    default:
        console_log('all');
        $posts = $postController->fetchAll();
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

?>

<!-- Explore View -->
<div class="grid grid-cols-6 gap-4 px-8 my-8 w-full">
    <div class="col-span-4">
        <div class="input-field-wrapper mb-4">
            <div class="icon-wrapper">
                <i class="las la-search"></i>
            </div>
            <input type="text" placeholder="Search..." class="input-field">
        </div>
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
                                    <a href="/SelectedPost?selected=' .  $post->getId() . '">
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
            <div class="banner mt-4">
                <h3 class="small-headline mb-4">Use tags to filter posts!</h3>
                <div class="tags-container">
                    <?php echo implode($tagTemplates)
                    ?>
                </div>
            </div>
        </div>

    </div>
</div>