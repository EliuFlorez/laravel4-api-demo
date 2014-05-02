<?php

namespace App\Repository;

/**
 * Interface RepositoryInterface
 * @package App\Repository
 * @author Maxime Beaudoin <maxime.beaudoin@ellipse-synergie.com>
 */
interface RepositoryInterface
{
    /**
     * Search absences
     *
     * @param array $values
     * @return \Illuminate\Support\Collection
     */
    public function search(array $values);

    /**
     * Retrieve all entities
     *
     * @param array $with
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all(array $with = array());

    /**
     * Find a single entity
     *
     * @param int $id
     * @param array $with
     * @return \Illuminate\Database\Eloquent\Model
     * @throws ModelNotFoundException
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
     * Search for a single result by key and value
     *
     * @param string $key
     * @param mixed $value
     * @param array $with
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function getFirstBy($key, $value, array $with = array());

    /**
     * Search for many results by key and value
     *
     * @param string $key
     * @param mixed $value
     * @param array $with
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getManyBy($key, $value, array $with = array());

}