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
 * Reaction Controller
 */

$reactionController = new ReactionController();


$userId = $sessionController->getUser()['userId'];
/**
 * Get Post id from the session and fetch the Post
 */
$postId = $sessionController->getSelectedPostId();
$post = $postController->fetchById($postId);
/**
 * If the post is fetched, but its id is null, it means it was marked as deleted
 */
if ($post->getId() == null) {
    new Router('Explore');
}

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

/**
 * Fetch all reactions for the post
 */
$reactions = $reactionController->fetchAllByPostId($post->getId());

/**
 * Looping through reactions to find if currently logged in user
 * has reacted to his post before. If found, save the reactions to which type it was
 */
$currentUserReaction = null;
if (isset($reactions)) {
    foreach ($reactions as $reaction) {
        if ($userId == $reaction->getAuthorId()) {
            return $reaction;
        }
    }
}
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
                    by @<span class="text-highlight-color-900"><?php echo $post->getAuthorName() ?></span> </a>
                <span class="text-light-color-900/60"><?php echo $post->getCreatedAt() ?></span>
            </p>
            <div class="mt-4">
                <?php echo htmlspecialchars_decode($post->getDescription())  ?>
            </div>

            <?php if ($userId == $post->getAuthorId() || $sessionController->getUser()['roleId'] == 2) { ?>
                <div class="w-full flex justify-end flex-wrap">
                    <a class="w-full md:w-2/4 md:pr-3" href="/EditPost?selectedPost=<?php echo $post->getId() ?>">
                        <button class="w-full btn-white-no-shadow mt-4 mr-4 ">EDIT POST</button>
                    </a>
                    <a class="w-full md:w-2/4 md:pl-2" href="/DeletePost">
                        <button class="w-full btn-outlined mt-4">DELETE POST</button>
                    </a>
                    <?php if ($sessionController->getUser()['roleId'] == 2) { ?>

                        <?php if ($post->getIsSticky() == false) { ?>
                            <a class="w-full" href="/MakeSticky">
                                <button class="w-full btn-green-no-shadow mt-4">MAKE STICKY</button>
                            </a>
                        <?php } else { ?>
                            <a class="w-full" href="/MakeNotSticky">
                                <button class="w-full btn-outlined mt-4">MAKE NOT STICKY</button>
                            </a>
                        <?php } ?>

                    <?php }  ?>

                </div>
            <?php } ?>
        </div>
        <div class="post-preview-content pb-0" id="#select-reactions">
            <form action="<?php isset($currentUserReaction) ? "AddReaction" : "DeleteReaction" ?>" class="w-full h-auto">
                <div class="reactions-wrapper gap-4">
                    <div class="reaction-input-wrapper">
                        <input type="radio" class="peer " <?php (isset($currentUserReaction) && $currentUserReaction->getReactionName() == "Heart" ? 'checked' : "") ?> name="reactionType" id="heart-reaction" value="Heart">
                        <label class="label-reaction-input" for="heart-reaction"><i class="las la-heart"></i></label>
                    </div>
                    <div class="reaction-input-wrapper">
                        <input type="radio" class="peer " <?php (isset($currentUserReaction) && $currentUserReaction->getReactionName() == "ThumbsDown" ? 'checked' : "") ?> name="reactionType" id="thmbs-down-reaction" value="ThumbsDown">
                        <label class="label-reaction-input" for="thmbs-down-reaction"><i class="las la-thumbs-down"></i></label>
                    </div>
                </div>
            </form>
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
                                    <h6 class="headline text-highlight-color-900">' . $comment->getUsername() . '</h6>
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
                            <p class="text-xs text-light-color-900/40">' . $comment->getCreatedAt() . '</p>
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