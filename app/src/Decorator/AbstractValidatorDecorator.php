<?php

namespace App\Decorator;

use App\Repository\CrudableInterface;
use App\Validator\AbstractValidator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

/**
 * Class AbstractValidatorDecorator
 * @package App\Decorator
 * @author Maxime Beaudoin <maxime.beaudoin@ellipse-synergie.com>
 */
abstract class AbstractValidatorDecorator extends AbstractDecorator implements CrudableInterface
{
    /**
     * @var \App\Repository\RepositoryInterface
     */
    protected $repository;

    /**
     * @var \App\Validator\AbstractValidator
     */
    protected $validator;

    /**
     * The resource name
     *
     * @var string
     */
    protected $resource;

    /**
     * @param $repository
     * @param AbstractValidator $validator
     */
    public function __construct($repository, AbstractValidator $validator)
    {
        $this->repository = $repository;
        $this->validator = $validator;
    }

    /**
     * Create a new entity
     *
     * @param array $input
     */
    public function create(array $input)
    {
        $this->validator->isValidForCreation($input);

        return $this->repository->create($input);
    }

    /**
     * Update an existing entity
     *
     * @param int $id
     * @param array $input
     */
    public function update($id, array $input)
    {
        $this->validator->isValidForUpdate($input);

        return $this->repository->update($id, $input);
    }

    /**
     * Delete an existing entity
     *
     * @param int $id
     * @return Model
     */
    public function delete($id)
    {
        $this->validator->isValidForDelete($id);

        return $this->repository->delete($id);
    }

    /**
     * Delete multiple entities
     *
     * @param array $ids
     * @return Collection
     */
    public function deleteByIds($ids)
    {
        $this->validator->isValidForManyDelete($ids);

        return $this->repository->deleteByIds($ids);
    }

    /**
     * Restore a soft deleted entity
     *
     * @param int $id
     * @return Model
     */
    public function restore($id)
    {
        $this->validator->isValidForRestore($id);

        return $this->repository->restore($id);
    }

    /**
     * Restore multiple entities
     *
     * @param array $ids
     * @return Collection
     */
    public function restoreByIds($ids)
    {
        $this->validator->isValidForManyRestore($ids);

        return $this->repository->restoreByIds($ids);
    }
}