<?php

namespace CemeteryManagement\ValueObjects\Collections;

use CemeteryManagement\ValueObjects\Data\SortInfo;
use JsonSerializable;

/**
 * Paginated Value Object aggregate Collections information.
 *
 * This class is used when a Value Object Collections of records is paginated, and we'll need
 * to associated with the Value Object Collections all the pagination's information.
 *
 * The initialCollection of records being paginated will still be accessible through
 * the getCollection() method, but <b>any changes in this Collections will not be
 * reflected in the Pagination information counters.
 *
 * If no pagination information is required, please use regular Collections object.
 *
 * @package Proaktiv
 * @see     ValueObjectCollection
 */
class PaginatedValueObjectCollection implements JsonSerializable
{
    /**
     * @var ValueObjectCollection|null  $collection
     * Collections of records being Paginated.
     */
    protected mixed $collection = null;

    /**
     * @var SortInfo|null  $sortInfo
     * Sorting information instance.
     */
    protected ?SortInfo $sortInfo = null;

    /**
     * @var int  $total
     * Total number of records available.
     */
    protected int $total = 0;

    /**
     * @var int|null  $firstId
     * Initial record being displayed. NULL if empty Collections.
     */
    protected ?int $firstId = null;

    /**
     * @var int|null  $lastId
     * Last record being displayed. NULL if empty Collections.
     */
    protected ?int $lastId = null;

    /**
     * @var int  $currentPage
     * Current Page for the Paginated records.
     */
    protected int $currentPage = 0;

    /**
     * @var int  $lastPage
     * Last Page available for Pagination.
     */
    protected int $lastPage = 0;

    /**
     * @var int  $perPage
     * Number of records being displayed per Page.
     */
    protected int $perPage = 0;

    /**
     * Initializes the Paginated Collections instance.
     *
     * @param mixed    $collection  Collections of records being Paginated.
     * @param SortInfo $sortInfo    Sorting information instance.
     * @param int      $total       Total number of records available.
     * @param int      $currentPage Current Page for the Paginated records.
     * @param int      $lastPage    Last Page available for Pagination.
     * @param int      $perPage     Number of records being displayed per Page.
     * @param int|null $from        Initial record's ID being displayed. NULL if empty Collections.
     * @param int|null $to          Last record's ID being displayed. NULL if empty Collections.
     *
     * @return void
     */
    public function __construct(
        ValueObjectCollection $collection,
        SortInfo $sortInfo,
        int $total,
        int $currentPage,
        int $lastPage,
        int $perPage,
        int $from = null,
        int $to = null
    ) {
        // Sets the actual Collections of records being Paginated.
        $this->collection = $collection;
        $this->sortInfo   = $sortInfo;

        // Sets the counters.
        $this->total   = $total;
        $this->perPage = $perPage;

        // Sets the Page information.
        $this->currentPage = $currentPage;
        $this->lastPage    = $lastPage;
        $this->firstId     = $from;
        $this->lastId      = $to;
    }

    /**
     * Collections of items being paginated.
     *
     * Pagination counters will be calculated at start, and will remain immutable
     * until the object is destroyed.
     *
     * Please note that adding/removing elements to or from the Collections will
     * not reflect on the Pagination counters being updated.
     *
     * @return EntityCollection
     */
    public function getCollection(): ValueObjectCollection
    {
        return $this->collection;
    }

    /**
     * Retrieves the sorting information for the Pagination.
     *
     * @return SortInfo
     */
    public function getSortInfo(): SortInfo
    {
        return $this->sortInfo;
    }

    /**
     * Number of the first record being displayed in the Paginated results.
     *
     * Please note that the returned integer is not the record's ID. It represents
     * the record's global displaying order if the the records weren't being paginated.
     *
     * @return int
     */
    public function getFromRecord(): int
    {
        return (($this->currentPage - 1) * $this->perPage);
    }

    /**
     * Number of the last record being displayed in the Paginated results.
     *
     * Please note that the returned integer is not the record's ID. It represents
     * the record's global displaying order if the the records weren't being paginated.
     *
     * @return int
     */
    public function getToRecord(): int
    {
        if ($this->collection->count() < $this->perPage) {
            return ($this->getFromRecord() + $this->collection->count());
        } else {
            return ($this->getFromRecord() + $this->perPage);
        }
    }

    /**
     * Number of the first record's ID being displayed in the Paginated results.
     *
     * If the record Collections is empty, this will return null, as
     * there isn't any first or last records.
     *
     * @return int|null
     */
    public function getFirstId(): ?int
    {
        return $this->firstId;
    }

    /**
     * Number of the last record's ID being displayed in the Paginated results.
     *
     * If the record Collections is empty, this will return null, as
     * there isn't any first or last records.
     *
     * @return int|null
     */
    public function getLastId(): ?int
    {
        return $this->lastId;
    }

    /**
     * Total number of records in source.
     *
     * Returns the total number of records from the source dataset, from which the pagination was produced.
     *
     * @return int
     */
    public function getTotalRecords(): int
    {
        return $this->total;
    }

    /**
     * Total number of available records for Pagination.
     *
     * Returns the total number of records in the selected Page.
     *
     * @return int
     */
    public function getTotal(): int
    {
        return $this->collection->count();
    }

    /**
     * Number of the current Page for the paginated records.
     *
     * @return int
     */
    public function getCurrentPage(): int
    {
        return $this->currentPage;
    }

    /**
     * Number of the calculated last Page for the paginated records.
     *
     * @return int
     */
    public function getLastPage(): int
    {
        return $this->lastPage;
    }

    /**
     * Number of records being displayed by Page.
     *
     * @return int
     */
    public function getPerPage(): int
    {
        return $this->perPage;
    }

    /**
     * Returns an <code>Array</code> representation of the <i>Paginated Collections</i>'s object.
     *
     * @return array
     */
    public function getToArray(): array
    {
        return [
            'collection'   => $this->collection,
            'sortinfo'     => $this->sortInfo,
            'fromRecord'   => $this->getFromRecord(),
            'toRecord'     => $this->getToRecord(),
            'totalRecords' => $this->getTotalRecords(),
            'currentPage'  => $this->getCurrentPage(),
            'lastPage'     => $this->getLastPage(),
            'perPage'      => $this->getPerPage(),
        ];
    }

    /**
     * Returns an array containing all its item's serialized data.
     *
     * Allows the Collections to be serialized directly by the json_encode function.
     *
     * {@inheritDoc}
     *
     * @link http://www.php.net/manual/en/jsonserializable.jsonserialize.php
     * @see  JsonSerializable::jsonSerialize()
     */
    public function jsonSerialize(): array
    {
        return [
            'collection'   => $this->collection->jsonSerialize(),
            'sortinfo'     => $this->sortInfo->jsonSerialize(),
            'fromRecord'   => $this->getFromRecord(),
            'toRecord'     => $this->getToRecord(),
            'totalRecords' => $this->getTotalRecords(),
            'currentPage'  => $this->getCurrentPage(),
            'lastPage'     => $this->getLastPage(),
            'perPage'      => $this->getPerPage(),
        ];
    }
}
