<?php

/**
 * Setup controllers used in view
 */
$sessionController = new SessionController();
$postController = new PostController();
$mediaController = new MediaController();
$tagsController = new TagsController();

$uploadedMediaIdArray = $sessionController->getUploadedMediaIdArray();

?>


<div class="grid grid-cols-6 px-8 h-[calc(100vh-5rem)]">
    <div class="w-screen h-screen absolute top-0 left-0 z-0 bg-[radial-gradient(circle_at_100%_100%,_rgba(144,202,156,0.111)_0%,_rgba(144,202,156,0.0)_58%)]">
    </div>
    <div class="col-span-6 sm:col-span-3 xl:col-span-2 flex flex-col justify-between sm:pr-8 relative z-1">
        <div class="mt-12">
            <div class="pb-6">
                <h3 class="medium-headline mb-2">The secret recipe...</h3>
                <p class="small-headline">Tell us about your drink</p>
            </div>
            <form action="CreatePost" method="post">
                <div class="input-field-wrapper">
                    <div class="icon-wrapper">
                        <i class="las la-at"></i>
                    </div>
                    <input placeholder="Title" class="input-field " type="text" name="title"><br>
                </div>
                <div class="input-field-wrapper mt-6">
                    <div class="icon-wrapper">
                        <i class="las la-user"></i>
                    </div>
                    <input placeholder="Description" class="input-field " type="text" name="description"><br>
                </div>
                <div class="input-field-wrapper mt-6">
                    <div class="icon-wrapper">
                        <i class="las la-user"></i>
                    </div>
                    <input placeholder="Public" class="input-field " type="checkbox" name="isPublic"><br>
                </div>
                <button class="btn-white w-full mt-6" type="submit">SHARE</button>
            </form>
        </div>
    </div>
    <div class="col-span-6 sm:col-span-3 2xl:col-span-4 "></div>
</div>