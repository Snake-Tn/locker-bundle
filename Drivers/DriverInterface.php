<?php

namespace SnakeTn\Locker\Drivers;
interface DriverInterface
{
    public function lock();
    public function unlock();
}