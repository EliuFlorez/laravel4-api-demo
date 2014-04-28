<?php

namespace App\Eloquent;

/**
 * Class PaginableTrait
 * @package App\Eloquent
 * @author Maxime Beaudoin <maxime.beaudoin@ellipse-synergie.com>
 */
trait PaginableTrait
{
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
        $result = new \StdClass;
        $result->page = $page;
        $result->limit = $limit;
        $result->totalItems = 0;
        $result->items = array();

        $query = $this->make($with);

        $resources = $query->skip($limit * ($page - 1))
            ->take($limit)
            ->get();

        $result->totalItems = $this->model->count();
        $result->items = $resources;

        return $result;
    }

}