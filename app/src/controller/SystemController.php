<?php
include_files(array(
    "DbConnectionController",
    "Console",
    "SystemModel",
    "SessionController"
));

class SystemController
{

    /**
     * Admin only
     */
    function fetchAll()
    {
        $sessionController = new SessionController();
        $roleId = $sessionController->getUser()['roleId'];
        if (isset($roleId) && $roleId == 2) {
            $systemModel = new SystemModel();
            return $systemModel->getAll();
        }
    }

    function fetchById(int $id)
    {

        $systemModel = new SystemModel();
        return $systemModel->getById($id);
    }

    /**
     * Admin only
     */
    function UpdateContact()
    {
        $sessionController = new SessionController();
        $roleId = $sessionController->getUser()['roleId'];
        if (isset($roleId) && $roleId == 2) {
            $systemModel = new SystemModel();

            $data = array(
                "phoneNumber" =>  $_POST['phoneNumber'],
                "email" =>  $_POST['email'],
                "address" =>  $_POST['address']
            );

            if (!empty($data)) {
                // system id hardcoded to 1 for now
                $systemModel->updateSystemContact(1, $data);
            }
        }
        new Router('Settings');
    }

    /**
     * Admin only
     */
    function UpdateDescriptionRules()
    {
        $sessionController = new SessionController();
        $roleId = $sessionController->getUser()['roleId'];
        if (isset($roleId) && $roleId == 2) {
            $systemModel = new SystemModel();

            $data = array(
                "systemDescription" =>  $_POST['systemDescription'],
                "rules" =>  $_POST['rules'],
            );

            if (!empty($data)) {
                // system id hardcoded to 1 for now
                $systemModel->updateSystemDescriptionAndRules(1, $data);
            }
        }
        new Router('Settings');
    }
}
