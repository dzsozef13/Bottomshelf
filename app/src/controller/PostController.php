<?php
include_files(array(
    "DbConnectionController",
    "Console",
    "Post"
));
   
class PostController {

    public function createTest() {
        $postModel = new Post();
        //commenting this out since it was only a test and we dont want to create more
        // $test = array('title' => 'Fanta Drink','description' => 'Yummy','isPublic' => 1,'isSticky' => 0,'userId' => 1,'statusId' => 1);
        // $postModel->createPost($test);
    }


}

   
?>
