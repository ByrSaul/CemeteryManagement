<?php

namespace CemeteryManagement\Domain\Entities\Cemetery;

use CemeteryManagement\Domain\Entities\AbstractEntity;

class Exhumation extends AbstractEntity
{
    private string $graveId;
    private \DateTime $exhumationDate;

    public function __construct(string $graveId, \DateTime $exhumationDate)
    {
        $this->graveId = $graveId;
        $this->exhumationDate = $exhumationDate;
    }

    public function getGraveId(): string
    {
        return $this->graveId;
    }

    public function getExhumationDate(): \DateTime
    {
        return $this->exhumationDate;
    }
}
