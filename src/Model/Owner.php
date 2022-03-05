<?php

namespace Htlw3r\Pettracker\Model;

class Owner
{

    private string $name;
    private string $phonenumber;

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getPhonenumber(): string
    {
        return $this->phonenumber;
    }

    /**
     * @param string $name
     * @param string $phonenumber
     */
    public function __construct(string $name, string $phonenumber)
    {
        $this->name = $name;
        $this->phonenumber = $phonenumber;
    }

    public function isPhoneNumberValid(): bool
    {
        return (bool) preg_match('/^([+]\d{1,2}\s?)?\d{2,3}[\s]?\d{2,3}[\s]?\d{3,5}$/', self::getPhonenumber());
    }
}

