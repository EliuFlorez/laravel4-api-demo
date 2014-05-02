<?php

namespace App\Transformer;

use App\Repository\Account\Account;
use League\Fractal\TransformerAbstract;

/**
 * Class AccountTransformer
 * @package App\Transformer
 * @author Maxime Beaudoin <maxime.beaudoin@ellipse-synergie.com>
 */
class AccountTransformer extends TransformerAbstract
{
    /**
     * List of resources possible to embed via this transformer
     *
     * @var array
     */
    protected $availableEmbeds = [
        'owner',
        'schools',
        'invites'
    ];

    protected $defaultEmbeds = [
    ];

    /**
     * Turn this item object into a generic array
     *
     * @return array
     */
    public function transform(Account $resource)
    {
        return [
            'id' => (int)$resource->id,
            'user_id' => (int)$resource->user_id,
            'name' => $resource->name,
            'slug' => $resource->slug,
            'settings' => $resource->settings,
            'created_at' => $resource->created_at,
            'updated_at' => $resource->updated_at,
            'deleted_at' => $resource->deleted_at
        ];
    }

    /**
     * @param Account $account
     * @return \League\Fractal\Resource\Item
     */
    public function embedOwner(Account $account)
    {
        return $this->item($account->owner, new UserTransformer);
    }

    /**
     * @param Account $account
     * @return \League\Fractal\Resource\Collection
     */
    public function embedSchools(Account $account)
    {
        return $this->collection($account->schools, new SchoolTransformer());
    }

    /**
     * @param Account $account
     * @return \League\Fractal\Resource\Collection
     */
    public function embedInvites(Account $account)
    {
        return $this->collection($account->invites, new InviteTransformer());
    }
}