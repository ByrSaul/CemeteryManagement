<?php

namespace CemeteryManagement\Contracts\Repositories\System;

use CemeteryManagement\Entities\Database\Eloquent\Connection;

/**
 * Contract for the main configuration
 *
 * @package CemeteryManagement
 */
interface MainConfigurationRepository
{
    /**
     * Connection Entity getter by connection name identifier
     *
     * @param string $connectionName Connection Name Identifier
     *
     * @return Connection
     */
    public function getConnection(string $connectionName): Connection;

    /**
     * Temp folder getter
     *
     * @return string
     */
    public function getTmpFolder(): string;

    /**
     * Time zone getter
     *
     * @return string
     */
    public function getTimeZone(): string;

    /**
     * PDF folder
     *
     * @return string
     */
    public function getPDFFolder(): string;

    /**
     * Photo folder
     *
     * @return string
     */
    public function getPhotoFolder(): string;


    /**
     * Assets folder
     *
     * @return string
     */
    public function getAssetsFolder(): string;

    /**
     * User Id Cron Manager
     * @return int
     */
    public function getUserIdCronManager(): int;

    /**
     * Get Twilio Property
     * @param string $property
     * @return string
     */
    public function getTwilioProperty(string $property): string;

    /**
     * Get WebApi Property
     * @param string $property
     * @return string
     */
    public function getWebApiProperty(string $property): string;

    /**
     * @return string
     */
    public function getPhoneNumber(): string;

    /**
     * Get Mail Property
     * @param string $property
     * @return string
     */
    public function getMailProperty(string $property): string;

    /**
     * Get WebApi Property
     * @param string $nameApi
     * @param string $property
     * @return string
     */
    public function getPropertyByNameApi(string $nameApi, string $property): string;
}
