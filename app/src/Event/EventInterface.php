<?php

namespace App\Event;

/**
 * Interface EventInterface
 * @package App\Event
 */
interface EventInterface
{
    /**
     * Fire an event and call the listeners.
     *
     * @param  string $event
     * @param  mixed $payload
     * @param  bool $halt
     * @return array|null
     */
    public function fire($event, $payload = array(), $halt = false);

    /**
     * Register an event listener with the dispatcher.
     *
     * @param  string|array $event
     * @param  mixed $listener
     * @param  int $priority
     * @return void
     */
    public function listen($events, $listener, $priority = 0);
}