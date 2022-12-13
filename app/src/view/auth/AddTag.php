<?php

/**
 * Setup controllers used in view
 */
$sessionController = new SessionController();
$postController = new PostController();
$mediaController = new MediaController();
$tagsController = new TagController();

/**
 * Fetch tags
 */
$tags = $tagsController->fetchAll();
$tagTemplates = array();

/**
 * Fetch assigned tags
 */
$assignedTagIdArray = $sessionController->getAssignedTagIdArray() ?? array();

?>

<div class="grid grid-cols-6 px-8">
    <div class="w-screen h-screen absolute top-0 left-0 z-0 bg-[radial-gradient(circle_at_100%_100%,_rgba(144,202,156,0.111)_0%,_rgba(144,202,156,0.0)_58%)]">
    </div>
    <div class="col-span-6 lg:col-span-3 flex flex-col justify-between sm:pr-8 relative z-1">
        <div class="mt-12">
            <div class="pb-6">
                <h3 class="medium-headline mb-2">Apply tags...</h3>
                <p class="small-headline">Select the ones that best describe the drink!</p>
            </div>
            <div class="banner mb-4 mt-6">
                <h3 class="small-headline mb-4">Select tags that best describe your cocktail!</h3>
                <div class="tags-container">
                    <?php
                        foreach ($tags as $tag) {
                            if (in_array($tag->getId(), $assignedTagIdArray)) {
                                echo 
                                '<a class="tag-chip" href="TagAssign?id=' . $tag->getId() . '">
                                    X ' . $tag->getTagName() . '
                                </a>';
                            } else {
                                echo 
                                '<a class="tag-chip" href="TagAssign?id=' . $tag->getId() . '">
                                    ' . $tag->getTagName() . '
                                </a>';
                            }
                        }
                    ?>
                </div>
            </div>
            <!-- Possibily add a clean up if they cancel or an alert -->
            <a href="/Create">
                <button class="btn-white w-full mt-6 ">CONTINUE</button>
            </a>
        </div>
    </div>
</div>