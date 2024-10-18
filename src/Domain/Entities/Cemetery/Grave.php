<?php

namespace CemeteryManagement\Domain\Entities\Cemetery;

use CemeteryManagement\Domain\Entities\AbstractEntity;

class Grave extends AbstractEntity
{
    private string $location;
    private string $leaseContractId;

    public function __construct(string $location, string $leaseContractId)
    {
        $this->location = $location;
        $this->leaseContractId = $leaseContractId;
    }

    public function getLocation(): string
    {
        return $this->location;
    }

    public function getLeaseContractId(): string
    {
        return $this->leaseContractId;
    }
}
