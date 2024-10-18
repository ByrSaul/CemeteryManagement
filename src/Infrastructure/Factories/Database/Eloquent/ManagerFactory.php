<?php

namespace CemeteryManagement\Infrastructure\Factories\Database\Eloquent;

use Illuminate\Database\Capsule\Manager;
use CemeteryManagement\Contracts\Conections\IsConnection;
use CemeteryManagement\Services\MainConfigurationService;
use InvalidArgumentException;

/**
 * Eloquent Capsule Manager Entity
 *
 * @package CemeteryManagement
 */
abstract class ManagerFactory extends CapsuleFactory
{
    /**
     * @var Manager
     */
    private static ?Manager $manager = null;

    /**
     * Gets the capsule manager
     *
     * @param    IsConnection    $connection        Connection preconfigure
     * @param    string          $connnectionName   Connnection name
     * @param    boolean         $default           Is Default connection
     *
     * @return   Manager
     * @throws   InvalidArgumentException
     */
    public static function get(IsConnection $connection, string $connectionName, $default = false): Manager
    {
        try {
            // Parent construct Instance
            static::$manager = parent::getCapsule();

            // Try access to connection by connection name
            static::$manager::connection($connectionName);
        } catch (InvalidArgumentException $e) {
            // Create connection instance
            static::$manager = static::create($connection, $connectionName, $default);
        }

        // Retrieve capsule
        return static::$manager;
    }

    /**
     * Create the capse manager connection
     *
     * @param    IsConnection    $connection        Connection preconfigure
     * @param    string          $connnectionName   Connnection name
     * @param    boolean         $default           Is Default connection
     *
     * @return Manager
     */
    public static function create(IsConnection $connection, string $connectionName, $default = false): Manager
    {
        // Apply pre-configuration to connection
        $connection->preConfigure(static::$manager);

        // Connection configuration
        $configuration = MainConfigurationService::getConnection($connectionName);

        // The default connnection
        if ($default) {
            $connectionName = 'default';
        }

        // Initializes and configures the Capsule Manager for Eloquent.
        static::$manager->addConnection(array(
            'driver'    => $configuration->getDBDriver(),
            'host'      => $configuration->getHost(),
            'database'  => $configuration->getDBName(),
            'username'  => $configuration->getUserName(),
            'password'  => $configuration->getPassword(),
            'port'      => $configuration->getPort(),
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix'    => ''
        ), $connectionName);

        // Persist configuration in the capsule
        static::$manager->bootEloquent();

        // Retrieve a capsule
        return static::$manager;
    }
}

