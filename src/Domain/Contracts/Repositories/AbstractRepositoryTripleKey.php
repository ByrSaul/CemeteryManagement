<?php

namespace CemeteryManagement\Contracts\Repositories;

use CemeteryManagement\Entities\AbstractEntity;
use CemeteryManagement\Exceptions\NotFoundException;

/**
 * Abstract contract for repositories with multi-key entities
 *
 * @package Proaktiv
 */
interface AbstractRepositoryTripleKey extends AbstractRepository
{
    /**
     * Gets an entity from this repository using its key (variable number of arguments)
     *
     * @param   mixed  $key1  Key 1 argument
     * @param   mixed  $key2  Key 2 argument
     * @param   mixed  $key3  Key 3 argument
     *
     * @return  AbstractEntity
     * @throws  NotFoundException
     */
    public function get($key1, $key2, $key3);
}
