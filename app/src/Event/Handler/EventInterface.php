<?php

namespace App\Event\Handler;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

/**
 * Interface EventInterface
 * @package App\Event\Handler
 * @author Maxime Beaudoin <maxime.beaudoin@ellipse-synergie.com>
 */
interface EventInterface
{
    /**
     * Handle create events.
     *
     * @param Model $resource
     */
    public function onCreate(Model $resource);

    /**
     * Handle update events.
     *
     * @param Model $resource
     */
    public function onUpdate(Model $resource);

    /**
     * Handle delete events.
     */
    public function onDelete(Model $resource);

    /**
     * Handle delete multiple resource events.
     */
    public function onDeleteMultiple(Collection $resources);

    /**
     * Handle restore events.
     */
    public function onRestore(Model $resource);

    /**
     * Handle restore multiple resource events.
     */
    public function onRestoreMultiple(Collection $resources);
}