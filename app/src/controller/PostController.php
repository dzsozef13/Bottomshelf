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
        // $test = array('title' => 'Crazy <a> Drink','description' => 'wow','isPublic' => 0);
        // $postModel->updatePostStatus(5,2);
    }


}

   
?>
