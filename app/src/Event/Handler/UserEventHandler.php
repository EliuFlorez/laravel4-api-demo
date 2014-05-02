<?php
namespace App\Event\Handler;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Events\Dispatcher;
use Illuminate\Support\Collection;
use Log;
use Mail;
use App\Repository\User\User;

/**
 * Class UserEventHandler
 * @package App\Event
 * @author Maxime Beaudoin <maxime.beaudoin@ellipse-synergie.com>
 */
class UserEventHandler extends AbstractEventHandler implements EventInterface
{
    /**
     * The resource name
     *
     * @var string
     */
    protected $resource = 'user';

    /**
     * Register the listeners for the subscriber.
     *
     * @param \Illuminate\Events\Dispatcher $events
     * @return array
     */
    public function subscribe(Dispatcher $events)
    {
        parent::subscribe($events);

        //Add user event
        $events->listen('user.forgot.password', 'App\Event\Handler\UserEventHandler@onForgotPassword');
        $events->listen('user.reset.password', 'App\Event\Handler\UserEventHandler@onResetPassword');
    }

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

    /**
     * Handle user forgot password events.
     *
     * @param User $user
     * @param string $redirectUrl
     */
    public function onForgotPassword(Model $resource, $redirectUrl)
    {
        //
        Log::info('Push the forgot password mail to the queue');

        //Create email data
        $data = array(
            'email' => $resource->email,
            'key' => $resource->reset_password_code,
            'redirect_url' => $redirectUrl
        );

        // Now you can send this code to your user via email for example.
        Mail::queue('emails.auth.reminder', $data, function ($message) use ($resource) {

            //Build the message
            $message->to($resource->email, $resource->name)
                ->subject('Renouvellement du mot de passe');
        });
    }

    /**
     * Handle reset password events.
     *
     * @param User $user
     */
    public function onResetPassword(User $user)
    {
        // TODO: Implement onRestoreMultiple() method.
    }
}