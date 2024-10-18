<?php

namespace CemeteryManagement\Infrastructure\Connections;

use Illuminate\Database\Capsule\Manager;
use CemeteryManagement\Contracts\Conections\IsConnection;

/**
 * SQL Server Connection Configurate class
 *
 * @package CemeteryManagement
 */
class SQLServerConnection implements IsConnection
{
    /**
     * Configure Capsule manager for connect database type
     *
     * @param  Manager $capsule Capsule Manager
     *
     * @return void
     */
    public function preConfigure(Manager $capsule): void
    {
    }
}

