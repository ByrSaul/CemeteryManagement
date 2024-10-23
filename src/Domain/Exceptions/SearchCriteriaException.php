<?php

namespace CemeteryManagement\Exceptions;

/**
 * Search criteria exception
 *
 * @package Proaktiv\Exceptions
 */
class SearchCriteriaException extends GenericException
{
    /**
     * @var int
     */
    protected $code = 406;

    /**
     * @var string
     */
    protected $message = "Los criterios de búsqueda son insuficientes";
}
