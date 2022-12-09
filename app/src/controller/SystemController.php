<?php
include_files(array(
    "DbConnectionController",
    "Console",
    "SystemModel"
));

class SystemController
{

    function fetchAll()
    {
        $systemModel = new SystemModel();
        return $systemModel->getAll();
    }

    function fetchById(int $id)
    {
        $systemModel = new SystemModel();
        return $systemModel->getById($id);
    }
}
