<?php namespace Maer\Events;

use Closure;

class Event implements EventInterface
{

    /**
     * Storage for all listeners
     * 
     * @var [type]
     */
    protected $listeners = [];


    /**
     * {@inheritdoc}
     */
    public function addListener($event, $name, callable $callback, $priority = 10)
    {
        $priority = intval($priority);

        if (!isset($this->listeners[$event])) {
            $this->listeners[$event] = [];
        }

        if (!isset($this->listeners[$event][$priority])) {
            $this->listeners[$event][$priority] = [];
        }

        $this->listeners[$event][$priority][$name] = $callback;

        return $this;
    }


    /**
     * {@inheritdoc}
     */
    public function removeListener($event, $name = null)
    {

        if (!isset($this->listeners[$event])) {
            return null;
        }

        if (is_null($name)) {
            unset($this->listeners[$event]);
            return null;
        }

        // Loop through all callbacks for the event and remove
        // those where the callback matches
        foreach($this->listeners[$event] as $priority => $n) {

            if (isset($this->listeners[$event][$priority][$name])) {
                unset($this->listeners[$event][$priority][$name]);
            }

        }

    }


    /**
     * {@inheritdoc}
     */
    public function getAllListeners($event = null, $priority = null)
    {
        if (is_null($event)) {
            return $this->listeners;
        }

        if (!isset($this->listeners[$event])) {
            return [];
        }

        if (is_null($priority)) {
            return $this->listeners[$event];
        }

        if (!isset($this->listeners[$event][$priority])) {
            return [];
        }

        return $this->listeners[$event][$priority];
    }


    /**
     * {@inheritdoc}
     */
    public function emit($event, array $params = array())
    {
        $listeners = $this->getAllListeners($event);
        $callbacks = [];

        foreach($listeners as $priority => $items) {
            $callbacks = array_merge($callbacks, $items);

        }

        foreach($callbacks as $callback) {

            $response = call_user_func_array($callback, $params);

            if ($response === false) {
                break;
            }

            if (!is_array($response)) {
                $response = !is_null($response)? [$response] : [];
            }

            $params = array_replace($params, $response);
        }

        return $params;
    }

}