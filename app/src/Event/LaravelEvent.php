<?php

namespace App\Event;

use Illuminate\Events\Dispatcher;

/**
 * Class LaravelEvent
 * @package App\Event
 * @author Maxime Beaudoin <maxime.beaudoin@ellipse-synergie.com>
 */
class LaravelEvent implements EventInterface
{

    /**
     * @var EventInterface
     */
    protected $event;

    /**
     * @param EventInterface $event
     */
    public function __construct(Dispatcher $event)
    {
        $this->event = $event;
    }

    /**
     * Fire an event and call the listeners.
     *
     * @param  string $event
     * @param  mixed $payload
     * @param  bool $halt
     * @return array|null
     */
    public function fire($event, $payload = array(), $halt = false)
    {
        return $this->event->fire($event, $payload, $halt);
    }

    /**
     * Register an event listener with the dispatcher.
     *
     * @param  string|array $event
     * @param  mixed $listener
     * @param  int $priority
     * @return void
     */
    public function listen($events, $listener, $priority = 0)
    {
        $this->event->listen($events, $listener, $priority);
    }
}