<?php

include_once $_SERVER['DOCUMENT_ROOT'] . "/autoload.php";
include_files(array(
    "Console",
    "DbConnectionController",
    "Entity",
));

class User extends Entity
{
    public int $id;
    public string $email;
    public string $username;
    public string $dateOfBirth;
    public ?string $profileImgBlob;
    public ?string $bioDescription;
    public ?string $countryCode;
    public int $roleId;
    public int $statusId;


    public function __construct(int $id, string $email, string $username, string $dateOfBirth, ?string $profileImgBlob, ?string $bioDescription, string $countryCode, int $roleId, int $statusId)
    {
        $this->id = $id;
        $this->email = $email;
        $this->username = $username;
        $this->dateOfBirth = $dateOfBirth;
        $this->profileImgBlob = $profileImgBlob;
        $this->bioDescription = $bioDescription;
        $this->countryCode = $countryCode;
        $this->roleId = $roleId;
        $this->statusId = $statusId;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function getStatus()
    {
        if ($this->statusId == 1) {
            return 'Active';
        } else if ($this->statusId == 2) {
            return 'Banned';
        } else if ($this->statusId == 3) {
            return 'Reported';
        } else {
            return 'Deleted';
        }
    }

    public function getStatusId()
    {
        return $this->statusId;
    }

    public function getCountryCode()
    {
        return $this->countryCode;
    }

    public function getDescription()
    {
        return $this->bioDescription;
    }

    public function isAdmin()
    {
        if ($this->roleId == 2) {
            return true;
        } else {
            return false;
        }
    }

    public function getProfileImage()
    {
        return $this->profileImgBlob;
    }
}
