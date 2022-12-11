<?php

/**
 * Setup controllers used in view
 */
$sessionController = new SessionController();
$postController = new PostController();
$mediaController = new MediaController();

$postId = $sessionController->getSelectedPostId();
$post = $postController->fetchById($postId);
if ($post->getId() == null) {
    new Router('Explore');
}
$media = $mediaController->fetchMediaForPost($post->getId());
$indexedMediaArray = array_values($media);
?>

<div class="grid grid-cols-6 px-8">
    <div class="w-screen h-screen absolute top-0 left-0 z-0 bg-[radial-gradient(circle_at_100%_100%,_rgba(144,202,156,0.111)_0%,_rgba(144,202,156,0.0)_58%)]">
    </div>
    <div class="col-span-6 lg:col-span-3 flex flex-col justify-between sm:pr-8 relative z-1 mb-4">
        <div class="mt-12">
            <div class="pb-6">
                <h3 class="medium-headline">Edit The Post: <span class="text-highlight-green-900"><?php echo $post->getTitle() ?></span></h3>
            </div>
            <form action="EditPostInformation" method="post">
                <div class="input-field-wrapper mb-4">
                    <div class="icon-wrapper">
                        <i class="las la-signature"></i>
                    </div>
                    <input required placeholder="Title" class="input-field" value="<?php echo $post->getTitle() ?>" type="text" name="title">
                </div>
                <div class="sun-editor-wrapper mb-4">
                    <p class="mb-2 healine text-highlight-green-900">Description</p>
                    <textarea required id="sample" name="description"><?php echo $post->getDescription() ?></textarea>
                </div>
                <div class="input-field-wrapper items-center px-2">
                    <div class="icon-wrapper">
                        <i class="las la-unlock-alt"></i>
                    </div>
                    <input placeholder="Public" <?php if ($post->getIsPublic() == 1) {
                                                    echo 'checked';
                                                }  ?> class="cursor-pointer peer opacity-0 absolute h-full w-full" type="checkbox" name="isPublic">
                    <div class="checkbox peer-checked:after:content-['✓'] peer-checked:text-highlight-green-900 flex items-center justify-center"></div>
                    <p class="text-xs ml-2 text-highlight-green-900">Is Public</p>
                </div>
                <button class="btn-white w-full mt-6 " type="submit">UPDATE</button>
            </form>
            <!-- Possibily add a clean up if they cancel or an alert -->
            <a href="/Explore">
                <button class="btn-outlined w-full mt-4">CANCEL</button>
            </a>
        </div>
    </div>
    <div class="col-span-6 lg:col-span-3">
        <h3 class="medium-headline mb-2 mt-0 lg:mt-12">Uploaded pictures</h3>
        <div class="post-small-images-container">
            <?php
            foreach ($indexedMediaArray as $image) {
                echo '<div class="post-small-images">
                    <img class="img small-img" src="data:image/*;charset=utf8;base64,' . base64_encode($image->getImage()) . '" alt="">
                </div>';
            }
            ?>
        </div>
    </div>
</div>