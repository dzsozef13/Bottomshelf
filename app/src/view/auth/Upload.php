<?php

/**
 * Setup controllers used in view
 */
$sessionController = new SessionController();
$postController = new PostController();
$mediaController = new MediaController();
$tagsController = new TagsController();

?>

<div class="grid grid-cols-6 px-4 my-4 sm:px-8 sm:my-8 w-full gap-4">
    <div class="w-screen h-screen absolute top-0 left-0 z-0 bg-[radial-gradient(circle_at_100%_100%,_rgba(144,202,156,0.111)_0%,_rgba(144,202,156,0.0)_58%)]">
    </div>
    <div class="col-span-6 xl:col-span-3 flex flex-col justify-between sm:pr-8 relative z-1">
        <div class="mt-12 w-full">
            <div class="pb-6">
                <h3 class="medium-headline mb-2">Create A Post!</h3>
                <p class="small-headline">First choose the right pictures. <br> You can upload up to three images of your creation</p>
            </div>
            <form action="MediaUpload" method="post" enctype="multipart/form-data" id="settings-img-upload">
                <div id="upload-btn-1" class="input-field-wrapper cursor-pointer flex items-center px-4 mb-4 mt-2">
                    <div class="icon-wrapper">
                        <i class="las la-file-upload"></i>
                    </div>
                    <p id="input-text-1" class="m-0 p-0 text-sm">Upload image...</p>
                </div>
                <input type="file" id="input-btn-1" class="hidden" name="media1" />

                <div id="upload-btn-2" class="input-field-wrapper cursor-pointer flex items-center px-4 mb-4 upload-btn mt-2">
                    <div class="icon-wrapper">
                        <i class="las la-file-upload"></i>
                    </div>
                    <p id="input-text-2" class="m-0 p-0 text-sm">Upload image...</p>
                </div>
                <input type="file" id="input-btn-2" class="hidden" name="media2" accept="image/png, image/gif, image/jpeg" />

                <div id="upload-btn-3" class="input-field-wrapper cursor-pointer flex items-center px-4 mb-4 upload-btn mt-2">
                    <div class="icon-wrapper">
                        <i class="las la-file-upload"></i>
                    </div>
                    <p id="input-text-3" class="m-0 p-0 text-sm">Upload image...</p>
                </div>
                <input type="file" id="input-btn-3" class="hidden" name="media3" accept="image/png, image/gif, image/jpeg" />

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
</div>