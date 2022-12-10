<?php

/**
 * Setup controllers used in view
 */
$sessionController = new SessionController();
$postController = new PostController();
$mediaController = new MediaController();
$tagsController = new TagsController();

$uploadedMediaIdArray = $sessionController->getUploadedMediaIdArray();
$indexedMediaArray = array();
foreach ($uploadedMediaIdArray as $imageId) {
    $indexedMediaArray[] = $mediaController->fetchMediaById($imageId);
}
?>

<div class="grid grid-cols-6 px-8 h-[calc(100vh-5rem)]">
    <div class="w-screen h-screen absolute top-0 left-0 z-0 bg-[radial-gradient(circle_at_100%_100%,_rgba(144,202,156,0.111)_0%,_rgba(144,202,156,0.0)_58%)]">
    </div>
    <div class="col-span-6 xl:col-span-3 flex flex-col justify-between sm:pr-8 relative z-1">
        <div class="mt-12">
            <div class="pb-6">
                <h3 class="medium-headline mb-2">The secret recipe...</h3>
                <p class="small-headline">Tell us about your drink</p>
            </div>
            <form action="CreatePost" method="post">
                <div class="input-field-wrapper mb-4">
                    <div class="icon-wrapper">
                        <i class="las la-signature"></i>
                    </div>
                    <input placeholder="Title" class="input-field " type="text" name="title">
                </div>
                <div class="text-area-wrapper mb-4">
                    <div class="icon-wrapper-text-area">
                        <i class="las la-comment"></i>
                    </div>
                    <textarea placeholder="Description.." name="description" maxlength="256" class="input-field  min-h-[4rem]"></textarea>
                </div>
                <div class="input-field-wrapper items-center px-2">
                    <div class="icon-wrapper">
                        <i class="las la-unlock-alt"></i>
                    </div>
                    <input placeholder="Public" checked="true" class="cursor-pointer peer opacity-0 absolute h-full w-full" type="checkbox" name="isPublic">
                    <div class="checkbox peer-checked:after:content-['✓'] peer-checked:text-highlight-green-900 flex items-center justify-center"></div>
                    <p class="text-xs ml-2 text-highlight-green-900">Is Public</p>
                </div>
                <button class="btn-white w-full mt-6 " type="submit">SHARE</button>
            </form>
        </div>
    </div>
    <div class="col-span-6 xl:col-span-3">
        <h3 class="medium-headline mb-2 mt-12">Uploaded pictures</h3>
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