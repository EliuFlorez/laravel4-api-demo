<?php
namespace App\Validator;

use Validator;
use App\Validator\Exceptions\ValidatorException;

/**
 * Class AbstractValidator
 * @package App\Validator
 * @author Maxime Beaudoin <maxime.beaudoin@ellipse-synergie.com>
 */
class AbstractValidator
{

    /**
     * @var array
     */
    static $rulesForCreation = [];

    /**
     * @var array
     */
    static $rulesForUpdate = [];

    /**
     * @var array
     */
    static $rulesForDelete = [];

    /**
     * @var array
     */
    static $rulesForManyDelete = [];

    /**
     * @var array
     */
    static $rulesForRestore = [];

    /**
     * @var array
     */
    static $rulesForManyRestore = [];

    /**
     *
     * @param array $input
     * @param array $rules
     *
     * @throws ValidatorException
     * @return boolean
     */
    public function validate($input, $rules)
    {
        // Create validator
        $validator = Validator::make($input, $rules);

        if ($validator->fails()) {
            throw new ValidatorException($validator);
        }

        return true;
    }

    /**
     * Is valid for creation ?
     *
     * @param array $input
     * @return bool
     */
    public function isValidForCreation($input)
    {
        return $this->validate($input, static::$rulesForCreation);
    }

    /**
     * Is valid for update ?
     *
     * @param array $input
     * @return bool
     */
    public function isValidForUpdate($input)
    {
        return $this->validate($input, static::$rulesForUpdate);
    }

    /**
     * Is valid for delete ?
     *
     * @param int $id
     * @return bool
     */
    public function isValidForDelete($id)
    {
        return $this->validate($id, static::$rulesForDelete);
    }

    /**
     * Is valid for many delete ?
     *
     * @param array $id
     * @return bool
     */
    public function isValidForManyDelete($ids)
    {
        return $this->validate($ids, static::$rulesForManyDelete);
    }

    /**
     * Is valid for restore ?
     *
     * @param int $id
     * @return bool
     */
    public function isValidForRestore($id)
    {
        return $this->validate($id, static::$rulesForRestore);
    }

    /**
     * Is valid for many restore ?
     *
     * @param array $id
     * @return bool
     */
    public function isValidForManyRestore($ids)
    {
        return $this->validate($ids, static::$rulesForManyRestore);
    }
}