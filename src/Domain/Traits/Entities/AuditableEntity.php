<?php

namespace CemeteryManagement\Traits\Entities;

use Carbon\Carbon;

/**
 * Traits for Auditable methods
 */
trait AuditableEntity
{
    /**
     * @var string
     */
    protected string $created_at;

    /**
     * @var int
     */
    protected int $created_by;

    /**
     * @var string
     */
    protected string $updated_at;

    /**
     * @var int
     */
    protected int $updated_by;

    /**
     * function retrieve to date created at field
     *
     * @return Carbon
     */
    public function getCreatedAt(): Carbon
    {
        return Carbon::parse($this->created_at);
    }

    /**
     * function retrieve user created by field
     *
     * @return int
     */
    public function getCreatedBy(): int
    {
        return $this->created_by;
    }

    /**
     * function retrieve to date update field
     *
     * @return Carbon
     */
    public function getUpdatedAt(): Carbon
    {
        return Carbon::parse($this->updated_at);
    }

    /**
     * function retrieve updated by field
     *
     * @return int
     */
    public function getUpdatedBy(): int
    {
        return $this->updated_by;
    }
}
