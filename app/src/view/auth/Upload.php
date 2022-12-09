<?php

/**
 * Setup controllers used in view
 */
$sessionController = new SessionController();
$postController = new PostController();
$mediaController = new MediaController();
$tagsController = new TagsController();

?>

<div class="grid grid-cols-6 px-2 my-4 sm:px-8 sm:my-8 w-full gap-4">
    <!-- <div class="w-screen h-screen absolute top-0 left-0 z-0 bg-[radial-gradient(circle_at_100%_100%,_rgba(144,202,156,0.111)_0%,_rgba(144,202,156,0.0)_58%)]">
    </div> -->
    <div class="col-span-6 sm:col-span-3 xl:col-span-2 flex flex-col justify-between sm:pr-8 relative z-1">
        <div class="mt-12">
            <div class="pb-6">
                <h3 class="medium-headline mb-2">Create A Post!</h3>
                <p class="small-headline">First choose the right pictures. You can upload up to three images of your creation</p>
            </div>
            <form action="MediaUpload" method="post" enctype="multipart/form-data">
                <div class="input-field-wrapper">
                    <input placeholder="Image" class="input-field " type="file" name="media1"><br>
                </div>
                <div class="input-field-wrapper mt-6">
                    <input placeholder="Image" class="input-field " type="file" name="media2" accept="image/png, image/gif, image/jpeg"><br>
                </div>
                <div class="input-field-wrapper mt-6">
                    <input placeholder="Image" class="input-field " type="file" name="media3" accept="image/png, image/gif, image/jpeg"><br>
                </div>
                <button class="btn-white w-full mt-6" type="submit" name="submit">CONTINUE</button>

                <?php
                if ($sessionController->getSystemMessage() != null) {
                    echo
                    '<div class="message-container mt-6">
                                <p class="error-message">' . $sessionController->getSystemMessage() . '</p>
                            </div>';
                }
                ?>

            </form>
        </div>
    </div>
    <div class="col-span-6 sm:col-span-3 2xl:col-span-4 "></div>
</div>