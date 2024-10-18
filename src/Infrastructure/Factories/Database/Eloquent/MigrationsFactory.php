<?php

namespace CemeteryManagement\Infrastructure\Factories\Database\Eloquent;

use Illuminate\Database\Capsule\Manager;
use Illuminate\Database\ConnectionResolver;
use Illuminate\Database\Migrations\DatabaseMigrationRepository;
use Illuminate\Database\Migrations\Migrator;
use Illuminate\Filesystem\Filesystem;

/**
 * Eloquent Migrations class factory.
 *
 * @package CemeteryManagement
 */
abstract class MigrationsFactory
{
    /**
     * var string TABLE - Name of the migration's datatable.
     */
    private const TABLE = 'AtomicMigrations';

    /**
     * var string CONNECTION - Name of the used connection.
     */
    private const CONNECTION = 'erp';

    /**
     * Creates and returns a new instance of a Database Migrator class.
     *
     * @param Manager $capsule - An instance of Eloquent's Capsule Manager.
     *
     * @return Migrator
     */
    public static function createMigrator(Manager $capsule): Migrator
    {
        // Initializes a Connection Resolver instance.
        $resolver = new ConnectionResolver([
            self::CONNECTION => $capsule->getConnection(self::CONNECTION)
        ]);

        // Creates and configures a new instance of a Migration Repository.
        $repository = new DatabaseMigrationRepository($resolver, self::TABLE);
        $repository->setSource(self::CONNECTION);

        // If the datatable is not set, we'll need to create it.
        if (!$repository->repositoryExists()) {
            $repository->createRepository();
        }

        // Initialize the Migrator's instance.
        $migrator = new Migrator(
            $repository,
            $resolver,
            new Filesystem()
        );
        $migrator->setConnection(self::CONNECTION);

        // Returns Migrator's instance.
        return $migrator;
    }
}
