<?php

namespace  CemeteryManagement\Services;

use CemeteryManagement\Contracts\IsService;
use CemeteryManagement\Contracts\Repositories\System\MainConfigurationRepository;
use CemeteryManagement\Entities\Database\Eloquent\Connection;
use CemeteryManagement\Exceptions\System\MainConfiguration\MainConfigurationRepositoryMissing;
use CemeteryManagement\ValueObjects\Data\Permissions;

/**
 * Global service for the main configuration.  It works using static methods for global access through the application
 *
 * @package Cementery
 */
abstract class MainConfigurationService implements IsService
{
   /**
    * @var MainConfigurationRepository
    */
   protected static $repository;

   /**
    * User permission allowed
    * @var Permissions
    */
   protected static Permissions $userPermissions;

   /**
    * Sets the repository
    *
    * @param MainConfigurationRepository
    *
    * @return void
    */
   public static function setRepository(MainConfigurationRepository $repository): void
   {
       static::$repository = $repository;
   }

   /**
    * gets repository
    *
    * @return MainConfigurationRepository
    */
   public static function getRepository(): MainConfigurationRepository
   {
       if (null===static::$repository) {
           throw new MainConfigurationRepositoryMissing();
       }
       return static::$repository;
   }

   /**
    * connection Entity getter by connection name identifier in configuration
    *
    * @param string $connectionName Connection name identifier
    * @return Connection
    */
   public static function getConnection(string $connectionName): Connection
   {
       return static::getRepository()->getConnection($connectionName);
   }

   /**
    * Dir Temp Folder getter
    *
    * @return string
    * @throws MainConfigurationRepositoryMissing
    */
   public static function getTmpFolder(): string
   {
       if (null===static::$repository) {
           throw new MainConfigurationRepositoryMissing();
       }

       return static::$repository->getTmpFolder();
   }

   /**
    * Build user permission allowed
    */
   public static function setUserPermissions($userPermissions): void
   {
       static::$userPermissions = new Permissions($userPermissions);
   }

   /**
    * Retrieve a user permissions
    *
    * @return Permissions
    */
   public static function getUserPermissions(): Permissions
   {
       return static::$userPermissions;
   }

   /**
    * Return user permission allowed
    */
   public static function checkPermission($requiredPermissions): bool
   {
       return static::$userPermissions->checkUserPermission($requiredPermissions);
   }
}