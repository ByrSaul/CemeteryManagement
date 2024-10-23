<?php

namespace CemeteryManagement\ValueObjects\Collections;

use CemeteryManagement\Entities\AbstractEntity;
use Countable;
use Iterator;
use JsonSerializable;
use OverflowException;
use UnexpectedValueException;

/**
 * Collections of entities
 *
 * @package Proaktiv
 */
class EntityCollection extends Collection implements Countable, Iterator, JsonSerializable
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
    public function add(AbstractEntity $entity): self
    {
        // Validates if the given Entity already exists in the Collections.
        if (array_key_exists($entity->getKey(), $this->collection)) {
            throw new OverflowException('La entidad que se intenta agregar ya existe en la colección.');
        }

        // Adds an Entity to the collection.
        $this->collection[$entity->getKey()] = $entity;

        // Returns this instance.
        return $this;
    }

    /**
     * Add a new Entity to the Collections from an external Collections skipping repeated
     *
     *  @param AbstractEntity $entity Entity to add to the collection.
     *
     * @return  self
     * @throws UnexpectedValueException If you're trying to insert something that is not an Entity
     */
    public function strictMerge(AbstractEntity $entity): self
    {
        // Validates if the given Entity already exists in the Collections.
        if (array_key_exists($entity->getKey(), $this->collection)) {
            return $this;
        }

        // Adds an Entity to the collection.
        $this->collection[$entity->getKey()] = $entity;

        // Returns this instance.
        return $this;
    }

    /**
     * Merge one or more entity collection using strict merge
     *
     * @param EntityCollection  $newEntityCollection
     * @return self
     * @throws UnexpectedValueException If you're trying to insert something that is not an Entity
     */
    public function strinctMergeEntityCollection(EntityCollection $newEntityCollection): self
    {
        /** @var AbstractEntity */
        foreach ($newEntityCollection as $entity) {
            // Validates if the given Entity already exists in the Collections.
            if (array_key_exists($entity->getKey(), $this->collection)) {
                return $this;
            }

            // Adds an Entity to the collection.
            $this->collection[$entity->getKey()] = $entity;
        }

        // Returns this instance.
        return $this;
    }
}
