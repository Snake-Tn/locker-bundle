<?php

namespace SnakeTn\Locker\Tests;

use PHPUnit\Framework\TestCase;
use SnakeTn\Locker\Drivers\DriverInterface;
use SnakeTn\Locker\Locker;

class LockerTest extends TestCase
{

    public function test_call_original_method()
    {
        $someObject = new class
        {
            public function doSomeThing()
            {
                return "some_thing";
            }
        };
        $lockDriver = $this->createMock(DriverInterface::class);
        $locker = new Locker($someObject, $lockDriver);

        $this->assertEquals($locker->doSomeThing(), $someObject->doSomeThing());
    }


}