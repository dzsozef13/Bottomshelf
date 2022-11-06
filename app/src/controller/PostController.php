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
        // $postModel->createPost('PLS', 'I hope this works', 1, 0, 2, 1);
    }


}

   
?>
