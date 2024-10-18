<?php

namespace CemeteryManagement\Domain\Entities\Cemetery;

use CemeteryManagement\Domain\Entities\AbstractEntity;

class LeaseContract extends AbstractEntity
{
    private string $graveId;
    private \DateTime $startDate;
    private \DateTime $endDate;

    public function __construct(string $graveId, \DateTime $startDate, \DateTime $endDate)
    {
        $this->graveId = $graveId;
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }

    public function getGraveId(): string
    {
        return $this->graveId;
    }

    public function getStartDate(): \DateTime
    {
        return $this->startDate;
    }

    public function getEndDate(): \DateTime
    {
        return $this->endDate;
    }
}
