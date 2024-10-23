<?php

namespace CemeteryManagement\Traits\Entities;

use Carbon\Carbon;

/**
 * Trait for Soft Deleted Methods
 */
trait SoftDeletableEntity
{
    /**
     * @var string|null
     */
    protected ?string $deleted_at = null;

    /**
     * @var int|null
     */
    protected ?int $deleted_by = null;

    /**
     * Gets for deleted fields
     *
     * @return Carbon|null
     */
    public function getDeletedAt(): ?Carbon
    {
        if (isset($this->deleted_at)) {
            return Carbon::parse($this->deleted_at);
        }
        return null;
    }

    /**
     * Function to retrieve deleted by field
     *
     * @return int | null
     */
    public function getDeletedBy(): ?int
    {
        if (isset($this->deleted_by)) {
            return $this->deleted_by;
        }
        return null;
    }
}
