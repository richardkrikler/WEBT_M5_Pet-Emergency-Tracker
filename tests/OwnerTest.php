<?php

require 'vendor/autoload.php';

use Htlw3r\Pettracker\Model\Owner;
use PHPUnit\Framework\TestCase;

final class OwnerTest extends TestCase
{
    public function testIsPhoneNumberValid(): void
    {
        $this->assertFalse((new Owner('Jakob', 'thiswillfail'))->isPhoneNumberValid());
        $this->assertTrue((new Owner('Jakob', '+43 11 22 333'))->isPhoneNumberValid());
        $this->assertTrue((new Owner('Jakob', '06764625696'))->isPhoneNumberValid());
        $this->assertTrue((new Owner('Jakob', '+43 676 462 5696'))->isPhoneNumberValid());
    }
}

