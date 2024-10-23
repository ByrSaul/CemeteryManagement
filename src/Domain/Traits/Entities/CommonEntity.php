<?php

namespace CemeteryManagement\Traits\Entities;

/**
 * Trait for Commos properties into Entities
 */
trait CommonEntity
{
    /**
     * @var int
     */
    protected int $id;

    /**
     * id getter
     *
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }
}
