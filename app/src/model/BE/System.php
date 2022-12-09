<?php

class System
{
    private $id;
    private $serviceDescription;
    private $rules;
    private $phoneNumber;
    private $systemEmail;
    private $address;
    private $usersCount;

    function __construct(
        $id,
        $serviceDescription,
        $rules,
        $phoneNumber,
        $systemEmail,
        $address,
        $usersCount
    ) {
        $this->id = $id;
        $this->serviceDescription = $serviceDescription;
        $this->rules = $rules;
        $this->phoneNumber = $phoneNumber;
        $this->systemEmail = $systemEmail;
        $this->address = $address;
        $this->usersCount = $usersCount;
    }
}
