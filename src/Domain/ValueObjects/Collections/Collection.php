<?php

namespace CemeteryManagement\ValueObjects\Collections;

use Countable;
use Iterator;
use JsonSerializable;
use CemeteryManagement\Contracts\ValueObjects\Collections\IsCollectable;

/**
 * Generic collection.  It requires a IsCollectable / JSONSerializable class to be collected
 *
 * @package Proaktiv
 */
class Collection implements Countable, Iterator, JsonSerializable
{
    /**
     * Collections of elements
     * @var array
     */
    protected array $collection = [];

    /**
     * Returns the current element
     *
     * @return IsCollectable|null
     */
    public function current(): ?IsCollectable
    {
        /**
         * If retrieving the current element fails, we'll still try to rewind the
         * pointer and return the first element.
         */
        if (($current = current($this->collection)) === false) {
            return $this->rewind();
        }

        return $current;
    }

    /**
     * Returns element by key
     *
     * @param mixed $key  The key of the element
     * @return IsCollectable|null
     */
    public function findByKey(mixed $key): ?IsCollectable
    {
        return $this->collection[$key] ?? null;
    }

    /**
     * @param mixed $key
     * @return void
     */
    public function removeByKey(mixed $key): void
    {
        unset($this->collection[$key]);
    }

    /**
     * Returns the last element
     *
     * @return IsCollectable|null
     */
    public function end(): ?IsCollectable
    {
        /**
         * If retrieving the last element fails, we'll still try to rewind the
         * pointer and return the last element.
         */
        if (($last = end($this->collection)) === false) {
            return $this->rewind();
        }

        return $last;
    }

    /**
     * Move forward to next element
     *
     * @return IsCollectable|null
     */
    public function next(): ?IsCollectable
    {
        $next = next($this->collection);

        return ($next === false ? null : $next);
    }

    /**
     * Return the key of the current element
     *
     * @return string|null
     */
    public function key(): ?string
    {
        // First, we'll collect the key.
        $key = key($this->collection);

        // No key
        if ($key === null || $key === false) {
            return null;
        }

        // Then, we'll uniform the returned value.
        return ((string) $key);
    }

    /**
     * Checks if current position of the collection is valid
     *
     * @return bool The return value will be casted to boolean and then evaluated.
     */
    public function valid(): bool
    {
        $key = $this->key();
        return ($key !== null);
    }

    /**
     * Rewinds to the first element
     *
     * @return IsCollectable|null
     */
    public function rewind(): ?IsCollectable
    {
        // Rewinds the cursor and returns the first Element.
        if (($element = reset($this->collection)) !== false) {
            return $element;
        }

        return null;
    }

    /**
     * Counts the number of entities in this collection
     *
     * @return int
     */
    public function count(): int
    {
        return count($this->collection);
    }

    /**
     * Sums the value by field in this collection
     *
     * @param string $field
     *
     * @return float
     */
    public function sum($field): float
    {
        // Declares sum variable and serialize collection
        $sum = 0;
        $serializedCollection =  $this->jsonSerialize();

        // Sum value element by field
        foreach ($serializedCollection as $element) {
            if (!isset($element->$field)) {
                return 0;
            }

            if ($element->$field < 0 || !is_numeric($element->$field)) {
                continue;
            }

            $sum += floatVal($element->$field);
        }

        return $sum;
    }

    /**
     * Sums the value by field in Value Object Collections
     *
     * @param string $field
     *
     * @return float
     */
    public function sumValueObject(string $field): float
    {
        // Declares sum variable and serialize collection
        $sum = 0;
        $serializedCollection =  $this->jsonSerialize();

        // Sum value element by field
        foreach ($serializedCollection as $element) {
            if (!isset($element[$field])) {
                return 0;
            }

            if ($element[$field] < 0 || !is_numeric($element[$field])) {
                continue;
            }

            $sum += floatVal($element[$field]);
        }

        return $sum;
    }

    /**
     * Returns a sub array with fields values
     *
     * @param string $field
     *
     * @return array
     */
    public function getSubArrayByField($field): array
    {
        $subArray = [];

        $serializedCollection =  $this->jsonSerialize();

        foreach ($serializedCollection as $element) {
            if (!isset($element->$field)) {
                return 0;
            }

            $subArray[] = $element->$field;
        }

        return $subArray;
    }

    /**
     * Returns a sub array with fields values
     *
     * @param string $field
     *
     * @return array
     */
    public function getSubArrayByFieldWithIdIndex($field): array
    {
        $subArray = [];

        $serializedCollection =  $this->jsonSerialize();

        foreach ($serializedCollection as $element) {
            if (!isset($element->$field)) {
                return 0;
            }

            $subArray[$element->id] = $element->$field;
        }

        return $subArray;
    }

    /**
     * {@inheritDoc}
     *
     * @return array
     * @see    JsonSerializable::jsonSerialize()
     */
    public function jsonSerialize(): array
    {
        // Declares and fills a return array.
        $array = [];

        /** @var IsCollectable $entity */
        foreach ($this->collection as $entity) {
            $array[] = $entity->jsonSerialize();
        }

        return $array;
    }
}
