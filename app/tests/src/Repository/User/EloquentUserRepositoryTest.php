<?php

namespace App\Tests\Repository\User;

use App\Tests\Repository\AbstractEloquentRepositoryTest;
use App\Repository\User\EloquentUserModel;
use App\Repository\User\EloquentUserRepository;

class EloquentUserRepositoryTest extends AbstractEloquentRepositoryTest
{
    protected $create = [];

    protected $update = [];

    protected $getByKey = '';
    protected $getByValue = '';

    public function setUp()
    {
        parent::setUp();

        $this->repository = new EloquentUserRepository(new EloquentUserModel());
    }
}