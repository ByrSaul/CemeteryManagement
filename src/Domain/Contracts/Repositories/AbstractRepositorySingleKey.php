<?php

namespace CemeteryManagement\Contracts\Repositories;

use CemeteryManagement\Entities\AbstractEntity;
use CemeteryManagement\Exceptions\NotFoundException;

/**
 * Abstract contract for repositories of single-key entities
 *
 * @package Proaktiv
 */
interface AbstractRepositorySingleKey extends AbstractRepository
{
    /**
     * Returns an entity from the repository, handled by its id
     *
     * @param   mixed  $entityId  Entity to find
     *
     * @return  AbstractEntity
     * @throws  NotFoundException
     */
    public function get(mixed $entityId): AbstractEntity;
}