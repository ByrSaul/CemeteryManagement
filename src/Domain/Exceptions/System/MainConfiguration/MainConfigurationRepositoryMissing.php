<?php

namespace CemeteryManagement\Exceptions\System\MainConfiguration;

use CemeteryManagement\Exceptions\GenericException;

/**
 * Exception to be raised when the main configuration repository has not been configured
 *
 * @package CemeteryManagement
 */
class MainConfigurationRepositoryMissing extends GenericException
{
    protected $message = 'The main configuration is missing / not initialized';
}
