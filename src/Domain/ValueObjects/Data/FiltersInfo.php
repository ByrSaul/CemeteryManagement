<?php

namespace CemeteryManagement\ValueObjects\Data;

use CemeteryManagement\Exceptions\SearchCriteriaException;
use CemeteryManagement\ValueObjects\Collections\Store;
use Serializable;
use JsonSerializable;

/**
 * Filters Information class.
 *x
 * This class is used when building and showing a paginated collection.
 *
 * It will also provide basic operations for the filters information it holds, in order to facilitate
 * and centralize its data processing.
 *
 * @package   Proaktiv
 */
class FiltersInfo implements Serializable, JsonSerializable
{
    /**
     * @var   Store
     * Dynamic filters name and their values.
     */
    protected Store $filters;

    /**
     * @var  string  $search
     * Search value.
     */
    protected string $search = '';

    /**
     * Creates a new Filters Information instance.
     *
     * @param array $filters Dynamic filters name and their values.
     * @param string $search Search value.
     *
     * @return void
     * @throws SearchCriteriaException
     */
    public function __construct(array $filters, string $search)
    {
        // If it has search criteria, it needs to be at least 3 characters
        if (!empty($search) && strlen($search) < 3) {
            throw new SearchCriteriaException();
        }

        $this->filters = $this->arrayToStore($filters);
        $this->search  = trim($search);
    }

    /**
     * Converts array to store.
     *
     * @param  array  $array  Array that is going to be converted to Store.
     *
     * @return Store
     */
    private function arrayToStore(array $array): Store
    {
        $store = new Store();

        foreach ($array as $filter => $value) {
            $store->set($filter, $value);
        }

        return $store;
    }

    /**
     * Serializes the contents of the class.
     *
     * @return string
     *
     * {@inheritDoc}
     * @see Serializable::serialize()
     */
    public function serialize(): string
    {
        return serialize($this->jsonSerialize());
    }

    /**
     * Unserializes back the contents of the class.
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

        $this->filters = $this->arrayToStore($data['filters']);
        $this->search  = $data['search'];
    }

    /**
     * Returns an array containing all its item's serialized data.
     *
     * @link   http://www.php.net/manual/en/jsonserializable.jsonserialize.php
     * @see    JsonSerializable::jsonSerialize()
     */
    public function jsonSerialize(): array
    {
        return [
            'filters' => $this->filters->jsonSerialize(),
            'search'  => $this->search,
        ];
    }

    /**
     * Returns the filters array.
     *
     * @return Store
     */
    public function getFilters(): Store
    {
        return $this->filters;
    }

    /**
     * Returns the search value.
     *
     * @return string
     */
    public function getSearch(): string
    {
        return $this->search;
    }
}
