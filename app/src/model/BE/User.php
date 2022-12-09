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
    // private $userPassword;
    public string $username;
    public string $dateOfBirth;
    public ?string $profileImgBlob;
    public ?string $bioDescription;
    // add properties with full objects of these below when you create their entites
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
        if ($this->statusId == 2) {
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
