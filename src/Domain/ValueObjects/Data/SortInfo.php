<?php

namespace CemeteryManagement\ValueObjects\Data;

use CemeteryManagement\Contracts\IsString;
use Serializable;
use JsonSerializable;
use InvalidArgumentException;

/**
 * Sorting Information class.
 *
 * This class is used when the sorting information about a paginated collection is also required.
 *
 * It will also provide basic operations for the sorting information it holds, in order to facilitate
 * and centralize its data processing.
 *
 * @package   CemeteryMagnament
 * by Tito Alvarez
 */

class SortInfo implements Serializable, JsonSerializable, IsString
{
    /**
     * @var string $field
     * Ordering field's name.
     */
    protected string $field = '';

    /**
     * @var string $default
     * Default field used for ordering.
     */
    protected string $default = '';

    /**
     * @var string $order
     * Ordering direction: asc/desc
     */
    protected string $order = 'asc';

    /**
     * Creates a new Sorting Information instance.
     *
     * @param  string $field     - The Field used in the record's ordering.
     * @param  string $default   - Default field used for ordering.
     * @param  bool   $ascending - If the ordering in which the records are presented is in <i>Ascending</i> order.
     *
     * @throws InvalidArgumentException - If any of the supplied parameters is invalid.
     *
     * @return void
     */
    public function __construct(string $field, string $default, bool $ascending = true)
    {
        // Validates supplied parameters.
        if (strlen(trim($field)) === 0 || strlen(trim($default)) === 0) {
            throw new InvalidArgumentException('Los criterios de orden deben tener algún valor.');
        }

        $this->field   = strtolower(trim($field));
        $this->default = strtolower(trim($default));
        $this->order  = ($ascending ? $this->order : 'desc');
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
        return serialize([
            'field'   => $this->field,
            'default' => $this->default,
            'order'   => $this->order,
        ]);
    }

    /**
     * Unserializes back the contents of the class.
     *
     * @return void
     *
     * {@inheritDoc}
     * @see Serializable::unserialize()
     */
    public function unserialize($serialized)
    {
        // Loads unserialized data back to the class.
        $data = unserialize($serialized);

        $this->field   = $data['field'];
        $this->order   = $data['order'];
        $this->default = $data['default'];
    }

    /**
     * Returns the String representation of the object.
     *
     * {@inheritDoc}
     * @see IsString::_toString()
     */
    public function __toString(): string
    {
        return sprintf("orderby=%s&orderdir=%s", $this->field, $this->order);
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
            'field'   => $this->field,
            'default' => $this->default,
            'order'   => $this->order,
        ];
    }

    /**
     * Returns TRUE if the result has been sorted.
     *
     * @return bool
     */
    public function isSorted(): bool
    {
        return (
            $this->order !== 'asc' ||
            $this->field !== $this->default
        );
    }

    /**
     * Returns the ordering Field.
     *
     * @return string
     */
    public function getField(): string
    {
        return $this->field;
    }

    /**
     * Returns the record ordering for the Field.
     *
     * It will only have one of two values: asc/desc
     *
     * @return string
     */
    public function getOrder(): string
    {
        return $this->order;
    }

    /**
     * Checks if is being sorted by the supplied field.
     *
     * @param  string $field - Field's name to test.
     *
     * @return bool
     */
    public function isSortedBy(string $field): bool
    {
        return (strtolower(trim($field)) === $this->field);
    }
}
