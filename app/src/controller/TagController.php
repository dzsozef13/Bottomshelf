<?php
include_files(array(
    "DbConnectionController",
    "Console",
    "TagModel"
));

class TagController
{
    function fetchAll()
    {
        $tagModel = new TagModel();
        return $tagModel->getAll();
    }

    function fetchAllForPost($postId)
    {
        $tagModel = new TagModel();
        return $tagModel->getAllForPost($postId);
    }

    function assignTag($tag) {
        $sessionController = new SessionController();
        $assignedTagIdArray = $sessionController->getAssignedTagIdArray();

        if (!in_array($tag['id'], $assignedTagIdArray)) {   
            $assignedTagIdArray[] = $tag['id'];
        } else {
            $assignedTagIdArray = array();
        }
        $sessionController->setAssignedTagIdArray($assignedTagIdArray);

        // Redirect to Create
        $redirect = new Router("AddTag");
    }
}
