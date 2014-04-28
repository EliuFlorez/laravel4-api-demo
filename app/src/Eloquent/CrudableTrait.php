<?php

namespace App\Eloquent;

use App\Repository\Exceptions\ModelNotFoundException;

/**
 * Class CrudableTrait
 * @package App\Eloquent
 */
trait CrudableTrait
{
    /**
     * Create a new entity
     *
     * @param array $data
     */
    public function create(array $input)
    {
        return $this->model->create($input);
    }

    /**
     * Update an existing entity
     *
     * @param int $id
     * @param array $input
     */
    public function update($id, array $input)
    {
        $resource = $this->find($id);

        if ($resource) {
            $resource->fill($input);

            $resource->update();

            return $resource;
        } else {
            throw with(new ModelNotFoundException)->setModel(get_called_class());
        }
    }

    /**
     * Delete an existing entity
     *
     * @param int $id
     * @return boolean
     */
    public function delete($id)
    {
        $resource = $this->find($id);

        if ($resource) {

            $resource->delete();

            return $resource;
        } else {
            throw with(new ModelNotFoundException)->setModel(get_called_class());
        }
    }

    /**
     * Delete multiple entities
     *
     * @param array $ids
     * @return boolean
     */
    public function deleteByIds($ids)
    {
        return $this->model->destroy($ids);
    }

    /**
     * Restore a soft deleted entity
     *
     * @param int $id
     * @return boolean
     */
    public function restore($id)
    {
        $resource = $this->model->withTrashed()->find($id);

        if ($resource) {

            $resource->restore();

            return $resource;
        } else {
            throw with(new ModelNotFoundException)->setModel(get_called_class());
        }
    }

    /**
     * Restore multiple entities
     *
     * @param array $ids
     * @return int
     */
    public function restoreByIds($ids)
    {
        $resources = $this->model->withTrashed()->whereIn($this->model->getKeyName(), $ids)->get();

        foreach ($resources as $resource) {
            $resource->restore();
        }

        return $resources->count();
    }

}