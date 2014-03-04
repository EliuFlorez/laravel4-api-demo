<?php
namespace App\Validator;

use Validator;
use App\Validator\Exceptions\ValidatorException;

/**
 * Class Validator
 *
 * @author Maxime Beaudoin <maxime.beaudoin@ellipse-synergie.com>
 * @package App\Validator
 */
class Validator
{

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
}