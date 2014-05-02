<?php

namespace App\Eloquent;

use App\Repository\Exceptions\ModelNotFoundException;
use StdClass;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use App\Context\Context;

/**
 * Class AbstractContextRepository
 * @package App\Eloquent
 */
abstract class AbstractContextRepository extends AbstractRepository
{
    /**
     * @var Model
     */
    protected $model;

    /**
     * @var Context
     */
    protected $scope;

    /**
     * Construct
     *
     * @param \App\Context\Context $context
     * @param \Illuminate\Database\Eloquent\Model $model
     */
    public function __construct(Model $model, Context $scope)
    {
        $this->model = $model;
        $this->scope = $scope;
    }

    /**
     * Scope a query based upon a column name
     *
     * @param \Illuminate\Database\Eloquent\Builder
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeColumn(Builder $model)
    {
        if ($this->scope->has()) {
            return $model
                ->whereIn($this->scope->accountColumn(), $this->scope->accountIds());
        }

        return $model;
    }

    /**
     * Scope the query based upon a relationship
     *
     * @param \Illuminate\Database\Eloquent\Builder
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeRelationship(Builder $model)
    {
        if ($this->scope->has()) {
            return $model->whereHas($this->scope->accountTable(), function ($q) {
                $q->whereIn($this->scope->accountColumn(), $this->scope->accountIds());
            });
        }

        return $model;
    }

    /**
     * Retrieve all entities through a scoped column
     *
     * @param array $with
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function allThroughColumn(array $with = array())
    {
        $entity = $this->make($with);

        return $this->scopeColumn($entity)->get();
    }

    /**
     * Retrieve all entities through a scoped relationship
     *
     * @param array $with
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function allThroughRelationship(array $with = array())
    {
        $entity = $this->make($with);

        return $this->scopeRelationship($entity)->get();
    }

    /**
     * Find a single entity through a scoped column
     *
     * @param int $id
     * @param array $with
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function findThroughColumn($id, array $with = array())
    {
        $entity = $this->make($with);

        return $this->scopeColumn($entity)->find($id);
    }

    /**
     * Find a single entity through a scoped relationship
     *
     * @param int $id
     * @param array $with
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function findThroughRelationship($id, array $with = array())
    {
        $entity = $this->make($with);

        return $this->scopeRelationship($entity)->find($id);
    }

    /**
     * Get Results by Page through scoped column
     *
     * @param int $page
     * @param int $limit
     * @param array $with
     * @return StdClass Object with $items and $totalItems for pagination
     */
    public function getByPageThroughColumn($page = 1, $limit = 10, $with = array())
    {
        $result = new StdClass;
        $result->page = $page;
        $result->limit = $limit;
        $result->totalItems = 0;
        $result->items = array();

        $query = $this->scopeColumn($this->make($with));

        $users = $query->skip($limit * ($page - 1))
            ->take($limit)
            ->get();

        $result->totalItems = $this->model->count();
        $result->items = $users->all();

        return $result;
    }

    /**
     * Get Results by Page through scoped relationship
     *
     * @param int $page
     * @param int $limit
     * @param array $with
     * @return StdClass Object with $items and $totalItems for pagination
     */
    public function getByPageThroughRelationship($page = 1, $limit = 10, $with = array())
    {
        $result = new StdClass;
        $result->page = $page;
        $result->limit = $limit;
        $result->totalItems = 0;
        $result->items = array();

        $query = $this->scopeRelationship($this->make($with));

        $users = $query->skip($limit * ($page - 1))
            ->take($limit)
            ->get();

        $result->totalItems = $this->model->count();
        $result->items = $users->all();

        return $result;
    }

    /**
     * Search for a single result by key and value through a scoped column
     *
     * @param string $key
     * @param mixed $value
     * @param array $with
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function getFirstByThroughColumn($key, $value, array $with = array())
    {
        $entity = $this->make($with);

        return $this->scopeColumn($entity)->where($key, '=', $value)->first();
    }

    /**
     * Search for a single result by key and value through a scoped relationship
     *
     * @param string $key
     * @param mixed $value
     * @param array $with
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function getFirstByThroughRelationship($key, $value, array $with = array())
    {
        $entity = $this->make($with);

        return $this->scopeRelationship($entity)->where($key, '=', $value)->first();
    }

    /**
     * Search for many results by key and value through a scoped column
     *
     * @param string $key
     * @param mixed $value
     * @param array $with
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getManyByThroughColumn($key, $value, array $with = array())
    {
        $entity = $this->make($with);

        return $this->scopeColumn($entity)->where($key, '=', $value)->get();
    }

    /**
     * Search for many results by key and value through a scoped relationship
     *
     * @param string $key
     * @param mixed $value
     * @param array $with
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getManyByThroughRelationship($key, $value, array $with = array())
    {
        $entity = $this->make($with);

        return $this->scopeRelationship($entity)->where($key, '=', $value)->get();
    }

    /**
     * Return all projects
     *
     * @param array $with
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all(array $with = array())
    {
        return $this->allThroughColumn($with);
    }

    /**
     * Return a single project
     *
     * @param array $with
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function find($id, array $with = array())
    {
        $entity = $this->findThroughColumn($id, $with);

        if (empty($entity)) {
            throw with(new ModelNotFoundException())->setModel(get_called_class());
        }

        return $entity;
    }

    /**
     * Get Results by Page
     *
     * @param int $page
     * @param int $limit
     * @param array $with
     * @return StdClass Object with $items and $totalItems for pagination
     */
    public function getByPage($page = 1, $limit = 10, $with = array())
    {
        return $this->getByPageThroughColumn($page, $limit, $with);
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
        $entity = $this->getFirstByThroughColumn($key, $value, $with);

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
        return $this->getManyByThroughColumn($key, $value, $with);
    }

}