<?php

namespace CemeteryManagement\Contracts\Repositories;

/**
 * Abstract contract for repositories with multi-key entities
 *
 * @package Proaktiv
 */
interface AbstractRepositoryElevenKey extends AbstractRepository
{
    /**
     * Gets an entity from this repository using its key (variable number of arguments)
     *
     * @param   mixed  $key1  Key 1 argument
     * @param   mixed  $key2  Key 2 argument
     * @param   mixed  $key3  Key 3 argument
     * @param   mixed  $key4  Key 4 argument
     * @param   mixed  $key5  Key 5 argument
     * @param   mixed  $key6  Key 6 argument
     * @param   mixed  $key7  Key 7 argument
     * @param   mixed  $key8  Key 8 argument
     * @param   mixed  $key9  Key 9 argument
     * @param   mixed  $key10  Key 10 argument
     * @param   mixed  $key11  Key 11 argument
     */
    public function get(
        mixed $key1,
        mixed $key2,
        mixed $key3,
        mixed $key4,
        mixed $key5,
        mixed $key6,
        mixed $key7,
        mixed $key8,
        mixed $key9,
        mixed $key10,
        mixed $key11
    );
}
