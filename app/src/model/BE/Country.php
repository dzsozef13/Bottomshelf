<?php

class Country
{

    private string $countryCode;
    private string $countryName;

    function __construct(
        $countryCode,
        $countryName
    ) {
        $this->countryCode = $countryCode;
        $this->countryName = $countryName;
    }

    public function getCountryCode(): string
    {
        return htmlspecialchars($this->countryCode);
    }

    public function getCountryName(): string
    {
        return htmlspecialchars($this->countryName);
    }
}
