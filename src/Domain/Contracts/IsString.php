<?php

namespace CemeteryManagement\Contracts;

/**
 * Is String interface.
 *
 * This interface is used to identify objects that can be directly converted into strings.
 *
 * It uses PHP's magic method <code>__toString()</code> to convert the object's value into
 * a string, for example in an <code>echo</code> statement.
 *
 * @package   Proaktiv
 * @link      http://php.net/manual/en/language.oop5.magic.php#object.tostring
 */
interface IsString
{
    /**
     * Returns the String representation of object.
     * @return string
     */
    public function __toString(): string;
}
