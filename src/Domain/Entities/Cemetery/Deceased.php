<?php

namespace CemeteryManagement\Domain\Entities\Cemetery;

use CemeteryManagement\Domain\Entities\AbstractEntity;

class Deceased extends AbstractEntity
{
    private string $name;
    private \DateTime $dateOfDeath;

    public function __construct(string $name, \DateTime $dateOfDeath)
    {
        $this->name = $name;
        $this->dateOfDeath = $dateOfDeath;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getDateOfDeath(): \DateTime
    {
        return $this->dateOfDeath;
    }
}
