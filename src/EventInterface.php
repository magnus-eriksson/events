<?php namespace Maer\Events;

interface EventInterface
{
 
    /**
     * Add an event listener
     * 
     * @param string   $event
     * @param callable $callback
     * @param integer  $priority
     */
    public function addListener($event, $name, callable $callback, $priority = 10);


    /**
     * Remove an event listener
     * 
     * @param  string           $event    
     * @param  callable|null    $callback 
     */
    public function removeListener($event, $name);


    /**
     * Get list of all event listeners
     * 
     * @param  string   $event
     * @param  integer  $priority
     * @return array
     */
    public function getAllListeners($event = null, $priority = null);


    /**
     * Emit an event
     * 
     * @param  string $event
     * @param  array  $params   Params to pass through to the callable
     */
    public function emit($event, array $params = array());

}