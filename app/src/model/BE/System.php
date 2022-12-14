<?php

class System
{
    private $id;
    private $serviceDescription;
    private $rules;
    private $phoneNumber;
    private $systemEmail;
    private $address;
    private $colorSchemeId;

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

    public function getDescription()
    {
        return $this->serviceDescription;
    }

    public function getRules()
    {
        return $this->rules;
    }
    public function getPhoneNumber()
    {
        return htmlspecialchars($this->phoneNumber);
    }
    public function getEmail()
    {
        return htmlspecialchars($this->systemEmail);
    }
    public function getAddress()
    {
        return htmlspecialchars($this->address);
    }
    public function getColorSchemeId()
    {
        return htmlspecialchars($this->ColorSchemeId);
    }
}
