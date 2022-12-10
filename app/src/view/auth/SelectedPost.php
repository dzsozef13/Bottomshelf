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


$userId = $sessionController->getUser()['userId'];
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
$smallImages = array();
if (isset($indexedMediaArray)) {
    $post->setMedia($indexedMediaArray);

    foreach ($indexedMediaArray as $image) {
        $smallImages[] = '<div class="post-small-images">
            <img class="img small-img" src="data:image/*;charset=utf8;base64,' . base64_encode($image->getImage()) . '" alt="">
        </div>';
    }
}
$selectedImage = !empty($indexedMediaArray) ? $indexedMediaArray[0] : null;




/**
 * Fetch all comments for the post
 */

$comments = $commentController->fetchAllByPostId($post->getId());
?>

<div class="grid grid-cols-6 px-2 my-4 sm:px-8 sm:my-8 w-full gap-4">
    <!-- Images Column -->
    <?php if (!empty($indexedMediaArray)) {
        echo '
        <div class=" col-span-6 sm:col-span-3 px-6 sm:px-0">
            <div class="post-preview-img-container">
                <img class="img" id="big-img" src="data:image/*;charset=utf8;base64,' . base64_encode($selectedImage->getImage()) . '" alt="">
            </div>
            <div class="post-small-images-container">
                ' .
            implode($smallImages)
            . '
            </div>
        </div>
        ';
    } else {
    } ?>
    <!-- Post Content Column -->
    <div class="col-span-6 sm:col-span-3">
        <!-- Container for post information -->
        <div class="post-preview-content">
            <h2 class="medium-headline"><?php echo $post->getTitle() ?></h2>
            <p class="text-sm font-mono">
                <a href="Profile?selectedUser=<?php echo $post->getAuthorId() ?>">
                    by @<span class="text-highlight-green-900"><?php echo $post->getAuthorName() ?></span> </a>
                <span class="text-dim-white-900/60"><?php echo $post->getCreatedAt() ?></span>
            </p>
            <h4 class="mt-4 ">
                <?php echo $post->getDescription() ?>
            </h4>
            <?php
            if ($userId == $post->getAuthorId()) {
                echo '
                <div class="w-full flex justify-end">
                    <a href="/DeletePost">
                        <button class="btn-white-no-shadow mr-4 mt-4">EDIT POST</button>
                    </a>
                    <a href="/DeletePost">
                        <button class="btn-outlined mt-4">DELETE POST</button>
                    </a>
                </div>
                ';
            }
            ?>
        </div>
        <!-- Comment Section -->
        <div class="post-preview-content">
            <!-- Comment Creation -->
            <form action="AddComment" method="post">
                <div class="text-area-wrapper">
                    <div class="icon-wrapper-text-area">
                        <i class="las la-comment"></i>
                    </div>
                    <textarea placeholder="Comment here.." name="comment" maxlength="1024" class="input-field  min-h-[4rem]"></textarea>
                </div>
                <button class="btn-white-no-shadow w-full mt-4 mb-4" type="submit">Add Comment</button>
            </form>
            <!-- Comment display + deletion, editing logic -->
            <div id="allComments">
                <?php
                foreach ($comments as $comment) {
                    echo ' <div class="comment-container last:mb-0"" >
                    <div class="comment-picture-container">
                        <img class="img" src="' . ($comment->getUserPicture() !== null ? 'data:image/*;charset=utf8;base64,' . base64_encode($comment->getUserPicture()) : 'public/asset/images/PlaceholderProfilePicture.png') . '" alt="">
                    </div>
                    <div class="comment-body-container">
                        <div class="comment-headline">
                            <div class="comment-username">
                                <a href="Profile?selectedUser=' . $comment->getUserId() . '">
                                    <h6 class="headline text-highlight-green-900">' . $comment->getUsername() . '</h6>
                                </a>
                                ' . ($comment->getUserId() == $sessionController->getUser()['userId'] ? '
                                            <button class="editCommentBtn ml-2"> 
                                                <div class="btn-icon">
                                                    <i class="las la-edit"></i>
                                                </div> 
                                            </button>
                                        <a href="DeleteComment?commentId=' . $comment->getId() . '">
                                            <button class="ml-2"> 
                                                <div class="btn-icon">
                                                    <i class="las la-trash"></i>
                                                </div> 
                                            </button>
                                        </a>' : "") .
                        '
                            </div>
                            <p class="text-xs text-dim-white-900/40">' . $comment->getCreatedAt() . '</p>
                        </div>
                        <form action="UpdateComment?commentId= ' . $comment->getId() . '" method="post" class="edit-comment pt-2 pr-4">
                            <div class="text-area-wrapper">
                                <div class="icon-wrapper-text-area">
                                    <i class="las la-comment"></i>
                                </div>
                                <textarea placeholder="Comment here.." name="comment" maxlength="1024" class="input-field  min-h-[4rem]">' . $comment->getContent() . '</textarea>
                            </div>
                            <button class="btn-green-no-shadow w-full mt-4 " type="submit">Edit Comment</button>
                        </form>
                        <p class="text-xs comment-content">' . $comment->getContent() . '</p>
                    </div>
                </div>';
                }
                ?></div>
        </div>
    </div>
</div>