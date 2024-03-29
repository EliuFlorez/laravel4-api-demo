<?php

namespace App\Repository\Exceptions;

/**
 * Class ModelNotFoundException
 * @package App\Repository\Exceptions
 * @author Maxime Beaudoin <maxime.beaudoin@ellipse-synergie.com>
 */
class ModelNotFoundException extends \RuntimeException
{

    /**
     * Name of the affected Eloquent model.
     *
     * @var string
     */
    protected $model;

    /**
     * Set the affected Eloquent model.
     *
     * @param  string $model
     * @return ModelNotFoundException
     */
    public function setModel($model)
    {
        $this->model = $model;

        $this->message = "No query results for model [{$model}].";

        return $this;
    }

    /**
     * Get the affected Eloquent model.
     *
     * @return string
     */
    public function getModel()
    {
        return $this->model;
    }

}