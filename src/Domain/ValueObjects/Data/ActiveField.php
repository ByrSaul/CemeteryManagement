<?php

namespace CemeteryManagement\ValueObjects\Data;

use JsonSerializable;
use Serializable;

/**
 * Retrieve a information of Action´s allowed
 *
 * @package Proaktiv
 */
class ActiveField implements Serializable, JsonSerializable
{
    /**
     * @var  int  $id
     * Field identifier
     */
    protected int $id;

    /**
     * @var  string  $description
     */
    protected string $description;

    /**
     * @var bool $enabled
     */
    protected bool $enabled;

    /**
     * Initializes the Actions Object
     *
     * @param   bool             $modified            Modified permission
     * @param   bool             $deleted             Deleted permission
     *
     * @return void
     */
    public function __construct(int $id, string $description, bool $enabled)
    {
        $this->id = $id;
        $this->description = $description;
        $this->enabled = $enabled;
    }

    /**
     * id getter
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * description getter
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * enabled getter
     * @return bool
     */
    public function getEnabled(): bool
    {
        return $this->enabled;
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
            'id'            => $this->id,
            'description'   => $this->description,
            'enabled'       => $this->enabled
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
    public function unserialize($serialized): void
    {
        // Loads unserialized data back to the class.
        $data = unserialize($serialized);

        $this->id           = $data['id'];
        $this->description  = $data['description'];
        $this->enabled      = $data['enabled'];
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
            'id'            => $this->id,
            'description'   => $this->description,
            'enabled'       => $this->enabled
        ];
    }
}
