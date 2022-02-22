<?php

use PHPUnit\Framework\TestCase;

final class OwnerTest extends TestCase
{
    public function testShouldBeAString(): void
    {
        $this->assertInstanceOf(
            \Htlw3r\Pettracker\Model\Owner::class,
            new \Htlw3r\Pettracker\Model\Owner('Jakob', '066075849587')
        );
    }
}

