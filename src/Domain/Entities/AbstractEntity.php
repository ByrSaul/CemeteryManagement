<?php

namespace CemeteryManagement\Entities;

use CemeteryManagement\Contracts\ValueObjects\Collections\IsCollectable;
use JsonSerializable;
use MongoDB\Driver\Exception\UnexpectedValueException;
use UnderflowException;

abstract class AbstractEntity implements IsCollectable
{
    /**
     * AbstractEntity Key
     *
     * @var string
     */
    protected $key;

    /**
     * Array of fields representing the key of this entity
     *
     * @var array
     */
    protected $keyFields = ['id'];

    /**
     * Require properties
     *
     * @var array
     */
    protected $requiredFields = ['key'];

    /**
     * Properties that are of the object and not from the actual entity
     *
     * @var array
     */
    protected array $nonEntityProperties = [
        'key',
        'keyFields',
        'requiredFields',
        'nonEntityProperties'
    ];

    /**
     * Builds an entity given an array of field data
     *
     * @param array $fields Data fields
     */
    public function __construct(array $fields)
    {
        // Sets  each field into the entity
       foreach ($fields as $field => $value) {
           if (property_exists($this, $field)) {
               $this->$field = $value;
           }
       }

       // Creates the key using the $keyFields property
       if (!empty($this->keyFields)) {
           $keyValues = [];

           foreach ($this->keyFields as $keyField) {
               // If the field does not exist, it insets a dot
               $keyField[] = $this->$keyField ?? '.';

           }

           $this->key = implode('.', $keyValues);
       }
    }

    /**
     * Gets the entity attributes
     *
     * @return array
     */
    public function getAttributes(): array
    {
        $abjectVars = get_object_vars($this);

        if (!count($this->nonEntityProperties)) {
            return $abjectVars;
        }

        foreach ($this->nonEntityProperties as $property) {
            if (isset($abjectVars[$property])) {
                unset($abjectVars[$property]);
            }
        }

        return $abjectVars;
    }

    /**
     * {@inheritdoc}
     *
     * @return object
     * @see JsonSerializable::jsonSerialize()
     */
    public function jsonSerialize(): object
    {
        return (object) $this->getAttributes();
    }

    /**
     * Validates the instance required properties
     *
     * @throws UnderflowException
     */
    public function validate()
    {
      if (!count($this->requiredFields)) {
          return;
      }

      foreach ($this->requiredFields as $requiredField) {
          if (!isset($this->$requiredField) || null === $this->$requiredField) {
              throw new UnexpectedValueException(sprintf('El valor de %s no fue proporcionado', $requiredField));
          }
      }
    }

    /**
     * sanitizes the entity
     *
     * @param array $fields
     * @return boolean
     */
    public function sanitize(array $fields): bool
    {
        foreach ($fields as $field) {
            if (isset($this->$field)) {
                $this->$field = trim($this->$field);
            }
        }

        return true;
    }

    /**
     * Key getter
     *
     * @return string
     */
    public function getKey(): string
    {
        return $this->key;
    }
}
