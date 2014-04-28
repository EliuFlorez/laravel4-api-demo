<?php

namespace App\Tests\Repository;

abstract class AbstractEloquentRepositoryTest extends \TestCase
{
    /**
     * @var EloquentResourceRepository
     */
    protected $repository;

    protected $create;
    protected $update;
    protected $getByKey;
    protected $getByValue;

    public function testRepositoryDependUpon()
    {
        $this->assertInstanceOf('App\Repository\RepositoryInterface', $this->repository);
        $this->assertInstanceOf('App\Repository\CrudableInterface', $this->repository);
        $this->assertInstanceOf('App\Repository\PaginableInterface', $this->repository);
    }

    public function testCreateResourceWorkProperly()
    {
        $resource = $this->repository->create($this->create);

        foreach ($this->create as $key => $value) {
            $this->assertEquals($value, $resource->$key);
        }
    }

    public function testUpdateResourceWorkProperly()
    {
        $resource = $this->repository->update(1, $this->update);

        foreach ($this->update as $key => $value) {
            $this->assertEquals($value, $resource->$key);
        }
    }

    public function testDeleteResourceWorkProperly()
    {
        $resource = $this->repository->delete(1);
        $this->assertNotEmpty($resource->deleted_at);
    }

    public function testRestoreWorkProperly()
    {
        $resource = $this->repository->restore(1);
        $this->assertEmpty($resource->deleted_at);
    }

    public function testFindResourceWorkProperly()
    {
        $resource = $this->repository->find(1);

        $this->assertEquals(1, $resource->id);
    }

    public function testGetAllResourceWorkProperly()
    {
        $resources = $this->repository->all();

        $this->assertEquals(1, $resources->first()->id);
    }

    public function testGetByWorkProperly()
    {
        $resources = $this->repository->getBy($this->getByKey, $this->getByValue);

        $this->assertEquals(1, $resources->first()->id);
        $this->assertEquals($this->getByValue, $resources->first()->{$this->getByKey});
    }

    public function testGetByPageWorkProperly()
    {
        $resources = $this->repository->getByPage(1, 10);

        $this->assertEquals(1, $resources->items->first()->id);
    }

    public function testFindByIdsWorkProperly()
    {
        //Create a new resource
        $this->repository->create($this->create);

        $resources = $this->repository->findByIds([1, 2]);

        $this->assertSame(2, $resources->count());
        $this->assertEquals('1', $resources[0]->id);
        $this->assertEquals('2', $resources[1]->id);
    }

    public function testDeleteByIdsWorkProperly()
    {
        $this->assertSame(2, $this->repository->deleteByIds([1, 2]));
        $resources = $this->repository->findByIds([1, 2]);

        $this->assertSame(0, $resources->count());
    }

    public function testRestoreByIdsWorkProperly()
    {
        $this->assertSame(2, $this->repository->restoreByIds([1, 2]));
        $resources = $this->repository->findByIds([1, 2]);

        $this->assertSame(2, $resources->count());
    }

    /**
     * @expectedException \App\Repository\Exceptions\ModelNotFoundException
     */
    public function testDeleteResourceFailBecauseNotFound()
    {
        $this->repository->delete(99999);
    }

    /**
     * @expectedException \App\Repository\Exceptions\ModelNotFoundException
     */
    public function testUpdateResourceFailBecauseNotFound()
    {
        $this->repository->update(99999, $this->update);
    }

    /**
     * @expectedException \App\Repository\Exceptions\ModelNotFoundException
     */
    public function testRestoreResourceFailBecauseNotFound()
    {
        $this->repository->restore(99999);
    }
}