<?php

namespace App\Decorator;

use Illuminate\Events\Dispatcher;

/**
 * Class AbstractEventDecorator
 * @package App\Decorator
 * @author Maxime Beaudoin <maxime.beaudoin@ellipse-synergie.com>
 */
abstract class AbstractEventDecorator extends AbstractDecorator
{
    /**
     * @var \App\Repository\RepositoryInterface
     */
    protected $repository;

    /**
     * @var \Illuminate\Events\Dispatcher
     */
    protected $event;

    /**
     * The resource name
     *
     * @var string
     */
    protected $resource;

    /**
     * @param $repository
     * @param Dispatcher $event
     */
    public function __construct($repository, Dispatcher $event)
    {
        $this->repository = $repository;
        $this->event = $event;
    }


    /**
     * Find a single entity
     *
     * @param int $id
     * @param array $with
     */
    public function find($id, array $with = array())
    {
        $resource = $this->repository->find($id, $with);

        $this->event->fire($this->resource . '.find', $resource);

        return $resource;
    }

    /**
     * Create a new entity
     *
     * @param array $input
     */
    public function create(array $input)
    {
        $resource = $this->repository->create($input);

        $this->event->fire($this->resource . '.create', $resource);

        return $resource;
    }

    /**
     * Update an existing entity
     *
     * @param int $id
     * @param array $input
     */
    public function update($id, array $input)
    {
        $resource = $this->repository->update($id, $input);

        $this->event->fire($this->resource . '.update', $resource);

        return $resource;
    }

    /**
     * Delete an existing entity
     *
     * @param int $id
     * @return boolean
     */
    public function delete($id)
    {
        $resource = $this->repository->delete($id);

        $this->event->fire($this->resource . '.delete', $resource);

        return $resource;
    }

    /**
     * Restore a soft deleted entity
     *
     * @param int $id
     * @return boolean
     */
    public function restore($id)
    {
        $resource = $this->repository->restore($id);

        $this->event->fire($this->resource . '.restore', $resource);

        return $resource;
    }

    /**
     * Find multiple entities
     *
     * @param array $ids
     * @return \Illuminate\Support\Collection
     */
    public function findByIds(array $ids)
    {
        $resources = $this->repository->findByIds($ids);

        $this->event->fire($this->resource . '.find.multiple', $resources);

        return $resources;
    }

    /**
     * Delete multiple entities
     *
     * @param array $ids
     * @return boolean
     */
    public function deleteByIds($ids)
    {
        $resources = $this->repository->deleteByIds($ids);

        $this->event->fire($this->resource . '.delete.multiple', $resources);

        return $resources;
    }

    /**
     * Restore multiple entities
     *
     * @param array $ids
     * @return int
     */
    public function restoreByIds($ids)
    {
        $resources = $this->repository->restoreByIds($ids);

        $this->event->fire($this->resource . '.restore.multiple', $resources);

        return $resources;
    }
}