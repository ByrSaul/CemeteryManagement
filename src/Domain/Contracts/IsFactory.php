<?php

namespace CemeteryManagement\Contracts;

/**
 * Contract for factories
 *
 * @package CemeteryManagement
 */
interface IsFactory
{
    /**
     * @return IsFactory
     */
    public static function get();

    /**
     * @return IsFactory
     */
    public static function create();
}
