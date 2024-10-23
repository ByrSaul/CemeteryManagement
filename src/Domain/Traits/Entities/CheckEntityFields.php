<?php

namespace CemeteryManagement\Traits\Entities;

use UnderflowException;

/**
 * Trait for check methods
 */
trait CheckEntityFields
{
    /**
     * Validates the field provided
     *
     * @throws UnderflowException
     */
    public function validateRequiredFields()
    {
        foreach ($this->requiredFields as $requiredField) {
            if (trim($requiredField) == '') {
                throw new UnderflowException(
                    sprintf('La propiedad %s no puede estar vacía', $requiredField)
                );
            }
        }
    }
}
