<?php

class System
{
    private int $id;
    private string $serviceDescription;
    private string $rules;
    private string $phoneNumber;
    private string $systemEmail;
    private string $address;
    private string $colorSchemeId;

    function __construct(
        $id,
        $serviceDescription,
        $rules,
        $phoneNumber,
        $systemEmail,
        $address,
        $colorSchemeId
    ) {
        $this->id = $id;
        $this->serviceDescription = $serviceDescription;
        $this->rules = $rules;
        $this->phoneNumber = $phoneNumber;
        $this->systemEmail = $systemEmail;
        $this->address = $address;
        $this->ColorSchemeId = $colorSchemeId;
    }

    public function getDescription(): string
    {
        return $this->serviceDescription;
    }

    public function getRules(): string
    {
        return $this->rules;
    }
    public function getPhoneNumber(): string
    {
        return htmlspecialchars($this->phoneNumber);
    }
    public function getEmail(): string
    {
        return htmlspecialchars($this->systemEmail);
    }
    public function getAddress(): string
    {
        return htmlspecialchars($this->address);
    }
    public function getColorSchemeId(): int
    {
        return $this->ColorSchemeId;
    }
}
