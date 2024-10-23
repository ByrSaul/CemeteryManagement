<?php

namespace CemeteryManagement\ValueObjects\Collections;

use Countable;
use Iterator;
use JsonSerializable;
use CemeteryManagement\Contracts\IsAggregate;
use UnexpectedValueException;

/**
 * Collections of aggregate objects
 *
 * @package Proaktiv
 */
class AggregateCollection extends Collection implements Countable, Iterator, JsonSerializable
{
    /**
     * Adds a new aggregate object to the Collections.
     * This method supports chaining.
     *
     * @param IsAggregate $aggregate Aggregate object to add to the collection.
     *
     * @return  self
     */
    public function add(IsAggregate $aggregate): self
    {
        // Adds a aggregate object to the collection.
        $this->collection[] = $aggregate;

        // Returns this instance.
        return $this;
    }
}
