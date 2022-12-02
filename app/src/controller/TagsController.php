<?php
include_files(array(
    "DbConnectionController",
    "Console",
    "TagModel"
));

class TagsController
{

    function fetchAll()
    {
        $tagModel = new TagModel();
        return $tagModel->getAll();
    }
}
