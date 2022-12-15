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
    public mixed $profileImgBlob;
    public ?string $bioDescription;
    public int $postCount;
    public ?string $countryCode;
    public int $roleId;
    public int $statusId;


    public function __construct(int $id, string $email, string $username, string $dateOfBirth, mixed $profileImgBlob, ?string $bioDescription, int $postCount, string $countryCode, int $roleId, int $statusId)
    {
        $this->id = $id;
        $this->email = $email;
        $this->username = $username;
        $this->dateOfBirth = $dateOfBirth;
        $this->profileImgBlob = $profileImgBlob;
        $this->bioDescription = $bioDescription;
        $this->postCount = $postCount;
        $this->countryCode = $countryCode;
        $this->roleId = $roleId;
        $this->statusId = $statusId;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getUsername(): string
    {
        return htmlspecialchars($this->username);
    }

    public function getEmail(): string
    {
        return htmlspecialchars($this->email);
    }

    public function getStatus(): string
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

    public function getStatusId(): int
    {
        return $this->statusId;
    }

    public function getCountryCode(): ?string
    {
        return $this->countryCode;
    }

    public function getDescription(): ?string
    {
        return htmlspecialchars($this->bioDescription);
    }

    public function isAdmin(): bool
    {
        if ($this->roleId == 2) {
            return true;
        } else {
            return false;
        }
    }

    public function getProfileImage(): mixed
    {
        return $this->profileImgBlob;
    }
}
