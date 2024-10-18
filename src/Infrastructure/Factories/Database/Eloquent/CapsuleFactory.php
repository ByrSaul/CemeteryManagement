<?php

namespace CemeteryManagement\Infrastructure\Factories\Database\Eloquent;

use Illuminate\Database\Capsule\Manager;

/**
 * Eloquent capsule Factory
 *
 * @package CemeteryManagement
 */
abstract class CapsuleFactory
{
   /**
    * @var Manager
    */
   private static $capsule = null;

   public static function getCapsule(): Manager
   {
       //Create Manager Capsule when is null
       if (null === static::$capsule) {
           static::createCapsule();
       }

       // Retrieve capsule
       return static::$capsule;
   }

   private static function createCapsule(): Manager
   {
       //Create Manager capsule
       static::$capsule = new Manager();
       static::$capsule->setAsGlobal();

       // Retrieve capsule
       return static::$capsule;
   }
}