<?php

namespace CemeteryManagement\Traits\Entities;

/**
 * Trait for active field properties
 */
trait ActivableEntity
{
    /**
     * @var int $active;
     */
    protected int $active;

    /**
     * function retrieve active field
     *
     * @return int
     */
    public function getActive(): int
    {
        return $this->active;
    }
}
