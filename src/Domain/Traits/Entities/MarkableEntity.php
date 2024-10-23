<?php

namespace CemeteryManagement\Traits\Entities;

/**
 * Trait for Markable Methods
 */
trait MarkableEntity
{
    /**
     * @var string
     */
    protected string $created_from;

    /**
     * @var string
     */
    protected string $updated_from;

    /**
     * @var string | null
     */
    protected ?string $deleted_from;

    /**
     * function to retrieve created from fields
     *
     * @return string
     */
    public function getCreatedFrom(): string
    {
        return $this->created_from;
    }

    /**
     * function to retrieve  updated from fields
     *
     * @return string
     */
    public function getUpdatedFrom(): string
    {
        return $this->updated_from;
    }

    /**
     * function to retrieve deleted from field
     *
     * @return string | null
     */
    public function getDeletedFrom(): ?string
    {
        if (isset($this->deleted_from)) {
            return $this->deleted_from;
        }
        return null;
    }
}
