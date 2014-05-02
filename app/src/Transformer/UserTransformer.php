<?php
namespace App\Transformer;

use App\Repository\User\User;
use League\Fractal\TransformerAbstract;

/**
 * Class UserTransformer
 * @package App\Transformer
 * @author Maxime Beaudoin <maxime.beaudoin@ellipse-synergie.com>
 */
class UserTransformer extends TransformerAbstract
{
    /**
     * List of resources possible to embed via this transformer
     *
     * @var array
     */
    protected $availableEmbeds = [
        'schools',
        'subjects',
        'unavailabilities'
    ];

    /**
     * Turn this item object into a generic array
     *
     * @return array
     */
    public function transform(User $resource)
    {
        return [
            'id' => (int)$resource->id,
            'email' => $resource->email,
            'firstname' => $resource->firstname,
            'lastname' => $resource->lastname,
            'created_at' => $resource->created_at,
            'updated_at' => $resource->updated_at,
            'deleted_at' => $resource->deleted_at
        ];
    }

    /**
     * @param User $subject
     * @return \League\Fractal\Resource\Item
     */
    public function embedSchools(User $user)
    {
        return $this->collection($user->schools, new SchoolTransformer());
    }

    /**
     * @param User $subject
     * @return \League\Fractal\Resource\Item
     */
    public function embedSubjects(User $user)
    {
        return $this->collection($user->subjects, new AcademicSubjectTransformer());
    }

    /**
     * @param User $subject
     * @return \League\Fractal\Resource\Item
     */
    public function embedUnavailabilities(User $user)
    {
        return $this->collection($user->unavailabilities, new AcademicSubjectTransformer());
    }

}