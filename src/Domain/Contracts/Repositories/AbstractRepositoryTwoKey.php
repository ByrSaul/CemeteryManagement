<?php

namespace CemeteryManagement\Contracts\Repositories;

use CemeteryManagement\Entities\AbstractEntity;
use CemeteryManagement\Exceptions\NotFoundException;

/**
 * Abstract contract for repositories with two-key entities
 *
 * @package Proaktiv
 */
interface AbstractRepositoryTwoKey extends AbstractRepository
{
    /**
     * Gets an entity from this repository using its key (variable number of arguments)
     *
     * @param   mixed  $key1  Key 1 argument
     * @param   mixed  $key2  Key 2 argument
     *
     * @return  AbstractEntity
     * @throws  NotFoundException
     */
    public function get($key1, $key2);
}
