<?php

namespace App\Repository;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

/**
 * Interface CrudableInterface
 * @package App\Repository
 * @author Maxime Beaudoin <maxime.beaudoin@ellipse-synergie.com>
 */
interface CrudableInterface
{
    /**
     * Create a new entity
     *
     * @param array $input
     * @return Model
     */
    public function create(array $input);

    /**
     * Update an existing entity
     *
     * @param int $id
     * @param array $input
     * @return Model
     */
    public function update($id, array $input);

    /**
     * Delete an existing entity
     *
     * @param int $id
     * @return Model
     */
    public function delete($id);

    /**
     * Delete multiple entities
     *
     * @param array $ids
     * @return Collection
     */
    public function deleteByIds($ids);

    /**
     * Restore a soft deleted entity
     *
     * @param int $id
     * @return Model
     */
    public function restore($id);

    /**
     * Restore multiple entities
     *
     * @param array $ids
     * @return Collection
     */
    public function restoreByIds($ids);

}