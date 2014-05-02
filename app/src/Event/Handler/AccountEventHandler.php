<?php


namespace App\Event\Handler;

use App\Repository\AccountRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Log;
use Event;

/**
 * Class AccountEventHandler
 * @package App\Event
 * @author Maxime Beaudoin <maxime.beaudoin@ellipse-synergie.com>
 */
class AccountEventHandler extends AbstractEventHandler implements EventInterface
{
    /**
     * The resource name
     *
     * @var string
     */
    protected $resource = 'account';

    /**
     * Handle create events.
     *
     * @param Model $resource
     */
    public function onCreate(Model $resource)
    {
        // TODO: Implement onCreate() method.
    }

    /**
     * Handle update events.
     *
     * @param Model $resource
     */
    public function onUpdate(Model $resource)
    {
        // TODO: Implement onUpdate() method.
    }

    /**
     * Handle delete events.
     */
    public function onDelete(Model $resource)
    {
        // TODO: Implement onDelete() method.
    }

    /**
     * Handle delete multiple resource events.
     */
    public function onDeleteMultiple(Collection $resources)
    {
        // TODO: Implement onDeleteMultiple() method.
    }

    /**
     * Handle restore events.
     */
    public function onRestore(Model $resource)
    {
        // TODO: Implement onRestore() method.
    }

    /**
     * Handle restore multiple resource events.
     */
    public function onRestoreMultiple(Collection $resources)
    {
        // TODO: Implement onRestoreMultiple() method.
    }


}