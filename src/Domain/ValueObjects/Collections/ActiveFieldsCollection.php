<?php

namespace CemeteryManagement\ValueObjects\Collections;

use CemeteryManagement\Entities\AbstractEntity;
use Countable;
use Iterator;
use JsonSerializable;
use OverflowException;
use CemeteryManagement\ValueObjects\Data\ActiveField;
use UnexpectedValueException;

/**
 * Collections of entities
 *
 * @package Proaktiv
 */
class ActiveFieldsCollection extends Collection implements Countable, Iterator, JsonSerializable
{
    /**
     * Adds a new Entity to the Collections.
     * This method supports chaining.
     *
     * @param AbstractEntity $entity Entity to add to the collection.
     *
     * @return  self
     * @throws OverflowException If you're trying to add a repeated Entity to the Collections.
     * @throws UnexpectedValueException If you're trying to insert something that is not an Entity
     */
    public function add(ActiveField $fields): self
    {
        // Adds field properties to the collection.
        $this->collection[] = $fields;

        // Returns this instance.
        return $this;
    }
}
