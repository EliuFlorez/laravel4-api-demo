<?php

namespace App\Validator;

/**
 * Class AccountValidator
 * @package App\Validator
 * @author Maxime Beaudoin <maxime.beaudoin@ellipse-synergie.com>
 */
class AccountValidator extends AbstractValidator
{
    static $rulesForCreation = [
        'user_id' => [
            'required',
            'integer'
        ],
        'name' => [
            'required',
            'max:100',
            'min:5'
        ],
        'slug' => [
            'required',
            'unique:accounts'
        ]
    ];

    static $rulesForUpdate = [
        'user_id' => 'integer',
        'name' => [
            'max:100',
            'min:5'
        ]
    ];

    static $rulesForDelete = [
        'account_id' => [
            'required',
            'integer',
            'has_access'
        ]
    ];
}