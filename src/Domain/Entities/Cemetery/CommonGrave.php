<?php

namespace CemeteryManagement\Entities\Cemetery;

use CemeteryManagement\Domain\Entities\AbstractEntity;

class CommonGrave extends AbstractEntity
{
    private int $capacity;
    private array $deceasedIds;

    public function __construct(int $capacity)
    {
        $this->capacity = $capacity;
        $this->deceasedIds = [];
    }

    public function getCapacity(): int
    {
        return $this->capacity;
    }

    public function addDeceased(string $deceasedId): void
    {
        if (count($this->deceasedIds) < $this->capacity) {
            $this->deceasedIds[] = $deceasedId;
        } else {
            throw new \Exception("Common grave is full.");
        }
    }
}
