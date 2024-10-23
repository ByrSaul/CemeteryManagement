<?php

namespace Proaktiv\ValueObjects\Collections;

use Countable;
use Iterator;
use JsonSerializable;
use UnexpectedValueException;
use Proaktiv\Contracts\ValueObjects\IsValueObject;

/**
 * Collections of unique value objects
 *
 * @package Proaktiv
 */
class ValueObjectUniqueCollection extends Collection implements Countable, Iterator, JsonSerializable
{
    /**
     * Adds a new value object to the Collections.
     * This method supports chaining.
     *
     * @param IsValueObject $valueObject Value object to add to the collection.
     *
     * @return  self
     */
    public function add(IsValueObject $valueObject): self
    {
        $exist = $this->validateExist($valueObject);

        // Validates it's a value object trying to be added
        if (!is_a($valueObject, IsValueObject::class)) {
            throw new UnexpectedValueException('El objeto que se intenta agregar no es un objeto de valor.');
        }


        // Adds a value object to the collection.
        if ($exist == 1) {
            $this->collection[] = $valueObject;
        }

        // Returns this instance.
        return $this;
    }

    /**
     * Validate if object is unique in array
     *
     * @param IsValueObject $valueObject Value object to add to the collection.
     *
     * @return  int
     */
    public function validateExist(IsValueObject $valueObject): int
    {
        $newItem = $valueObject->jsonSerialize();
        $keys = array_keys($newItem);
        $unique = 0;

        // If first iteration
        if (empty($this->collection)) {
            return 1;
        }

        // Validate if exist changes
        foreach ($this->collection as $item) {
            $unique = 0;
            foreach ($keys as $key) {
                $itemSerialize = $item->jsonSerialize();
                if ($itemSerialize["$key"] != $newItem["$key"]) {
                     $unique = 1;
                }
            }
            if ($unique == 0) {
                return $unique;
            }
        }

        return $unique;
    }
}
