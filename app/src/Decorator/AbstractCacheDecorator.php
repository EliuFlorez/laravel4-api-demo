<?php

namespace App\Decorator;

use App\Cache\CacheInterface;

/**
 * Class AbstractCacheDecorator
 * @package App\Decorator
 * @author Maxime Beaudoin <maxime.beaudoin@ellipse-synergie.com>
 */
abstract class AbstractCacheDecorator extends AbstractDecorator
{
    /**
     * @var mixed
     */
    protected $repository;

    /**
     * @var CacheInterface
     */
    protected $cache;

    /**
     * @param $repository
     * @param CacheInterface $cache
     */
    public function __construct($repository, CacheInterface $cache)
    {
        $this->repository = $repository;
        $this->cache = $cache;
    }

}