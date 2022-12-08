<?php

class Country
{

    private $countryCode;
    private $countryName;

    function __construct(
        $countryCode,
        $countryName
    ) {
        $this->countryCode = $countryCode;
        $this->countryName = $countryName;
    }

    public function getCountryCode()
    {
        return $this->countryCode;
    }

    public function getCountryName()
    {
        return $this->countryName;
    }
}
