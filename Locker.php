<?php

namespace SnakeTn\Locker;

class Locker
{
    private $subjectObject;
    private $driver;

    public function __construct($subjectObject, $driver)
    {
        $this->subjectObject = $subjectObject;
        $this->driver = $driver;
    }

    public function __call($name, $arguments)
    {
        $this->driver->lock($name);
        $result = call_user_func_array([$this->subjectObject, $name], $arguments);
        $this->driver->unlock($name);
        return $result;
    }

}