<?php

namespace App\Eloquent;

use App\Repository\RepositoryInterface;
use Illuminate\Database\Eloquent\Model;

/**
 * Class AbstractRepository
 * @package App\Eloquent
 */
abstract class AbstractRepository implements RepositoryInterface
{

    /**
     * @var \Illuminate\Database\Eloquent\Model
     */
    protected $model;

    /**
     * Construct
     *
     * @param \Illuminate\Database\Eloquent\Model
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * Make a new instance of the entity to query on
     *
     * @param array $with
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function make(array $with = array())
    {
        return $this->model->with($with);
    }

    /**
     * Retrieve all entities
     *
     * @param array $with
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all(array $with = array())
    {
        $entity = $this->make($with);

        return $entity->get();
    }

    /**
     * Find a single entity
     *
     * @param int $id
     * @param array $with
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function find($id, array $with = array())
    {
        $entity = $this->make($with);

        return $entity->find($id);
    }

    /**
     * Find multiple entities
     *
     * @param array $ids
     * @return \Illuminate\Support\Collection
     */
    public function findByIds(array $ids)
    {
        return $this->model->whereIn($this->model->getKeyName(), $ids)->get();
    }

    /**
     * Search for many results by key and value
     *
     * @param string $key
     * @param mixed $value
     * @param array $with
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getBy($key, $value, array $with = array())
    {
        return $this->make($with)->where($key, '=', $value)->get();
    }

}