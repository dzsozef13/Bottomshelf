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

    function UpdateContact()
    {
        $systemModel = new SystemModel();

        $data = array(
            "phoneNumber" =>  $_POST['phoneNumber'],
            "email" =>  $_POST['email'],
            "address" =>  $_POST['address']
        );

        if (!empty($data)) {
            $systemModel->updateSystemContact(1, $data);
        }

        new Router('Settings');
    }

    function UpdateDescriptionRules()
    {
        // $systemModel = new SystemModel();
        // return $systemModel->getById($id);
    }
}
