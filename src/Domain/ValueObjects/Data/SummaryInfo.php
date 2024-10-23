<?php

namespace CemeteryManagement\ValueObjects\Data;

use JsonSerializable;
use Serializable;

/**
 * retrieve an information of summary field
 *
 * @package  CemeteryMagnament
 */
class SummaryInfo implements Serializable, JsonSerializable
{
    /**
     * @var float $summary
     */
    protected float $summary;

    /**
     * @var int $count
     */
    protected int $count;

    /**
     * Initializes the PODetail Object distribution
     *
     * @param   float   $summary    Summary value
     * @param   int     $count      Total number boxes of the purchase order by material
     */
    public function __construct(float $summary, int $count)
    {
        $this->summary = $summary;
        $this->count = $count;
    }

    /**
     * Retrieves the total sum
     *
     * @return float
     */
    public function getSummary(): float
    {
        return $this->summary;
    }

    /**
     * Retrieves the total count of information objects
     *
     * @return int
     */
    public function getCount(): int
    {
        return $this->count;
    }

    /**
     * Serializes the contents of the class.
     *
     * @return string
     *
     * {@inheritDoc}
     * @see Serializable::serialize()
     */
    public function serialize()
    {
        return serialize([
            'summary' => $this->summary,
            'count' => $this->count
        ]);
    }

    /**
     * Unserialize back the contents of the class.
     *
     * @return void
     *
     * {@inheritDoc}
     * @see Serializable::unserialize()
     */
    public function unserialize($serialized): void
    {
        // Loads unserialized data back to the class.
        $data = unserialize($serialized);

        $this->summary = $data['summary'];
        $this->count = $data['count'];
    }

    /**
     * Returns an array containing all its item's serialized data.
     *
     * {@inheritDoc}
     * @link http://www.php.net/manual/en/jsonserializable.jsonserialize.php
     * @see  JsonSerializable::jsonSerialize()
     */
    public function jsonSerialize(): array
    {
        return [
            'summary' => $this->summary,
            'count' => $this->count
        ];
    }
}
