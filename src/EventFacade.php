<?php namespace Maer\Events;

class EventFacade
{
    protected static $instance;

    protected function __construct() {}
    protected function __destruct() {}
    protected function __clone() {}

    public static function getInstance()
    {
        if (is_null(static::$instance)) {
            static::$instance = new Event;
        }

        return static::$instance;
    }

    public static function __callStatic($method, $args) 
    {
        return call_user_func_array([static::getInstance(), $method], $args);
    }
}