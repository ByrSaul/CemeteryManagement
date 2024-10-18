<?php

namespace CemeteryManagement\Infrastructure\Connections;

use Illuminate\Database\Capsule\Manager;
use CemeteryManagement\Contracts\Conections\IsConnection;
use Yajra\Oci8\Connectors\OracleConnector as OCI;
use Yajra\Oci8\Oci8Connection;

/**
 * ORACLE Connection Configure class.
 *
 * @package CemeteryManagement
 */
class OracleConnection implements IsConnection
{
    /**
     * Configure Capsule manager for connect database type
     *
     * @param  Manager $capsule Capsule Manager
     *
     * @return void
     */
    public function preConfigure(Manager $capsule)
    {
        $capsule->getDatabaseManager();
        $manager = $capsule->getConnection();
        $manager->extend('oracle', function ($config) {
            $connector = new OCI();
            $connection = $connector->connect($config);
            $db = new Oci8Connection($connection, $config['database'], $config['prefix']);

            // set oracle session variables
            $sessionVars = [
                'NLS_TIME_FORMAT'         => 'HH24:MI:SS',
                'NLS_DATE_FORMAT'         => 'YYYY-MM-DD HH24:MI:SS',
                'NLS_TIMESTAMP_FORMAT'    => 'YYYY-MM-DD HH24:MI:SS',
                'NLS_TIMESTAMP_TZ_FORMAT' => 'YYYY-MM-DD HH24:MI:SS TZH:TZM',
                'NLS_NUMERIC_CHARACTERS'  => '.,',
            ];

            $db->setSessionVars($sessionVars);

            return $db;
        });
    }
}
