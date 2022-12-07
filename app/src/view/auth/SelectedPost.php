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
if (isset($indexedMediaArray)) {
    $post->setMedia($indexedMediaArray);
}

/**
 * Fetch all comments for the post
 */

$comments = $commentController->fetchAllByPostId($post->getId());


?>

<div class="grid grid-cols-6 px-16 my-8 w-full gap-4">
    <div class="col-span-3">
        <div class="post-preview-img-container">
            <img class="img" src="data:image/*;charset=utf8;base64,<?php echo base64_encode($indexedMediaArray[0]->getImage()) ?>" alt="">
        </div>
    </div>
    <div class="col-span-3">
        <div class="post-preview-content">
            <h2 class="medium-headline"><?php echo $post->getTitle() ?></h2>
            <p class="text-sm font-mono">
                <a href="Profile?user=<?php echo $post->getAuthorId() ?>">
                    by @<span class="text-highlight-green-900"><?php echo $post->getAuthorName() ?></span> </a>
                <span class="text-dim-white-900/60"><?php echo $post->getCreatedAt() ?></span>
            </p>
            <h4 class="mt-4 ">
                <?php echo $post->getDescription() ?>
            </h4>
        </div>
        <div class="post-preview-content">
            <form action="AddComment" method="post">
                <div class="text-area-wrapper">
                    <div class="icon-wrapper-text-area">
                        <i class="las la-comment"></i>
                    </div>
                    <textarea placeholder="Comment here.." name="comment" maxlength="1024" class="input-field  min-h-[4rem]"></textarea>
                </div>
                <button class="btn-white-no-shadow  w-full mt-4 mb-4" type="submit">Add Comment</button>
            </form>
            <?php
            foreach ($comments as $comment) {
                echo ' <div class="comment-container last:mb-0">
                    <div class="comment-picture-container">
                        <img class="img" src="' . ($comment->getUserPicture() !== null ? 'data:image/*;charset=utf8;base64,' . base64_encode($comment->getUserPicture()) : 'public/asset/images/PlaceholderProfilePicture.png') . '" alt="">
                    </div>
                    <div class="comment-body-container">
                        <div class="comment-headline">
                            <div class="comment-username">
                                <a href="Profile?user=' . $comment->getUserId() . '">
                                    <h6 class="headline text-highlight-green-900">' . $comment->getUsername() . '</h6>
                                </a>
                                ' . ($comment->getUserId() == $sessionController->getUser()['userId'] ? '
                            
                                        <a href="UpdateComment?commentId=' . $comment->getId() . '">
                                            <button class="ml-2"> 
                                                <div class="btn-icon">
                                                <i class="las la-edit"></i>
                                                </div> 
                                            </button>
                                        </a>
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
                        <p class="text-xs">' . $comment->getContent() . '</p>
                    </div>
                </div>';
            }
            ?>
        </div>
    </div>
</div>