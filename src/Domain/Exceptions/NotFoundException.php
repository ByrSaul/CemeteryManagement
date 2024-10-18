<?php

namespace CemeteryManagement\Exceptions;


/**
 *Exception that is generated when something is not found (Deceased/user error)
 */
class NotFoundException extends GenericException
{
    /**
     * @var string
     */
    protected $message = "The requested resource does not exist.";

    /**
     * @var int
     */
    protected $code = 404;
}