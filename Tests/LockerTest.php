<?php

namespace SnakeTn\Locker\Tests;

use PHPUnit\Framework\TestCase;
use SnakeTn\Locker\Drivers\DriverInterface;
use SnakeTn\Locker\Locker;

class LockerTest extends TestCase
{

    public function test_call_original_method()
    {
        $someObject = $this->getLockerTargetObject();
        $lockDriver = $this->createMock(DriverInterface::class);
        $locker = new Locker($someObject, $lockDriver);

        $this->assertEquals($locker->doSomeThing(), $someObject->doSomeThing());
    }

    public function test_lock_unique_code()
    {
        $someObject = $this->getLockerTargetObject();

        $lockDriver = $this->createMock(DriverInterface::class);
        $lockDriver->expects($this->once())
            ->method('lock')
            ->with('doSomeThing');
        $locker = new Locker($someObject, $lockDriver);
        $locker->doSomeThing();
    }

    /**
     * @return __anonymous@1141
     */
    private function getLockerTargetObject()
    {
        $someObject = new class
        {
            public function doSomeThing()
            {
                return "some_thing";
            }
        };
        return $someObject;
    }

}