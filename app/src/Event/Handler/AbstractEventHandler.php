<?php

namespace App\Event\Handler;

use Event;
use Illuminate\Events\Dispatcher;
use Log;

/**
 * Class AbstractEventHandler
 * @package App\Event\Handler
 * @author Maxime Beaudoin <maxime.beaudoin@ellipse-synergie.com>
 */
abstract class AbstractEventHandler
{
    /**
     * The resource name
     *
     * @var string
     */
    protected $resource;

    /**
     * Register the listeners for the subscriber.
     *
     * @param \Illuminate\Events\Dispatcher $events
     * @return array
     */
    public function subscribe(Dispatcher $events)
    {
        $events->listen($this->resource . '.*', get_called_class() . '@onEvents');
        $events->listen($this->resource . '.create', get_called_class() . '@onCreate');
        $events->listen($this->resource . '.delete', get_called_class() . '@onDelete');
        $events->listen($this->resource . '.delete.multiple', get_called_class() . '@onDeleteMultiple');
        $events->listen($this->resource . '.restore', get_called_class() . '@onRestore');
        $events->listen($this->resource . '.restore.multiple', get_called_class() . '@onRestoreMultiple');
    }

    /**
     * Handle generic resource event
     *
     * @param $resource
     */
    public function onEvents($resource)
    {
        //
        Log::info('[Event fired "' . Event::firing() . '"]');

        //
        Log::info($resource);
    }
}