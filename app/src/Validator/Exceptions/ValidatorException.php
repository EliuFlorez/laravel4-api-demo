<?php
namespace App\Validator\Exceptions;

use Illuminate\Validation\Validator;

/**
 * Class ValidatorException
 * @package App\Validator\Exceptions
 * @author Maxime Beaudoin <maxime.beaudoin@ellipse-synergie.com>
 */
class ValidatorException extends \Exception
{

    /**
     *
     * @var \Illuminate\Validation\Validator
     */
    protected $validator;

    /**
     * Create a new validate exception instance.
     *
     * @param Validator $validator
     */
    public function __construct(Validator $validator)
    {
        $this->validator = $validator;

        parent::__construct(null);
    }

    /**
     * Get the validator object.
     *
     * @return Validator
     */
    public function getValidator()
    {
        return $this->validator;
    }
}