<?php

namespace App\Repository;

/**
 * Interface CrudableInterface
 * @package App\Repository
 * @author Maxime Beaudoin <maxime.beaudoin@ellipse-synergie.com>
 */
interface CrudableInterface
{

    /**
     * Find a single entity
     *
     * @param int $id
     * @param array $with
     */
    public function find($id, array $with = array());

    /**
     * Find multiple entities
     *
     * @param array $ids
     * @return \Illuminate\Support\Collection
     */
    public function findByIds(array $ids);

    /**
     * Create a new entity
     *
     * @param array $input
     */
    public function create(array $input);

    /**
     * Update an existing entity
     *
     * @param int $id
     * @param array $input
     */
    public function update($id, array $input);

    /**
     * Delete an existing entity
     *
     * @param int $id
     * @return boolean
     */
    public function delete($id);

    /**
     * Delete multiple entities
     *
     * @param array $ids
     * @return boolean
     */
    public function deleteByIds($ids);

    /**
     * Restore a soft deleted entity
     *
     * @param int $id
     * @return boolean
     */
    public function restore($id);

    /**
     * Restore multiple entities
     *
     * @param array $ids
     * @return int
     */
    public function restoreByIds($ids);

}