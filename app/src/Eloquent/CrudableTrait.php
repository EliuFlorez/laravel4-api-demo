<?php

namespace App\Eloquent;

use App\Repository\Exceptions\ModelNotFoundException;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class CrudableTrait
 * @package App\Eloquent
 * @author Maxime Beaudoin <maxime.beaudoin@ellipse-synergie.com>
 */
trait CrudableTrait
{
    /**
     * Create a new entity
     *
     * @param array $data
     * @return Model
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
     * @return Model
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
     * @return Model
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
     * @return Collection
     */
    public function deleteByIds($ids)
    {
        $resources = $this->model->whereIn($this->model->getKeyName(), $ids)->get();

        foreach ($resources as $resource) {
            $resource->delete();
        }

        return $resources;
    }

    /**
     * Restore a soft deleted entity
     *
     * @param int $id
     * @return Model
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
     * @return Collection
     */
    public function restoreByIds($ids)
    {
        $resources = $this->model->withTrashed()->whereIn($this->model->getKeyName(), $ids)->get();

        foreach ($resources as $resource) {
            $resource->restore();
        }

        return $resources;
    }

}