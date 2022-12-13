<?php
include_files(array(
    "DbConnectionController",
    "SessionController",
    "Router",
    "Route",
    "Console",
    "UserModel"
));

class UserController
{

    public function tryLogInUser()
    {
        if (isset($_POST['email'], $_POST['password'])) {
            $email = $_POST['email'];
            $password = $_POST['password'];

            $userModel = new UserModel();
            if ($user = $userModel->validateUser($email, $password)) {
                $session = new SessionController();
                $session->setUser($user->UserId, $user->Username, $user->RoleId);
                new Router("Explore");
            } else {
                new Router("Login");
            }
        }
    }

    public function tryLogOutUser()
    {
        $session = new SessionController();
        if (isset($session->getUser()['userId'])) {
            $session->destroy();
            new Router("Home");
        } else {
            console_log('No user is logged in.');
        }
    }

    public function tryRegistUser()
    {
        if (isset(
            $_POST['email'],
            $_POST['username'],
            $_POST['password'],
            $_POST['repeatPassword'],
            $_POST['birthdate']
        )) {

            $userModel = new UserModel();
            if ($_POST['password'] == $_POST['repeatPassword']) {
                $data = array(
                    'email' => $_POST['email'],
                    'username' =>  $_POST['username'],
                    'password' => $_POST['password'],
                    'birthdate' => $_POST['birthdate']
                );
                if ($userModel->registUser($data)) {
                    new Router("Login");
                } else {
                    new Router("Signup");
                }
            }
        }
    }

    public function fetchAll()
    {
        $userModel = new UserModel();
        return $userModel->getAll();
    }

    public function fetchById($userId)
    {
        if (isset($userId)) {
            $userModel = new UserModel();
            return $userModel->getUserById($userId);
        } else {
            return null;
        }
    }

    public function updateUser()
    {
        $userModel = new UserModel();
        $sessionController = new SessionController();
        $countriesController = new CountryController();

        $userId = $sessionController->getUser()['userId'];
        $countries = $countriesController->fetchAll();

        $countryCode = null;
        foreach ($countries as $country) {
            if ($country->getCountryName() === $_POST['countryName']) {
                $countryCode = $country->getCountryCode();
            }
        }
        $data = array(
            "username" => $_POST['username'],
            "description" => $_POST['description'],
            "countryCode" => $countryCode,
        );
        if (isset($userId)) {
            $userModel->updateUser($userId, $data);
        }

        new Router('Settings');
    }

    /**
     * Admin only
     */
    public function markAsBanned()
    {
        $sessionController = new SessionController();
        $roleId = $sessionController->getUser()['roleId'];
        if (isset($roleId) && $roleId == 2) {

            $userModel = new UserModel();
            $userId = $sessionController->getUserProfileId();
            if (isset($userId)) {
                $userModel->updateUserStatus($userId, 2);
            }
        }
        new Router('Profile?selectedUser=' . $userId);
    }

    /**
     * Admin only
     */
    public function markAsActive()
    {

        $sessionController = new SessionController();
        $roleId = $sessionController->getUser()['roleId'];

        if (isset($roleId) && $roleId == 2) {
            $userModel = new UserModel();
            $userId = $sessionController->getUserProfileId();

            if (isset($userId)) {
                $userModel->updateUserStatus($userId, 1);
            }
        }
        new Router('Profile?selectedUser=' . $userId);
    }

    public function markAsDeleted()
    {
        $userModel = new UserModel();
        $sessionController = new SessionController();
        $userId = $sessionController->getUserProfileId();

        if (isset($userId)) {
            $userModel->updateUserStatus($userId, 4);
        }

        new Router('Profile?selectedUser=' . $userId);
    }

    public function addProfilePicture()
    {
        $userModel = new UserModel();
        $sessionController = new SessionController();

        $userId = $sessionController->getUser()['userId'];

        $profilePicture = null;

        if (isset($_POST['submit'])) {
            if (isset($_FILES['profileImg']["name"])) {
                // Get file info 
                $fileName = basename($_FILES['profileImg']["name"]);
                $fileType = pathinfo($fileName, PATHINFO_EXTENSION);

                // Allow certain file formats 
                $allowTypes = array('jpg', 'png', 'jpeg', 'gif');
                if (in_array($fileType, $allowTypes)) {
                    $image = $_FILES['profileImg']['tmp_name'];
                    $profilePicture = file_get_contents($image);
                } else {
                    // Redirect to Upload with message "Wrong format"
                    $errorMessage = "Failed to upload file becase of unsupported format.";
                    $redirect = new Router("Settings?systemMessage=" . $errorMessage);
                    return;
                }
            }
        } else {
            // Redirect to Upload with message "Wrong format"
            $errorMessage = "Failed to upload file, it might be damaged or too large.";
            $redirect = new Router("Settings?systemMessage=" . $errorMessage);
            return;
        }

        if (isset($userId, $profilePicture)) {
            $data = array(
                "userId" => $userId,
                "media" => $profilePicture
            );
            $userModel->uploadProfilePicture($data);
            $redirect = new Router("Settings");
        } else {
            // Redirect to Upload with message "Wrong format"
            $errorMessage = "Oops, something went wrong. Please log in and try again.";
            $redirect = new Router("Settings?systemMessage=" . $errorMessage);
            return;
        }
    }
}
