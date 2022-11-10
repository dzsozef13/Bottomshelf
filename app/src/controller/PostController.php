<?php
include_files(array(
    "DbConnectionController",
    "Console",
    "PostModel"
));
   
class PostController {

    public function createTest() {
        $postModel = new PostModel();
        //commenting this out since it was only a test and we dont want to create more
        // $test = array('title' => "meow meow",'description' => "yellow",'isPublic' => 0,'isSticky' => 1,'userId' => 1,'statusId' => 1);
        // $postModel->createPost($test);
    }


}

   
?>
