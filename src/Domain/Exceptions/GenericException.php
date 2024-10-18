<?php

namespace CemeteryManagement\Exceptions;

use Exception;

/**
 * Initial class to handle application exceptions
 *
 * @package CemeteryManagement
 */
class GenericException extends Exception
{
   /**
    * @var string
    */
   protected $message = "An error occurred while processing your request";

   /**
    * @var int
    */
   protected $code = 500;

   /**
    * Exception constructor
    *
    * @param    string|null    $message     Exception message
    * @param    int|null       $code        Exception code
    * @param    Exception|null $previous    Previous  exception
    */
   public function __construct($message = null, $code = null, Exception $previous = null)
   {
       if ($message === null) {
           $message = $this->message;
       }

       if ($code === null) {
           $code = $this->code;
       }

       parent::__construct($message, $code, $previous);
   }
}
