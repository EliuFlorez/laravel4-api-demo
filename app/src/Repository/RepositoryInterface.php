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
     * Retrieve all entities
     *
     * @param array $with
     */
    public function all(array $with = array());

    /**
     * Search by key and value
     *
     * @param string $key
     * @param mixed $value
     * @param array $with
     */
    public function getBy($key, $value, array $with = array());

}