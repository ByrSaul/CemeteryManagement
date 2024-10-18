<?php

namespace CemeteryManagement\Entities\Database\Eloquent;

use CemeteryManagement\Domain\Entities\AbstractEntity;

/**
 * Connection entity
 *
 * @package CemeteryMagnament
 */
class Connection extends AbstractEntity
{
    /**
     * @var array
     */
    protected $requiredFields = [
        'name',
        'username',
        'password',
        'host',
        'database',
        'driver',
        'port'
    ];

    /**
     * @var string
     */
    protected string $name;

    /**
     * @var string
     */
    protected string $username;

    /**
     * @var string
     */
    protected string $password;

    /**
     * @var string
     */
    protected string $host;

    /**
     * @var string
     */
    protected string $database;

    /**
     * @var string
     */
    protected string $driver;

    /**
     * @var string
     */
    protected string $port;

    /**
     * getter Connection Name
     *
     * @return string
     */
    public function getConnectionName(): string
    {
        return $this->name;
    }

    /**
     * getter username
     *
     * @return string
     */
    public function getUserName(): string
    {
        return $this->username;
    }

    /**
     * getter Password
     *
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * getter Host
     *
     * @return string
     */
    public function getHost(): string
    {
        return $this->host;
    }

    /**
     * getter Database
     *
     * @return string
     */
    public function getDBName(): string
    {
        return $this->database;
    }

    /**
     * getter Driver
     *
     * @return string
     */
    public function getDBDriver(): string
    {
        return $this->driver;
    }

    /**
     * getter port
     *
     * @return string
     */
    public function getPort(): string
    {
        return $this->port;
    }
}