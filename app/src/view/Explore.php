<?php

$postController = new PostController();
$posts = $postController->fetchAll();

foreach($posts as $post) {
    echo "Post with id: ";
    echo $post->getTitle();
    echo "<br>";
}

?>