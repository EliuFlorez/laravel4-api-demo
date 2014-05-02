<?php

namespace App\Eloquent;

use App\Repository\Exceptions\ModelNotFoundException;
use App\Repository\RepositoryInterface;
use Illuminate\Database\Eloquent\Model;

/**
 * Class AbstractRepository
 * @package App\Eloquent
 * @author Maxime Beaudoin <maxime.beaudoin@ellipse-synergie.com>
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
     * @throws ModelNotFoundException
     */
    public function find($id, array $with = array())
    {
        $entity = $this->make($with)->find($id);

        if (empty($entity)) {
            throw with(new ModelNotFoundException)->setModel(get_called_class());
        }

        return $entity;
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
     * Search for a single result by key and value
     *
     * @param string $key
     * @param mixed $value
     * @param array $with
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function getFirstBy($key, $value, array $with = array())
    {
        $entity = $this->make($with)->where($key, '=', $value)->first();

        if (empty($entity)) {
            throw with(new ModelNotFoundException)->setModel(get_called_class());
        }

        return $entity;
    }

    /**
     * Search for many results by key and value
     *
     * @param string $key
     * @param mixed $value
     * @param array $with
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getManyBy($key, $value, array $with = array())
    {
        return $this->make($with)->where($key, '=', $value)->get();
    }

    /**
     * Search absences
     *
     * @param array $values
     * @return \Illuminate\Support\Collection
     */
    public function search(array $values)
    {
        //For each search value
        foreach ($values as $field => $value) {

            //If the field is supported, add to the query
            if (in_array($field, $this->model->getFillable())) {
                $query = $this->model->where($field, '=', $value);
            }
        }

        return $query->get();
    }

}